<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Edition;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // French locale for all Carbon dates
        Carbon::setLocale('fr');

        // Share the current edition and global stats with all views
        View::composer('*', function ($view) {
            static $edition  = null;
            static $stats    = null;

            if ($edition === null) {
                try {
                    $edition = Edition::courante() ?? new Edition([
                        'nom'    => "JSD",
                        'numero' => 1,
                        'annee'  => date('Y'),
                        'theme'  => '',
                        'lieu'   => 'Maroua, Cameroun',
                    ]);
                    $stats = [
                        'participants' => Edition::sum('stats_participants') ?: 500,
                        'projets'      => Edition::sum('stats_projets')      ?: 11,
                        'programmeurs' => Edition::sum('stats_programmeurs') ?: 30,
                        'editions'     => Edition::count()                   ?: 1,
                    ];
                } catch (\Throwable $e) {
                    $edition = new Edition([
                        'nom'    => "JSD",
                        'numero' => 1,
                        'annee'  => date('Y'),
                        'theme'  => '',
                        'lieu'   => 'Maroua, Cameroun',
                    ]);
                    $stats = ['participants' => 500, 'projets' => 11, 'programmeurs' => 30, 'editions' => 1];
                }
            }

            $view->with('edition', $edition);
            $view->with('stats',   $stats);
        });
    }
}
