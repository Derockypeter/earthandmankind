<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    // Saves a category and its image
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'catImage' => 'required',
            'catImage.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoryName' => 'required'
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all(), ]);
        }
        else {
            $input = $request->all();
            $input['catImage'] = Str::slug($request->categoryName).'.'.$input['catImage']->getClientOriginalExtension() ;

            \Image::make($request->file('catImage'))->resize(400, 200)->save(public_path('category_img/').$input['catImage']);

            $catStore = Category::firstOrCreate($input);
            return response()->json(['message' => 'Category created Successfully', 'Created' => $catStore], 200);
        }
    }

    // Reads all category
    public function getAllCategory()
    {
        $category = Category::get();;
        if($category){
            return response()->json($category);
        }
        else{
            return 0;
        }
    }

     // Get post to edit
    public function edit($id)
    {
        $category = Category::find($id);
        if($category){
            return response()->json($category);
        }
        else{
            return 0;
        }
    }

    // Updates a category ? 'edit'
    public function updateCategory(Request $request, $id)
    {
        $catToUpdate = Category::findOrFail($id);
        if($catToUpdate){
            $catToUpdate->update($request->only(['categoryName']));

            return response()->json($catToUpdate, 200);
        }
        else{
            return 0;
        }
    }

    // Deletes a Category
    public function delete($id)
    {
        $category = Category::findOrFail($id);

        if($category){
            $catToDelete = public_path("category_img/{$category->catImage}");
            if ( file_exists($catToDelete))
            {
                unlink($catToDelete);
            }
            $category->delete();

            return response('Deleted Successfully', 204);
        }
        else{
            return 0;
        }
    }
}