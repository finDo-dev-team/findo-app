<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ODPEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ODPEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $req_date_min = $request->date_min != NULL ? $request->date_min : Carbon::now();
        $req_date_max = $request->date_max != NULL ? $request->date_max : Carbon::now()->addCentury();
        $req_title = $request->title != NULL ? $request->title : "";
        $req_tag = $request->tag != NULL ? $request->tag : "";

        $odpEvents = ODPEvent::orderBy('date_start')
                        ->where('date_end', '>', $req_date_min)
                        ->where('date_start', '<', $req_date_max)
                        ->where('title', 'like', '%'.$req_title.'%')
                        ->where('tags', 'like', '%' . $req_tag . '%')
                        ->get();

        //dd($odpEvents->count());

        return View::make('odpEvent.index', [
            'odpEvents' => $odpEvents
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
}
