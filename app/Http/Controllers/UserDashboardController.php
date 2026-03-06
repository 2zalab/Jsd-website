<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use App\Mail\NotificationMail;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user          = Auth::user();
        $inscriptions  = $user->allInscriptions();
        $notifications = $user->notifications()->take(5)->get();
        $unread        = $user->unreadNotificationsCount();

        $stats = [
            'total'    => count($inscriptions),
            'pending'  => collect($inscriptions)->where('status', 'pending')->count(),
            'approved' => collect($inscriptions)->where('status', 'approved')->count(),
            'rejected' => collect($inscriptions)->where('status', 'rejected')->count(),
        ];

        return view('dashboard.index', compact('user', 'inscriptions', 'notifications', 'unread', 'stats'));
    }

    public function notifications()
    {
        $user          = Auth::user();
        $notifications = $user->notifications()->paginate(15);
        $unread        = $user->unreadNotificationsCount();

        // Marquer toutes comme lues lors de la consultation
        $user->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return view('dashboard.notifications', compact('user', 'notifications', 'unread'));
    }

    public function markRead($id)
    {
        $notification = UserNotification::where('user_id', Auth::id())
            ->findOrFail($id);

        $notification->update(['read_at' => now()]);

        return back();
    }

    public function markAllRead()
    {
        Auth::user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);
        return back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }

    public function profile()
    {
        $user  = Auth::user();
        $unread = $user->unreadNotificationsCount();
        return view('dashboard.profile', compact('user', 'unread'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => ['required'],
            'password'              => ['required', 'confirmed', Rules\Password::min(8)],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user = Auth::user();
        $user->update(['password' => Hash::make($request->password)]);

        try {
            Mail::to($user->email)->send(new NotificationMail(
                'Mot de passe modifié — Journées Sahel Digital',
                'Votre mot de passe a été modifié avec succès. Si vous n\'êtes pas à l\'origine de cette modification, contactez-nous immédiatement.',
                'warning',
                $user->name,
            ));
        } catch (\Exception) {}

        return back()->with('success', 'Mot de passe modifié avec succès.');
    }

    public function deleteNotification($id)
    {
        UserNotification::where('user_id', Auth::id())->findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function deleteAccount(Request $request)
    {
        $request->validate(['password' => ['required']]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'Mot de passe incorrect.'])->withFragment('danger-zone');
        }

        $user = Auth::user();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user->delete();

        return redirect('/')->with('success', 'Votre compte a été supprimé.');
    }

    public function inscriptionProgrammeur()
    {
        $user  = Auth::user();
        $unread = $user->unreadNotificationsCount();
        $typesConcours = [
            'CMPL' => 'Concours Meilleur.e Programmeur.e Lycéen (CMPL)',
            'CMPS' => 'Concours Meilleur.e Programmeur.e Senior (CMPS)',
        ];
        $langagesProgrammation = [
            'JavaScript','Python','Java','C','C++','C#','Ruby','PHP','Swift',
            'Go','Rust','TypeScript','Kotlin','Scala','R','Dart',
            'Lua','Perl','Haskell','Julia','COBOL','Pascal',
        ];
        return view('dashboard.inscriptions.programmeur', compact('user', 'unread', 'typesConcours', 'langagesProgrammation'));
    }

    public function inscriptionProjetDigital()
    {
        $user  = Auth::user();
        $unread = $user->unreadNotificationsCount();
        $typesConcours = [
            'CMPDL' => 'Concours Meilleur Projet Digital Lycéen (CMPDL)',
            'CMPDS' => 'Concours Meilleur Projet Digital Senior (CMPDS)',
        ];
        return view('dashboard.inscriptions.projet-digital', compact('user', 'unread', 'typesConcours'));
    }

    public function inscriptionHackathon()
    {
        $user  = Auth::user();
        $unread = $user->unreadNotificationsCount();
        return view('dashboard.inscriptions.hackathon', compact('user', 'unread'));
    }

    public function inscriptionStand()
    {
        $user  = Auth::user();
        $unread = $user->unreadNotificationsCount();
        return view('dashboard.inscriptions.stand', compact('user', 'unread'));
    }

}
