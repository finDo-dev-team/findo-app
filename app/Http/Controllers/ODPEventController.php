<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ODPEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ODPEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $req_date_min = $request->date_min != NULL ? $request->date_min : Carbon::now()->toDateString();
        $req_date_max = $request->date_max != NULL ? $request->date_max : Carbon::now()->addMonth()->toDateString();
        $req_title = $request->title != NULL ? $request->title : "";
        $req_tag = $request->tag != NULL ? $request->tag : "";

        $odpEvents = ODPEvent::orderBy('date_start')
                        ->where('date_end', '>', $req_date_min)
                        ->where('date_start', '<', $req_date_max)
                        ->where('title', 'like', '%'.$req_title.'%')
                        ->where('tags', 'like', '%' . $req_tag . '%')
                        ->get();

        return View::make('odpEvent.index', [
            'odpEvents' => $odpEvents,
            'search_title' => $req_title,
            'search_tag' => $req_tag,
            'search_date_min' => $req_date_min,
            'search_date_max' => $req_date_max
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ODPEvent  $odpEvent
     * @return \Illuminate\Http\Response
     */
    public function show(ODPEvent $odpEvent)
    {
        return View::make('odpEvent.show', [
            'odpEvent' => $odpEvent
        ]);
    }

    public function diagram () {

		// La vue "diagram"
		return view("diagram", compact('odpEvents'));
    } 
}
