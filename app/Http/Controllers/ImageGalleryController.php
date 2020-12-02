<?php

namespace App\Http\Controllers;

use App\ImageGallery;
use App\Http\Resources\ImageGalleryResource;
use Illuminate\Http\Request;
use Validator;
use Str;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource for end Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function general()
    {
        $image = ImageGallery::all()->sortBy('created_at');
        return response(['image_gallery' => new ImageGalleryResource($image), 'message' => 'Retrieved Success'], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = ImageGallery::all()->sortBy('created_at');
        return response(['image_gallery' => new ImageGalleryResource($image), 'message' => 'Retrieved Success'], 200);
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
        $validation =  Validator::make($request->all(), [
            'desc' => 'required',
            'name' => 'mimes:jpeg,png,jpg,gif,svg,max:2048,required',
            'tags' => 'nullable',
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all() ]);
        }
        else{
            $name = $request->file('name')->getClientOriginalName();
            \Image::make($request->file('name'))->resize(500, 590)->save(public_path('images/').$name);
            $image = ImageGallery::create([
                'name' => $name,
                'desc' => $request->desc,
                'tags' => $request->tags,
            ]);
            return response(['image-gallery' => new ImageGalleryResource($image), 'message' => 'Image registered Successfully', 'status' => 200]);
       
            return response()->json(['errors' => $data->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function show(ImageGallery $ImageGallery)
    {
        return response(['image-gallery' => new ImageGalleryResource($ImageGallery), 'message' => 'Retrieved Success'], 200);
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
    public function update(Request $request, ImageGallery $ImageGallery)
    {
        $ImageGallery->update($request->only('desc', 'name', 'tags'));
        return response([ 'image-gallery' => new ImageGalleryResource($ImageGallery), 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageGallery $ImageGallery)
    {
        $imageToDelete = public_path("images/{$ImageGallery->name}");
        if ( file_exists($imageToDelete))
        {
            unlink($imageToDelete);
        }
        
        $ImageGallery->forceDelete();
        return response()->json(['message' => null], 204);
    }
}
