<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InscriptionConcours;
use App\Models\Programmeur;
use App\Models\ProjetDigital;
use App\Models\Hackathon;
use App\Models\Stand;
use App\Models\Sponsor;
use App\Models\Contact;
use App\Models\Newsletter;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //$stats = $this->getStats();
        $recentMessages = Contact::latest()->take(5)->get();
         return view('admin.index',compact('recentMessages'));
        //return view('admin.dashboard', compact('stats', 'recentMessages', 'recentInscriptions'));
    }

    private function getStats()
    {
        return [
            'concours' => [
                'cmpl_count' => Programmeur::where('type_concours', 'CMPL')->count(),
                'cmps_count' => Programmeur::where('type_concours', 'CMPS')->count(),
                'cmpdl_count' => ProjetDigital::where('type_concours', 'CMPDL')->count(),
                'cmpds_count' => ProjetDigital::where('type_concours', 'CMPDS')->count(),
            ],
            'hackathons' => [
                'lyceen_count' => Hackathon::where('niveau_etudes', 'secondaire')->count(),
                'senior_count' => Hackathon::where('niveau_etudes', 'superieur')->count(),
            ],
            'stands_count' => Stand::count(),
            'sponsors_count' => Sponsor::count(),
            'messages_count' => Contact::count(),
            'newsletter_subscribers_count' => Newsletter::count(),
        ];
    }

    public function programmeurs()
    {
        $programmeurs = Programmeur::latest()->paginate(20);
        return view('admin.programmeurs', compact('programmeurs'));
    }

    public function projetsDigitaux()
    {
        $projets = ProjetDigital::latest()->paginate(20);
        return view('admin.projets-digitaux', compact('projets'));
    }

    public function hackathons()
    {
        $hackathons = Hackathon::with('membres')->latest()->paginate(20);
        return view('admin.hackathons', compact('hackathons'));
    }

    public function stands()
    {
        $stands = Stand::latest()->paginate(20);
        return view('admin.stands', compact('stands'));
    }

    public function sponsors()
    {
        $sponsors = Sponsor::latest()->paginate(20);
        return view('admin.sponsors', compact('sponsors'));
    }

    public function messages()
    {
        $messages = Contact::latest()->paginate(20);
        return view('admin.messages', compact('messages'));
    }

    public function newsletter()
    {
        $subscribers = Newsletter::latest()->paginate(20);
        return view('admin.newsletter', compact('subscribers'));
    }

    public function statistiques()
    {
        $statsParJour = DB::table('projet_digitals')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->limit(30)
            ->get();

        $statsParTypeConcours = DB::table('projet_digitals')
            ->select('type_concours', DB::raw('COUNT(*) as count'))
            ->groupBy('type_concours')
            ->get();

        return view('admin.statistiques', compact('statsParJour', 'statsParTypeConcours'));
    }


    public function exportProgrammeurs()
    {
        $programmeurs = Programmeur::all();
        // Logique d'export
    }

    public function exportProjetsDigitaux()
    {
        $projets = ProjetDigital::all();
        // Logique d'export
    }

    public function exportHackathons()
    {
        $hackathons = Hackathon::with('membres')->get();
        // Logique d'export
    }

    public function exportStands()
    {
        $stands = Stand::all();
        // Logique d'export
    }

    public function exportSponsors()
    {
        $sponsors = Sponsor::all();
        // Logique d'export
    }

    public function exportNewsletter()
    {
        $subscribers = Newsletter::all();
        // Logique d'export
    }
}
