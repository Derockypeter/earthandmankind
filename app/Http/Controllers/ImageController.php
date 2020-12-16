<?php

namespace App\Http\Controllers;

use App\Image;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{

    public function postImageUploader(Request $request)
    {
        // $accepted_origins = array("http://localhost", "http://earthandmankind.org");
        $validator = Validator::make($request->all(), ['image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048']);
        if($validator->fails()){
            return ['error' => $validation->errors()->all() ];
        }
        else {
           if ($request->hasFile('image')) {
                $images = $request->image->getClientOriginalName();
                $images = time().'_'.$images; // Add current time before image name
                $path = $request->image->move(public_path('/posts/images/'),$images);
                $pathe = ("/posts/images/").$images;
                return response()->json(['location' => $pathe]);

            }
        }
    }
}
