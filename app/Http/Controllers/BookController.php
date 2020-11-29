<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Book;
use Validator;
use Storage;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:books',
            'description' => 'required|unique:books',
            'language_id' => 'required',
            'path' => 'required',
            'path.*' => 'file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:50000',
            'image' => 'required',
            'amount' => 'nullable',
            'preview' => 'nullable',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($validation->fails())
        {
            return response()->json(['error' => $validation->errors()->all() ]);
        }
        else{
            $input = $request->all();
            if($request->hasFile('preview')){
                $input['preview'] = $request->preview->getClientOriginalName();
                $request->preview->move(public_path('books/preview/'), $input['preview']);
            }
            $input['path'] = $request->path->getClientOriginalName();
            $input['image'] = Str::slug($request->name).'.'.$input['image']->getClientOriginalExtension() ;

            $request->path->move(public_path('/books/path/'),$input['path']);
            
            ini_set('memory_limit','256M');
            \Image::make($request->file('image'))->resize(500, 590)->save(public_path('/books/images/').$input['image']);

            $book = Book::insert($input);
            return response()->json(['message' => 'Book Uploaded Successfully', 'Created' => $book, 'status' => 'success'], 200);
        }       
    }

    // Reads all books
    public function getAllBooks()
    {
        $books = Book::with('language')->get();
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
        $books = new Book();
        $book = $books->where('name', $book_name)->first();
        if($book->count()){
            return [
                'amount' => $book->amount,
                'id' => $book->id,
                'description' => $book->description,
                'image' => $book->image,
                'name' => $book->name,
            ];
            // return response()->json(['book' => $book], 200);
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
            'preview' => 'nullable', 'file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:20000',
            'amount' => 'nullable',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $bookToUpdate = Book::where('id', $id)->first();

        if($request->hasFile('path' && 'image' && 'preview'))
        {
            $file = $request->file('path');
            $file1 = $request->file('preview');
            $file2 = $request->file('image');
            $name = $file->getClientOriginalName();
            $name1 = $file1->getClientOriginalName();
            $name2 = $file2->getClientOriginalName();
            $file->move(public_path('books/path'), $name);
            $file2->move(public_path('books/images'), $name2);
            $file1->move(public_path('books/preview'), $name1);

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

    // Download the book
    public function download($id){
        $book = Book::whereId($id)->first();
        $pathToFile = public_path('books/path/').$book->path;
        $name = $book->name;
        return response()->download($pathToFile, $name);
    }

    // Makes an api call to paystack to verify payment
    public function getUserData(Request $request){
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$request->transaction_id/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".config('flutterwave.secretKey'),
                "Cache-Control: no-cache",
            ),
          ));
          
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
        
    
}
