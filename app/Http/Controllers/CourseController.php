<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Video;
use Validator;
use Str;

class CourseController extends Controller
{
    // Storing a video
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'video.*' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:200000',
            'coursename' => 'required',
            'requirements' => 'required',
            'about' => 'required',
            'language_id' => 'required',
            'to_learn' => 'required',
            'preview' => 'nullable',
            'description' => 'required',
            'section' => 'required',
            'name' => 'required',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all(), ]);
        }
        else{ 
            $imageValidator = $request->file('image');
            $name = Str::slug($request->coursename).'.'.$imageValidator->getClientOriginalExtension() ;
            
            \Image::make($request->file('image'))->resize(400, 300)->save(public_path('courseImages/').$name);
            $imageToSave = Str::slug($request->coursename).'.'.$imageValidator->getClientOriginalExtension();
            
            $inputVideo = $request->video->getClientOriginalName();
            $request->video->move(public_path('videos'), $inputVideo);
            
            $video = Course::updateOrCreate([
                'coursename' => $request->coursename,
                'description' => $request->description,
                'to_learn' => $request->to_learn,
                'requirements' => $request->requirements,
                'language_id' => $request->language_id,
                'image' => $imageToSave
            ])->videos()->updateOrCreate([
                'preview' => $request->preview,
                'video' => $inputVideo,
                'name' => $request->name,
                'section' => $request->section,
                'about' => $request->about,
            ]);
            return response()->json(['course' => $video]);
        }       
    }
    // Gets a video by course name 
    public function course($title)
    {   
        $courses = new Course();
        $video = new Video();
        $course_id = json_encode($courses->where([['coursename', $title]])->get('id'));
        $course_id_decode = json_decode($course_id);
        foreach ($course_id_decode as $key => $value) {
            $value->id;
        }
        $course = $courses::where([['coursename', $title]])->with('language', 'videos')->get();
        
        $vidpreview = $video->where([
            ['preview', 'true'],
            ['course_id', $value->id]
        ])->get();
        $vid = $video->where([
            ['preview', 'false'],
            ['course_id', $value->id]
        ])->get();
        if ($course) {
            return response()->json(['course' => $course, 'preview' => $vidpreview, 'othervids' => $vid]);
        }
        else {
            return 0;
        }
    }
    // Gets all the courses and its videos
    public function allCourse()
    {
        $courses = Course::with(['videos']);
        return response()->json($courses->get());
    }
    // Getting all the video associated with a course
    public function videos($id)
    {
        $course = Course::find($id);
        if ($course) {
            $videos = $course->videos;
            return response()->json($videos);
        }
        else {
            return 0;
        }
    }
    // Add a video/Edit a coursename
    public function editCourse($id)
    {
        $course = Course::where('id', $id);
        if ($course) {
            return response()->json($course->get());
        }
        else{
            return 0;
        }
    }
    // Updating a course
    public function updateCourse(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'coursename' => 'required',
            'description' => 'required',
            'name' => 'required',
            'section' => 'required',
            'language' => 'required'
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all(), ]);
        }
        else {
            $updateInput = $request->only(['language', 'coursename', 'description', 'name', 'section']);
            $course = Course::where('id', $id)->update($updateInput);
            return response()->json($course);
        }
    }
    // Delete a course and its video
    public function deleteCourse($id)
    {
        $courseToDel = CourseTitle::findOrFail($id);
        if ($courseToDel){
            $courseToDel->delete();
            return response()->json([$courseToDel, 204]);
        }
    }

}
