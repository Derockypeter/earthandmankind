<?php

namespace App\Http\Controllers;

use App\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tour = Tour::paginate(20);
        if ($tour){
            return response()->json($tour);
        }
        else {
            return 0;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tour = Tour::create([
            'country' => $request->country,
            'state' => $request->state,
            'stateRadioStation' => $request->stateRadioStation,
            'programTime' => date("H:i:s", strtotime($request->programTime)),
            'programDate' => $request->programDate,
            'period' => $request->period
        ]);
        return response()->json($tour);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        if ($tour) {
            return response()->json($tour);
        }
        else {
            return 0;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        // $tour = Tour::findOrFail($id);
        if ($tour) {
            $newTour = $tour->update([
                'country' => $request->country,
                'state' => $request->state,
                'stateRadioStation' => $request->stateRadioStation,
                'programTime' => date("H:i:s", strtotime($request->programTime)),
                'programDate' => $request->programDate,
                'period' => $request->period,
            ]);
            return response()->json($newTour);
        }
        else {
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        if ($tour) {
            $tour->delete();
            return response()->json(['message' => 'Tour deleted'], 204);
        }
        else {
            return 0;
        }
    }

    public function latestTen(){
        $tour = Tour::all()->sortBy('programDate')->take(10);
        if ($tour){
            return response()->json($tour);
        }
        else {
            return 0;
        }
    }
}
