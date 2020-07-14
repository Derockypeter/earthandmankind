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
    // Stores a new video for a course
    public function storeVideo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'video.*' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:200000',
            'about' => 'required',
            'section' => 'required',
            'name' => 'required',
            'course_id' => 'required',
            'preview' => 'required',
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all(), ]);
        }
        else{ 
            $inputVideo = $request->video->getClientOriginalName();
            $request->video->move(public_path('videos'), $inputVideo);
            
            $video = Video::updateOrCreate([
                'preview' => $request->preview,
                'video' => $inputVideo,
                'name' => $request->name,
                'section' => $request->section,
                'about' => $request->about,
                'course_id' => $request->course_id
            ]);
            return response()->json(['video' => $video]);
        }  
    }
    // Fetch a single video
    public function video($id)
    {
        $video = Video::where('id', $id);
        if(!empty($video)){
            return response()->json($video->get(), 200);
        }
        else{
            return 0;
        }
    }
    
    // Get video to edit
    public function edit($video_id)
    {
        $video = Video::where('videos.id', $video_id);
        if($video){
            $videos = $video->join('course_titles', 'videos.course_title_id', '=', 'course_titles.id' )
                ->select('coursename', 'video', 'name', 'section', 'preview');
            return response()->json($videos->get());
        }
        else {
            return 0;
        }
    }
    // Editing a video -TODO LATER-TEST
    public function editVid(Request $request, $id)
    {
        $request->validate([
            'coursename' => 'required',
            'preview' => 'required',
            'name' => 'required',
            'section' => 'required',
            'video.*' => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime|max:20000',
        ]);

        $videoToUpdate = Video::where('id', $id);

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
            $videoToUpdate->video = $name;
            $videoToUpdate->coursename = $request->coursename;
            $videoToUpdate->name = $request->name;
            $videoToUpdate->section = $request->section;
        }
        elseif (!($request->hasFile('videoName'))) 
        {
            $videoToUpdate->coursename = $request->coursename;
            $videoToUpdate->name = $request->name;
            $videoToUpdate->section = $request->section;
        }
        $videoToUpdate->update();
        return response()->json($videoToUpdate);
    }
    // Deleting a video from a course
    public function delete($video_id)
    {
        $video = Video::findOrFail($video_id);
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

    /**
     * We're using the video controller for both Courses and videos
     * Here is deleting a course and it entire content and also from the server
     */
    // public function deleteCourse($course_id)
    // {
    //     $course = Course::find($course_id);
        
    //     if ($course) {
    //         $courseVid = json_encode($course->videos()->get('videoName'));
    //         // $coursedec = \json_decode($courseVid);
    //         // $fatty = [{'videoname': 'Lets talk about it'}, {'videoname': 'More practice'}];

    //         // dd($courseVid);
    //         foreach ($courseVid as $courseDel) {
    //             dd($courseDel);

    //         }
    //         $courseToDelete = public_path("videos/{$courseDel->videoName}");
    //         // dd(json_encode($courseVid), json_decode($courseVid));

            
    //         if ( file_exists($videoToDelete) )
    //         {
    //             unlink($videoToDelete);
    //         }
    //         $video->delete();
    //         return response()->json(null, 204);
    //     }
    //     else
    //     {
    //         return 0;
    //     }
        
    // }
   
   
}
