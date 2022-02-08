<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function diagram () {

		// Les catégories avec les produits. On peut aussi utiliser la méthode withCount() d'Eloquent
		$ODPEvents = ODPEvent::with("events")->get();

		// La vue "diagram" avec les catégories
		return view("diagram", compact('ODPEvents'));
    }
}
