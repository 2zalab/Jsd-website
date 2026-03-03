<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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

        Auth::user()->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Mot de passe modifié avec succès.');
    }
}
