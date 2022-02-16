<?php

namespace App\Http\Controllers;

use App\Models\ODPEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;

class DashboardController extends Controller
{

    public function index() {

		$odpEvents = ODPEvent::all();
        $eventCount = ODPEvent::count();
        
        
        $listeTags = ["Clubbing","Atelier","Humour","Concert","Musique","Danse","Théâtre","Conférence","Enfants","Sport","Cinéma","Loisirs","Littérature","Spectacle musical","Balade","Histoire","Nature","Art contemporain","Expo","LGBT","Peinture","Photo","Innovation","Cirque","BD","Sciences","Solidarité","Salon","Street-art","Gourmand"];
        $countTags = array();
        foreach ($listeTags  as $tag) {
            $countTags[$tag]= ODPEvent::where('tags', 'like','%'.$tag.'%')->count();
        }        
        
        return View::make('dashboard', [
            'odpEvents' => $odpEvents,
            'eventCount' => $eventCount,
            'listeTags' => $listeTags,
            'countTags' => $countTags
        ]);
    }
}
