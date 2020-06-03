<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Video;

class CourseController extends Controller
{
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
        $course = $courses::where([['coursename', $title]])->with('category')->get();
        
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
        $courses = Course::with(['videos', 'category']);
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
            'category_id' => 'required',
            'coursename' => 'required',
            'description' => 'required',
            'name' => 'required',
            'section' => 'required'
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all(), ]);
        }
        else {
            $updateInput = $request->only(['category_id', 'coursename', 'description', 'name', 'section']);
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
