<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Concours;
use App\Models\Stand;
use App\Models\Hackathon;
use App\Models\Programmeur;
use App\Models\ProjetDigital;
use App\Models\Sponsor;
use App\Models\Newsletter;
use TCPDF;



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
    $pdf = \Barryvdh\DomPDF\PDF::loadView('admin.stands_pdf', compact('stands'));
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






}
