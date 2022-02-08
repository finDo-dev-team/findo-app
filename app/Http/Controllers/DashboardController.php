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
        return View::make('dashboard', [
            'odpEvents' => $odpEvents,
            'eventCount' => $eventCount
        ]);
    }
}
