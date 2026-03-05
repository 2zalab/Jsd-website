<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Edition;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share the current edition with all views
        View::composer('*', function ($view) {
            static $edition = null;
            if ($edition === null) {
                try {
                    $edition = Edition::courante() ?? new Edition([
                        'nom'    => "JSD",
                        'numero' => 1,
                        'annee'  => date('Y'),
                        'theme'  => '',
                        'lieu'   => 'Maroua, Cameroun',
                    ]);
                } catch (\Throwable $e) {
                    $edition = new Edition([
                        'nom'    => "JSD",
                        'numero' => 1,
                        'annee'  => date('Y'),
                        'theme'  => '',
                        'lieu'   => 'Maroua, Cameroun',
                    ]);
                }
            }
            $view->with('edition', $edition);
        });
    }
}
