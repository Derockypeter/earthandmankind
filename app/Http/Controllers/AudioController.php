<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Http\Request;
use App\Http\Resources\AudioResource;

use Illuminate\Support\Str;
use Validator;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audio = Audio::with('language')->get()->sortBy('audio.created_at');
        return response(['audio' => new AudioResource($audio), 'message' => 'Retrieved Success'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:audio',
            'description' => 'required|unique:audio|max:500',
            'language_id' => 'nullable',
            'audio_path' => 'required',
            'audio_path.*' => 'file|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav|max:50000',
            'cover_image' => 'nullable',
            'cover_image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all() ]);
        }
        else{
            $input = $request->all();
            $input['audio_path'] = $request->audio_path->getClientOriginalName();
            $request->audio_path->move(public_path('audio/audio_path'), $input['audio_path']);

            if($request->hasFile('cover_image')){
                $input['cover_image'] = Str::slug($request->name).'.'.$input['cover_image']->getClientOriginalExtension() ;
                \Image::make($request->file('cover_image'))->resize(500, 590)->save(public_path('audio/images/').$input['cover_image']);
            }

            $audio = Audio::create($input);
            return response(200);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function show(Audio $audio)
    {
        return response(['audio' => new AudioResource($audio), 'message' => 'Retrieved Success'], 200);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audio $audio)
    {
        $audio->update($request->only('name', 'description', 'language_id'));
        return response([ 'audio' => new AudioResource($audio), 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Audio  $audio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audio $audio)
    {
        $audioToDelete = public_path("audio/audio_path/{$audio->audio_path}");
        if ( file_exists($audioToDelete))
        {
            unlink($audioToDelete);
        }
        $imageToDelete = public_path("audio/images/{$audio->cover_image}");
        if ( file_exists($imageToDelete))
        {
            unlink($imageToDelete);
        }
        $audio->forceDelete();
        return response()->json(null, 204);
    }

    // Fetches a single audio by name
    public function audio($audio_name)
    {
        $audio = new Audio();
        $audio = $audio->where('name', $audio_name)->first();
        if($audio->count()){
            return response()->json(['audio' => $audio], 200);
        }
        else{
            return 0;
        }
    }

    // Fetches audio-fields for editing
    public function getEdit($id)
    {
        $audio = Audio::find($id);
        
        return response()->json($audio);
    }
}
