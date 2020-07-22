<?php

namespace App\Http\Controllers;

use App\Dictionary;
use App\Http\Resources\DictionaryResource;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dictionary = Dictionary::all()->sortBy('word');
        return response(['dictionary' => new DictionaryResource($dictionary), 'message' => 'Retrieved Success'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'word' => 'required',
            'meanings' => 'required'
        ]);
        if ($data) {
            $dictionary = Dictionary::updateOrCreate($data);
            return response(['dictionary' => new DictionaryResource($dictionary), 'message' => 'Dictionary registered Successfully'], 200);
        }
        else {
            return response()->json(['errors' => $data->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function show(Dictionary $dictionary)
    {
        return response(['dictionary' => new DictionaryResource($dictionary), 'message' => 'Retrieved Success'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function edit(Dictionary $dictionary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dictionary $dictionary)
    {
        $dictionary->update($request->only('word', 'meanings'));
        return response([ 'dictionary' => new DictionaryResource($dictionary), 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dictionary $dictionary)
    {
        $dictionary->delete();
        return response()->json(['message' => null], 204);
    }
}
