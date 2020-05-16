<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|unique:books',
            'description' => 'required|unique:books',
            'category_id' => 'nullable',
            'path' => 'required',
            'path.*' => 'mimes:doc,docx,pdf,zip|max:20000',
            'image' => 'required',
            'image.*' => 'mimes:'
        ]);
        if($validation->fails())
        {
            return response()->json(['error'   => $validation->errors()->all(), ]);
        }
        else{
            $input = $request->all();
            $input['path'] = $request->path->getClientOriginalName();
            $input['image'] = $request->image->getClientOriginalName();

            $request->path->move(public_path('books/path'), $input['path']);
            // $request->image->move(public_path('books/images'), $input['image']);
            \Image::make($request->file('image'))->resize(50, 100)->save(public_path('books/images').$input['image']);

            $book = Book::insert($input);
            
            return response()->json(['message' => 'Book Uploaded Successfully', 'Created' => $book], 200);
        }       
    }

    // Reads all category
    public function getAllBooks()
    {
        $books = new Book();
        if($books){
            $getBooks = $books::join('categories', 'books.category_id', '=', 'categories.id')
                ->select('books.id', 'name', 'description', 'categoryName', 'path', 'image');
            return response()->json($getBooks->simplePaginate(5), 200);
        }
        else{
            return 0;
        }
    }
    // Getting only posts with Bible Teachings
    public function bibleTeaching()
    {
        $books = Category::where([
            ['categoryName', 'bible-teachings']
        ])
        ->join('books', 'categories.id', '=', 'books.category_id')
        ->select('name', 'description', 'categoryName', 'path');
		if($books){
			$book = $books->get();

			return response()->json($book);
		}
		else{
			return 0;
		}
    }
    // Fetches a single book by name
    public function book($book_name)
    {
        $books = Book::where('name', $book_name)
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('name', 'description', 'categoryName', 'path', 'images');
        if($books){
            $book = $books->get();

            return response()->json($book);
        }
        else{
            return 0;
        }
        // }
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
            'path' => 'nullable|mimes:doc,docx,pdf,epub,zip|max:20000',
        ]);

        $bookToUpdate = Book::whereId($id);

        if($request->hasFile('path'))
        {
            $file = $request->file('path');
            $name = $file->getClientOriginalName();
            $file->move(public_path('books'), $name);

            $bookToDelete = public_path("books/{$book->path}");
            if (Book::exists($bookToDelete))
            {
                unlink($bookToDelete);
            }
            $bookToUpdate->path = $name;
            $bookToUpdate->category_id = $request->category_id;
            $bookToUpdate->description = $request->descritpion;
            $bookToUpdate->name = $request->name;

        }
        elseif (!($request->hasFile('videoName'))) 
        {
            $bookToUpdate->category_id = $request->category_id;
            $bookToUpdate->description = $request->descritpion;
            $bookToUpdate->name = $request->name;

        }
        $bookToUpdate->update();
        return response()->json($bookToUpdate);
    }
    // Deleting a video
    public function delete($id)
    {
        $book = Book::findOrFail($id);
        if ($book)
        {
            $bookToDelete = public_path("books/{$book->path}");
            if ( file_exists($bookToDelete) )
            {
                unlink($bookToDelete);public_path("books/{$book->path}");
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
