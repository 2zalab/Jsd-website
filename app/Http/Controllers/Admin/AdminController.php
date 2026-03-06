<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Stand;
use App\Models\Hackathon;
use App\Models\Programmeur;
use App\Models\ProjetDigital;
use App\Models\Sponsor;
use App\Models\Newsletter;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\StatutInscriptionUpdated;
use App\Mail\NotificationMail;



class AdminController extends Controller
{
    //
    public function dashboard()
    {
        // 1. Nombre de participants au Hackathon
        // Secondaire
        $participantsLycee = Hackathon::where('niveau_etudes', 'secondaire')->count();
        // Supérieur
        $participantsSuperieur = Hackathon::where('niveau_etudes', 'superieur')->count();

        // 2. Nombre de réservations des stands
        $nombreReservationsStand = Stand::count();

        // 3. Nombre de demandes de sponsor
        $nombreDemandesSponsor = Sponsor::count();

        // 4. Nombre de projets soumis
        // Projets Niveau Lycée
        $projetsLycee = ProjetDigital::where('type_concours', 'CMPDL')->count();
        // Projets Niveau Senior
        $projetsSenior = ProjetDigital::where('type_concours', 'CMPDS')->count();

        // 5. Participants au concours de meilleur programmeur
        // Niveau Lycée
        $participantsConcoursLycee = Programmeur::where('type_concours', 'CMPL')->count();
        // Niveau Senior
        $participantsConcoursSenior = Programmeur::where('type_concours', 'CMPS')->count();

        // 6. Nombre de newsletters
        $nombreNewsletters = Newsletter::count();

        // Passer les données à la vue
        return view('admin.dashboard', compact(
            'participantsLycee',
            'participantsSuperieur',
            'nombreReservationsStand',
            'nombreDemandesSponsor',
            'projetsLycee',
            'projetsSenior',
            'participantsConcoursLycee',
            'participantsConcoursSenior',
            'nombreNewsletters'
        ));
    }

    public function index()
    {
        return view('admin.index');
    }

    public function getHackathons()
    {
        // Récupérer les participants du lycée
        $hackathonsLycee = Hackathon::where('niveau_etudes', 'secondaire')->get();

        // Récupérer les participants du supérieur
        $hackathonsSuperieur = Hackathon::where('niveau_etudes', 'superieur')->get();

        // Retourner les résultats dans un tableau ou une vue
        return [
            'lycee' => $hackathonsLycee,
            'superieur' => $hackathonsSuperieur,
        ];
    }


    public function showHackathonsLycee()
    {
        // Récupérer les participants du lycée
        $hackathonsLycee = Hackathon::where('niveau_etudes', 'secondaire')->get();

        // Retourner les résultats à la vue admin.hackaton.lycee
        return view('admin.hackatons.lycee', compact('hackathonsLycee'));
    }

    public function showHackathonsSuperieur()
     {
        // Récupérer les participants du supérieur
        $hackathonsSuperieur = Hackathon::where('niveau_etudes', 'superieur')->get();

        // Retourner les résultats à la vue admin.hackaton.superieur
        return view('admin.hackatons.superieur', compact('hackathonsSuperieur'));
    }

    public function generatePdfHackatonLycee()
    {
        // Créer une nouvelle instance de TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Configurer le document
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Votre Nom');
        $pdf->SetTitle('Participants Hackathon Lycée');
        $pdf->SetSubject('Liste des participants au Hackathon Lycée');
        $pdf->SetKeywords('Hackathon, Lycée, Participants');

        // Définir les marges
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Ajouter une page
        $pdf->AddPage();

        // Définir la police
        $pdf->SetFont('helvetica', '', 10);

        // Générer le contenu HTML
        $html = $this->generateHtmlContent();

        // Ajouter le contenu HTML au PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Sortie du PDF
        return $pdf->Output('participants_hackathon_lycee.pdf', 'D');
    }

