<?php

namespace App\Http\Controllers;
use App\Video;
use App\Course;
use Illuminate\Http\Request;
use Str;
use Storage;
use Validator;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return response()->json($videos);
    }
    // Stores a new video for a course
    public function storeVideo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'youtubeEmbedUrl' => 'required|unique:videos|url',
            'about' => 'required',
            'name' => 'required',
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all(), ]);
        }
        else{ 
            $video = Video::create([
                'youtubeEmbedUrl' => $request->youtubeEmbedUrl,
                'name' => $request->name,
                'about' => $request->about,
            ]);
            return response()->json(['video' => $video, 'success' => 200]);
        }  
    }
    // Fetch a single video
    public function video($id)
    {
        $video = Video::where('id', $id)->firstOrFail();
        if(!empty($video)){
            return response()->json($video, 200);
        }
        else{
            return 0;
        }
    }
    
    public function videoName($videoName)
    {
        $video = Video::where('name', $videoName);
        if($video){
            return response()->json($video->first());
        }
        else {
            return 0;
        }
    }

    // Get video to edit
    public function edit($video_id)
    {
        $video = Video::whereId($video_id);
        if($video){
            return response()->json($video->firstOrFail());
        }
        else {
            return 0;
        }
    }
    // Editing a video -TODO LATER-TEST
    public function editVid(Request $request, $id)
    {
        $videoToUpdate = Video::where('id', $id);
        $updated = $videoToUpdate->update([
            "about" => $request->about,
            "name" => $request->name,
            "youtubeEmbedUrl" => $request->youtubeEmbedUrl
        ]);
        return response()->json($updated);
    }
    // Deleting a video from a course
    public function delete($video_id)
    {
        $video = Video::findOrFail($video_id);
        if ($video)
        {
            $video->delete();
            return response()->json(null, 204);
        }
        else
        {
            return 0;
        }
    }
   
}
