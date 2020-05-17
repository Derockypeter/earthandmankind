<?php

namespace App\Http\Controllers;
use App\Video;
use Illuminate\Http\Request;
use Storage;
use Validator;

class VideoController extends Controller
{
    // Storing a video
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // 'videoName' => 'required',
            'videoName.*' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
            'category_id' => 'required',
            'title' => 'required'
        ]);
        if($validation->fails())
        {
            return response()->json(['error'   => $validation->errors()->all(), ]);
        }
        else{
            $input = $request->all();
            $input['videoName'] = $request->videoName->getClientOriginalName();
            $request->videoName->move(public_path('videos'), $input['videoName']);

            $videos = Video::create($input);
            
            return response()->json($videos);
        }       
    }
     // Fetch all Videos
    public function allVideos()
    {
        // if(auth()->user()){
            $video = new Video();
            
            if($video){
                $getVideo = $video::join('categories', 'videos.category_id', '=', 'categories.id')
                    ->select('videos.id', 'categoryName', 'videoName', 'title');
                return response()->json($getVideo->simplePaginate(5), 200);
            }
            else{
                return 0;
            }
        // }
    }
     // Fetch a single video
    public function video($video_title)
    {
        if(auth()->user()){
            $video = Video::where('title', $video_title);
            if(!empty($video)){
                return response()->json($video->get(), 200);
            }
            else{
                return 0;
            }
        }
    }

    // Get post to edit
    public function edit($id)
    {
        $video = Video::find($id);
        
        return response()->json($video);
    }

    // Editing a video -TODO LATER-TEST
    public function editVid(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'videoName.*' => 'nullable|mimes:video',
        ]);

        $videoToUpdate = Video::where('id', $id)->first();

        if($request->hasFile('videoName'))
        {
            $file = $request->file('videoName');
            $name = $file->getClientOriginalName();
            $file->move(public_path('videos'), $name);

            $videoToDelete = public_path("videos/{$video->videoName}");
            if (Video::exists($videoToDelete))
            {
                unlink($videoToDelete);
            }
            $videoToUpdate->videoName = $name;
            $videoToUpdate->category_id = $request->category_id;
            $videoToUpdate->title = $request->title;
        }
        elseif (!($request->hasFile('videoName'))) 
        {
            $videoToUpdate->category_id = $request->category_id;
            $videoToUpdate->title = $request->title;
        }
        $videoToUpdate->update();
        return response()->json($videoToUpdate);
    }
    // Deleting a video
    public function delete($id)
    {
        $video = Video::findOrFail($id);
        if ($video)
        {
            $videoToDelete = public_path("videos/{$video->videoName}");
            if ( file_exists($videoToDelete) )
            {
                unlink($videoToDelete);
            }
            $video->delete();
            return response()->json(null, 204);
        }
        else
        {
            return 0;
        }
    }
   
   
}