    private function generateHtmlContent()
    {
        $hackathonsLycee = Hackathon::where('niveau_etudes', 'secondaire')->get();

        $html = '<h1>Participants Hackathon Lycée</h1>';
        $html .= '<table border="1" cellpadding="5">';
        $html .= '<tr><th>Nom de l\'équipe</th><th>Chef d\'équipe</th><th>Nombre de participants</th><th>Établissement</th><th>Membres de l\'équipe</th></tr>';

        foreach ($hackathonsLycee as $hackathon) {
            $html .= '<tr>';
            $html .= '<td>' . $hackathon->nom_equipe . '</td>';
            $html .= '<td>' . $hackathon->nom_chef_equipe . '</td>';
            $html .= '<td>' . $hackathon->nombre_participants . '</td>';
            $html .= '<td>' . $hackathon->etablissement . '</td>';
            $html .= '<td><ul>';
            foreach ($hackathon->membres as $membre) {
                $html .= '<li>' . $membre . '</li>';
            }
            $html .= '</ul></td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        return $html;
    }

    public function getCmps()
    {

        $cmps = Programmeur::where('type_concours', 'CMPS')->get();

        return view('admin.concours.cmps', compact('cmps'));
    }

    public function getCmpl()
    {

        $cmpl = Programmeur::where('type_concours', 'CMPL')->get();

        return view('admin.concours.cmpl', compact('cmpl'));
    }

    public function getCmpds()
    {

        $cmpds = ProjetDigital::where('type_concours', 'CMPDS')->get();

        return view('admin.concours.cmpds', compact('cmpds'));
    }

    public function getCmpdl()
    {

        $cmpdl = ProjetDigital::where('type_concours', 'CMPDL')->get();
        return view('admin.concours.cmpdl', compact('cmpdl'));
    }

    public function getMessages(Request $request)
    {

       // $messages = Contact::all();
        //return view('admin.messages', compact(var_name: 'messages'));
    $query = Contact::query();

    if ($request->has('search')) {
        $searchTerm = $request->search;
        $query->where('name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('email', 'LIKE', "%{$searchTerm}%")
              ->orWhere('message', 'LIKE', "%{$searchTerm}%");
    }

    $messages = $query->latest()->paginate(10);

    return view('admin.messages', compact(var_name: 'messages'));
    }

   /*
    public function destroy(Contact $message)
    {
        $message->delete();

        return redirect()->back()
            ->with('success', 'Le message a été supprimé avec succès.');
    }
    */
    public function destroy(Request $request, Contact $message)
    {
    $message->delete();

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->back()
        ->with('success', 'Le message a été supprimé avec succès.');
    }


    /*
    public function getStands()
    {

        $stands = Stand::all();
        return view('admin.stands', compact(var_name: 'stands'));
    }
    */

    public function getStands(Request $request)
{
    $query = Stand::query();

    if ($request->has('search')) {
        $search = $request->get('search');
        $query->where('nom_entreprise', 'like', "%{$search}%")
              ->orWhere('secteur_activite', 'like', "%{$search}%");
    }

    $stands = $query->get();
    return view('admin.stands', compact('stands'));
}

public function generatePDF()
{
    $stands = Stand::all();
    $pdf = Pdf::loadView('admin.exports.stands_pdf', compact('stands'));
   // $pdf = \Barryvdh\DomPDF\PDF::loadView('admin.stands_pdf', compact('stands'));
    return $pdf->download('liste_des_stands.pdf');
}

    public function getSponsors(Request $request)
    {

        //$sponsors = Sponsor::all();
        $query = Sponsor::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('nom', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('adresse', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('telephone', 'LIKE', "%{$searchTerm}%");
        }

        $sponsors = $query->latest()->paginate(10);
        return view('admin.sponsors', compact(var_name: 'sponsors'));
    }

    public function destroySponsor(Request $request, Sponsor $sponsor)
    {
    $sponsor->delete();

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->back()
        ->with('success', 'La demande de sponsor a été supprimé avec succès.');
    }

    public function getNewsletters()
    {
        $letters = Newsletter::all();
        return view('admin.newsletter', compact(var_name: 'letters'));
    }

    // ═══════════════════════════════════════════════════════════
    //  GESTION UNIFIÉE DES INSCRIPTIONS
    // ═══════════════════════════════════════════════════════════

    public function inscriptions(Request $request)
    {
        $type   = $request->get('type', 'all');
        $status = $request->get('status', 'all');

        $programmeurs  = collect();
        $projets       = collect();
        $hackathons    = collect();
        $stands        = collect();

        if ($type === 'all' || $type === 'programmeur') {
            $q = Programmeur::with('user');
            if ($status !== 'all') $q->where('status', $status);
            $programmeurs = $q->latest()->get()->map(fn($r) => (object)[
                'id' => $r->id, 'type' => 'programmeur', 'label' => 'Programmeur',
                'nom' => $r->nom, 'email' => $r->email,
                'detail' => $r->type_concours, 'status' => $r->status,
                'user' => $r->user, 'created_at' => $r->created_at,
            ]);
        }

        if ($type === 'all' || $type === 'projet') {
            $q = ProjetDigital::with('user');
            if ($status !== 'all') $q->where('status', $status);
            $projets = $q->latest()->get()->map(fn($r) => (object)[
                'id' => $r->id, 'type' => 'projet', 'label' => 'Projet Digital',
                'nom' => $r->nom_equipe, 'email' => $r->email_chef_equipe,
                'detail' => $r->nom_projet . ' (' . $r->type_concours . ')',
                'status' => $r->status, 'user' => $r->user, 'created_at' => $r->created_at,
            ]);
        }

        if ($type === 'all' || $type === 'hackathon') {
            $q = Hackathon::with('user');
            if ($status !== 'all') $q->where('status', $status);
            $hackathons = $q->latest()->get()->map(fn($r) => (object)[
                'id' => $r->id, 'type' => 'hackathon', 'label' => 'Hackathon',
                'nom' => $r->nom_equipe, 'email' => $r->email_chef_equipe,
                'detail' => $r->niveau_etudes, 'status' => $r->status,
                'user' => $r->user, 'created_at' => $r->created_at,
            ]);
        }

        if ($type === 'all' || $type === 'stand') {
            $q = Stand::with('user');
            if ($status !== 'all') $q->where('status', $status);
            $stands = $q->latest()->get()->map(fn($r) => (object)[
                'id' => $r->id, 'type' => 'stand', 'label' => 'Stand',
                'nom' => $r->nom_entreprise, 'email' => $r->email_contact,
                'detail' => $r->secteur_activite, 'status' => $r->status,
                'user' => $r->user, 'created_at' => $r->created_at,
            ]);
        }

        $inscriptions = $programmeurs->concat($projets)->concat($hackathons)->concat($stands)
                            ->sortByDesc('created_at')->values();

        return view('admin.inscriptions', compact('inscriptions', 'type', 'status'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'type'   => 'required|in:programmeur,projet,hackathon,stand',
            'id'     => 'required|integer',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $model = match($request->type) {
            'programmeur' => Programmeur::findOrFail($request->id),
            'projet'      => ProjetDigital::findOrFail($request->id),
            'hackathon'   => Hackathon::findOrFail($request->id),
            'stand'       => Stand::findOrFail($request->id),
        };

        $oldStatus = $model->status;
        $model->update(['status' => $request->status]);

        // Notifier l'utilisateur si le statut change et s'il est lié à un compte
        if ($model->user_id && $oldStatus !== $request->status) {
            $typeLabels = [
                'programmeur' => 'Concours Meilleur Programmeur',
                'projet'      => 'Concours Meilleur Projet Digital',
                'hackathon'   => 'Hackathon',
                'stand'       => 'Réservation de Stand',
            ];
            $label = $typeLabels[$request->type] ?? 'Inscription';

            [$title, $message, $type, $icon] = match($request->status) {
                'approved' => [
                    "Inscription approuvée — {$label}",
                    "Félicitations ! Votre inscription au {$label} a été approuvée. Nous vous contacterons pour les prochaines étapes.",
                    'success', 'fas fa-check-circle',
                ],
                'rejected' => [
                    "Inscription non retenue — {$label}",
                    "Après examen de votre dossier, votre inscription au {$label} n'a pas pu être retenue. Contactez-nous pour plus d'informations.",
                    'error', 'fas fa-times-circle',
                ],
                default => [
                    "Statut mis à jour — {$label}",
                    "Le statut de votre inscription au {$label} a été mis à jour.",
                    'info', 'fas fa-info-circle',
                ],
            };

            UserNotification::create([
                'user_id' => $model->user_id,
                'title'   => $title,
                'message' => $message,
                'type'    => $type,
                'icon'    => $icon,
            ]);

            // Email à l'utilisateur lié au compte
            if ($model->user) {
                $nomParticipant = $model->nom ?? $model->nom_equipe ?? $model->nom_entreprise ?? $model->chef_equipe ?? '';
                try {
                    Mail::to($model->user->email)->send(new StatutInscriptionUpdated(
                        $label,
                        $nomParticipant,
                        $request->status,
                    ));
                } catch (\Exception) {}
            }
        }

        return response()->json(['success' => true, 'status' => $request->status]);
    }

    // ═══════════════════════════════════════════════════════════
    //  CRUD PROGRAMMEURS
    // ═══════════════════════════════════════════════════════════

    public function createProgrammeurForm()
    {
        $users = User::where('role', 'user')->orderBy('name')->get();
        return view('admin.programmeurs.create', compact('users'));
    }

    public function storeProgrammeurAdmin(Request $request)
    {
        $data = $request->validate([
            'nom'          => 'required|string|max:255',
            'email'        => 'required|email',
            'telephone'    => 'required|string',
            'niveau_etude' => 'required|string',
            'classe'       => 'required|string',
            'etablissement'=> 'required|string',
            'type_concours'=> 'required|in:CMPL,CMPS',
            'langages'     => 'required|array|min:1',
            'user_id'      => 'nullable|exists:users,id',
            'status'       => 'required|in:pending,approved,rejected',
        ]);

        Programmeur::create($data);

        return response()->json(['success' => true, 'message' => 'Programmeur ajouté avec succès.']);
    }

    public function destroyProgrammeur($id)
    {
        Programmeur::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ═══════════════════════════════════════════════════════════
    //  CRUD PROJETS DIGITAUX
    // ═══════════════════════════════════════════════════════════

    public function createProjetForm()
    {
        $users = User::where('role', 'user')->orderBy('name')->get();
        return view('admin.projets.create', compact('users'));
    }

    public function storeProjetAdmin(Request $request)
    {
        $data = $request->validate([
            'nom_equipe'          => 'required|string|max:255',
            'chef_equipe'         => 'required|string|max:255',
            'email_chef_equipe'   => 'required|email',
            'etablissement'       => 'required|string',
            'niveau_etude'        => 'required|string',
            'classe'              => 'required|string',
            'nom_projet'          => 'required|string|max:255',
            'description_projet'  => 'required|string',
            'lien_youtube'        => 'nullable|url',
            'type_concours'       => 'required|in:CMPDL,CMPDS',
            'user_id'             => 'nullable|exists:users,id',
            'status'              => 'required|in:pending,approved,rejected',
        ]);

        ProjetDigital::create($data);

        return response()->json(['success' => true, 'message' => 'Projet Digital ajouté avec succès.']);
    }

    public function destroyProjet($id)
    {
        ProjetDigital::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ═══════════════════════════════════════════════════════════
    //  CRUD HACKATHONS
    // ═══════════════════════════════════════════════════════════

    public function createHackathonAdminForm()
    {
        $users = User::where('role', 'user')->orderBy('name')->get();
        return view('admin.hackathons.create', compact('users'));
    }

    public function storeHackathonAdmin(Request $request)
    {
        $data = $request->validate([
            'nom_equipe'            => 'required|string|max:255',
            'nombre_participants'   => 'required|integer|min:1|max:10',
            'nom_chef_equipe'       => 'required|string|max:255',
            'telephone_chef_equipe' => 'required|string',
            'email_chef_equipe'     => 'required|email',
            'etablissement'         => 'required|string',
            'niveau_etudes'         => 'required|in:secondaire,superieur',
            'classe'                => 'required|string',
            'membres'               => 'required|array|min:1',
            'membres.*'             => 'required|string|max:255',
            'user_id'               => 'nullable|exists:users,id',
            'status'                => 'required|in:pending,approved,rejected',
        ]);

        Hackathon::create($data);

        return response()->json(['success' => true, 'message' => 'Hackathon ajouté avec succès.']);
    }

    public function destroyHackathonAdmin($id)
    {
        Hackathon::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ═══════════════════════════════════════════════════════════
    //  CRUD STANDS
    // ═══════════════════════════════════════════════════════════

    public function createStandAdminForm()
    {
        $users = User::where('role', 'user')->orderBy('name')->get();
        return view('admin.stands.create', compact('users'));
    }

    public function storeStandAdmin(Request $request)
    {
        $data = $request->validate([
            'nom_entreprise'      => 'required|string|max:255',
            'secteur_activite'    => 'required|string|max:255',
            'adresse'             => 'required|string',
            'email_contact'       => 'required|email',
            'telephone_contact'   => 'required|string',
            'taille_stand'        => 'required|string',
            'besoins_specifiques' => 'nullable|string',
            'user_id'             => 'nullable|exists:users,id',
            'status'              => 'required|in:pending,approved,rejected',
        ]);

        Stand::create($data);

        return response()->json(['success' => true, 'message' => 'Stand ajouté avec succès.']);
    }

    public function destroyStandAdmin($id)
    {
        Stand::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ═══════════════════════════════════════════════════════════
    //  GESTION DES UTILISATEURS
    // ═══════════════════════════════════════════════════════════

    public function users(Request $request)
    {
        $search = $request->get('search');
        $role   = $request->get('role', 'all');

        $users = User::when($search, fn($q) => $q->where('name', 'like', "%{$search}%")
                                                   ->orWhere('email', 'like', "%{$search}%"))
                     ->when($role !== 'all', fn($q) => $q->where('role', $role))
                     ->latest()->paginate(20);

        return view('admin.users', compact('users', 'search', 'role'));
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:user,admin',
            'phone'    => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'role'              => $data['role'],
            'phone'             => $data['phone'] ?? null,
            'email_verified_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Utilisateur créé avec succès.', 'id' => $user->id]);
    }

    public function updateUserRole(Request $request, $id)
    {
        $request->validate(['role' => 'required|in:user,admin']);
        User::findOrFail($id)->update(['role' => $request->role]);
        return response()->json(['success' => true]);
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Vous ne pouvez pas supprimer votre propre compte.'], 403);
        }
        $user->delete();
        return response()->json(['success' => true]);
    }

    public function exportUsersPdf()
    {
        $users = User::latest()->get();
        $pdf = Pdf::loadView('admin.exports.users-pdf', compact('users'))
                  ->setPaper('a4', 'landscape');
        return $pdf->download('utilisateurs-jsd.pdf');
    }

    public function exportUsersCsv()
    {
        $users = User::latest()->get();
        $headers = ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="utilisateurs-jsd.csv"'];
        $callback = function () use ($users) {
            $fh = fopen('php://output', 'w');
            fprintf($fh, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8
            fputcsv($fh, ['ID', 'Nom', 'Email', 'Téléphone', 'Rôle', 'Inscrit le'], ';');
            foreach ($users as $u) {
                fputcsv($fh, [$u->id, $u->name, $u->email, $u->phone ?? '', $u->role, $u->created_at->format('d/m/Y')], ';');
            }
            fclose($fh);
        };
        return response()->stream($callback, 200, $headers);
    }

    // ═══════════════════════════════════════════════════════════
    //  ENVOI DE NOTIFICATIONS
    // ═══════════════════════════════════════════════════════════

    public function notificationsAdmin()
    {
        $users = User::where('role', 'user')->orderBy('name')->get();
        $recent = UserNotification::with('user')->latest()->take(20)->get();
        return view('admin.notifications_send', compact('users', 'recent'));
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'target'  => 'required|in:all,user',
            'user_id' => 'required_if:target,user|nullable|exists:users,id',
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
            'type'    => 'required|in:info,success,warning,error',
        ]);

        $icon = match($request->type) {
            'success' => 'fas fa-check-circle',
            'warning' => 'fas fa-exclamation-triangle',
            'error'   => 'fas fa-times-circle',
            default   => 'fas fa-info-circle',
        };

        if ($request->target === 'all') {
            $users = User::where('role', 'user')->get();
            foreach ($users as $u) {
                UserNotification::create([
                    'user_id' => $u->id,
                    'title'   => $request->title,
                    'message' => $request->message,
                    'type'    => $request->type,
                    'icon'    => $icon,
                ]);
                try {
                    Mail::to($u->email)->send(new NotificationMail(
                        $request->title,
                        $request->message,
                        $request->type,
                        $u->name,
                    ));
                } catch (\Exception) {}
            }
            $count = $users->count();
            return response()->json(['success' => true, 'message' => "Notification envoyée à {$count} utilisateur(s)."]);
        }

        $targetUser = User::findOrFail($request->user_id);
        UserNotification::create([
            'user_id' => $targetUser->id,
            'title'   => $request->title,
            'message' => $request->message,
            'type'    => $request->type,
            'icon'    => $icon,
        ]);
        try {
            Mail::to($targetUser->email)->send(new NotificationMail(
                $request->title,
                $request->message,
                $request->type,
                $targetUser->name,
            ));
        } catch (\Exception) {}

        return response()->json(['success' => true, 'message' => 'Notification envoyée avec succès.']);
    }

    public function destroyNotification($id)
    {
        UserNotification::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // ══════════════════════════════════════════════════════════════
    //  PDF / CSV EXPORTS — Concours & Hackathons
    // ══════════════════════════════════════════════════════════════

    public function generatePdfCmpl()
    {
        $cmpl = Programmeur::where('type_concours', 'CMPL')->get();
        $pdf = Pdf::loadView('admin.exports.concours-programmeurs-pdf', [
            'participants' => $cmpl,
            'titre'        => 'Concours Meilleurs Programmeurs — Lycée (CMPL)',
            'colonnes'     => ['Nom', 'Établissement', 'Classe', 'Langages'],
            'champs'       => ['nom', 'etablissement', 'classe', 'langages'],
        ])->setPaper('a4', 'landscape');
        return $pdf->download('cmpl_participants.pdf');
    }

    public function generatePdfCmps()
    {
        $cmps = Programmeur::where('type_concours', 'CMPS')->get();
        $pdf = Pdf::loadView('admin.exports.concours-programmeurs-pdf', [
            'participants' => $cmps,
            'titre'        => 'Concours Meilleurs Programmeurs — Supérieur (CMPS)',
            'colonnes'     => ['Nom', 'Établissement', "Niveau d'étude", 'Langages'],
            'champs'       => ['nom', 'etablissement', 'niveau_etude', 'langages'],
        ])->setPaper('a4', 'landscape');
        return $pdf->download('cmps_participants.pdf');
    }

    public function generatePdfCmpdl()
    {
        $cmpdl = ProjetDigital::where('type_concours', 'CMPDL')->get();
        $pdf = Pdf::loadView('admin.exports.concours-projets-pdf', [
            'projets' => $cmpdl,
            'titre'   => 'Concours Meilleurs Projets Digitaux — Lycée (CMPDL)',
        ])->setPaper('a4', 'landscape');
        return $pdf->download('cmpdl_projets.pdf');
    }

    public function generatePdfCmpds()
    {
        $cmpds = ProjetDigital::where('type_concours', 'CMPDS')->get();
        $pdf = Pdf::loadView('admin.exports.concours-projets-pdf', [
            'projets' => $cmpds,
            'titre'   => 'Concours Meilleurs Projets Digitaux — Supérieur (CMPDS)',
        ])->setPaper('a4', 'landscape');
        return $pdf->download('cmpds_projets.pdf');
    }

    public function generatePdfHackatonSuperieur()
    {
        $hackathons = Hackathon::where('niveau_etudes', 'superieur')->get();
        $pdf = Pdf::loadView('admin.exports.hackaton-pdf', [
            'hackathons' => $hackathons,
            'titre'      => 'Participants Hackathon — Supérieur',
        ])->setPaper('a4', 'landscape');
        return $pdf->download('hackathon_superieur.pdf');
    }

    // ══════════════════════════════════════════════════════════════
    //  PDF / CSV EXPORTS — Newsletter & Sponsors
    // ══════════════════════════════════════════════════════════════

    public function exportNewsletterCsv()
    {
        $letters = Newsletter::orderBy('created_at', 'desc')->get();
        $headers = ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="newsletter_abonnes.csv"'];
        $callback = function () use ($letters) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // BOM UTF-8
            fputcsv($handle, ['Email', 'Date inscription'], ';');
            foreach ($letters as $l) {
                fputcsv($handle, [$l->email, $l->created_at->format('d/m/Y H:i')], ';');
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function destroyNewsletter($id)
    {
        Newsletter::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function exportSponsorsPdf()
    {
        $sponsors = Sponsor::latest()->get();
        $pdf = Pdf::loadView('admin.exports.sponsors-pdf', compact('sponsors'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('sponsors.pdf');
    }

    public function exportSponsorsCsv()
    {
        $sponsors = Sponsor::latest()->get();
        $headers = ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="sponsors.csv"'];
        $callback = function () use ($sponsors) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF");
            fputcsv($handle, ['Nom', 'Email', 'Téléphone', 'Adresse', 'Motivation'], ';');
            foreach ($sponsors as $s) {
                fputcsv($handle, [$s->nom, $s->email, $s->telephone, $s->adresse, $s->motivation], ';');
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }
}
