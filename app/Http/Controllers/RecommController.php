<?php

namespace App\Http\Controllers;

use App\Models\ODPEvent;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;

class RecommController extends Controller
{

    public function index() {

		$odpEvents = ODPEvent::all();
        $eventCount = ODPEvent::count();

        //$idCluster = cluster de la personne connecté
        //$dataJson = data de l'api flask
        //$listeUserCluster = liste des users du meme cluster

        //foreach ( ) {
        //    Recupérer tout les event liké de la listeUsercluster
            //  $listeEventCluster = 
            
        //}
        
        //foreach ( ) {
        //    Supprimer de la liste les events deja liké par le user
        //}



         // Comptage et listing des tags

        $listeTags = ["Clubbing","Atelier","Humour","Concert","Musique","Danse","Théâtre","Conférence","Enfants","Sport","Cinéma","Loisirs","Littérature","Spectacle musical","Balade","Histoire","Nature","Art contemporain","Expo","LGBT","Peinture","Photo","Innovation","Cirque","BD","Sciences","Solidarité","Salon","Street-art","Gourmand"];
        $countTags = array();


        foreach ($listeTags  as $tag) {
            $countTags[$tag]= ODPEvent::where('tags', 'like','%'.$tag.'%')->count();
        }


        
        // Comptage des likes

        $currentUser = Auth::user();
        $likeCount = array();
        foreach ($listeTags  as $tag1) {
            $likeCount[$tag1]= $currentUser->likedEvents()->where('tags', 'like','%'.$tag1.'%')->count();
        }
         
        return View::make('dashboard', [
            'odpEvents' => $odpEvents,
            'eventCount' => $eventCount,
            'listeTags' => $listeTags,
            'countTags' => $countTags,
            'likeCount' => $likeCount
        ]);
    }
}