<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        // $catToSave = $request->category;
        $catStore = Category::firstOrNew(['categoryName' => $request->categoryName]);
        $catStore->save();

        return response()->json($catStore);
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
        $catToDelete = Category::findOrFail($id);

        if($catToDelete){
            $catToDelete->delete();

            return response('Deleted Successfully', 204);
        }
        else{
            return 0;
        }
    }
}
