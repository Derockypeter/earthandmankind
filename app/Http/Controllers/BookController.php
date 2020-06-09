<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Book;
use Validator;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:books',
            'description' => 'required|unique:books',
            'language_id' => 'required',
            'path' => 'required',
            'path.*' => 'file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:20000',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all() ]);
        }
        else{
            $input = $request->all();
            $input['path'] = $request->path->getClientOriginalName();
            $input['image'] = Str::slug($request->name).'.'.$input['image']->getClientOriginalExtension() ;

            $request->path->move(public_path('books/path'), $input['path']);
            \Image::make($request->file('image'))->resize(100, 110)->save(public_path('books/images/').$input['image']);

            $book = Book::insert($input);
            
            return response()->json(['message' => 'Book Uploaded Successfully', 'Created' => $book], 200);
        }       
    }

    // Reads all books
    public function getAllBooks()
    {
        $books = Book::with('language')->simplePaginate(5);
        if($books){
            return response()->json($books, 200);
        }
        else{
            return 0;
        }
    }
    // Fetches a single book by name
    public function book($book_name)
    {
        $books = Book::where('name', $book_name)->get();
        if($books){
            return response()->json($books);
        }
        else{
            return 0;
        }
    }
    // Fetches book-fields for editing
    public function edit($id)
    {
        $book = Book::find($id);
        
        return response()->json($book);
    }
    // Editing a book
    public function editBook(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:books',
            'description' => 'required|unique:books',
            'language' => 'required',
            'path' => 'required',
            'path.*' => 'file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:20000',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $bookToUpdate = Book::where('id', $id)->first();

        if($request->hasFile('path' && 'image'))
        {
            $file = $request->file('path');
            $file2 = $request->file('image');
            $name = $file->getClientOriginalName();
            $name2 = $file->getClientOriginalName();
            $file->move(public_path('books/path'), $name);
            $file2->move(public_path('books/images'), $name2);

            $pathToDelete = public_path("books/path/{$book->path}");
            if (Book::exists($pathToDelete))
            {
                unlink($pathToDelete);
            }
            $imageToDelete = public_path("books/path/{$book->path}");
            if (Book::exists($imageToDelete))
            {
                unlink($imageToDelete);
            }
            $bookToUpdate->path = $name;
            $bookToUpdate->image = $name2;
            $bookToUpdate->language = $request->language;
            $bookToUpdate->description = $request->description;
            $bookToUpdate->name = $request->name;

        }
        elseif ($request->hasFile('path')) 
        {
            $file = $request->file('path');
            $name = $file->getClientOriginalName();
            $file->move(public_path('books/path'), $name);
            $pathToDelete = public_path("books/path/{$book->path}");
            if (Book::exists($pathToDelete))
            {
                unlink($pathToDelete);
            }

            $bookToUpdate->path = $name;
            $bookToUpdate->language = $request->language;
            $bookToUpdate->description = $request->description;
            $bookToUpdate->name = $request->name;

        }
        elseif ($request->hasFile('path')) 
        {
            $file2 = $request->file('image');
            $name2 = $file2->getClientOriginalName();
            $file2->move(public_path('books/images'), $name2);
            $imageToDelete = public_path("books/images/{$book->image}");
            if (Book::exists($imageToDelete))
            {
                unlink($imageToDelete);
            }
            
            $bookToUpdate->image = $name2;
            $bookToUpdate->language = $request->language;
            $bookToUpdate->description = $request->description;
            $bookToUpdate->name = $request->name;

        }
        else{
            $bookToUpdate->language = $request->language;
            $bookToUpdate->description = $request->description;
            $bookToUpdate->name = $request->name;
            // $bookToUpdate->save();
        }

        $bookToUpdate->save();
        return response()->json($bookToUpdate);
    }
    // Deleting a Book
    public function delete($id)
    {
        $book = Book::findOrFail($id);
        if ($book)
        {
            $bookToDelete = public_path("books/path/{$book->path}");
            if ( file_exists($bookToDelete))
            {
                unlink($bookToDelete);
            }
            $imageToDelete = public_path("books/images/{$book->image}");
            if ( file_exists($imageToDelete))
            {
                unlink($imageToDelete);
            }
            $book->delete();
            return response()->json(null, 204);
        }
        else
        {
            return 0;
        }
    }
   
}
