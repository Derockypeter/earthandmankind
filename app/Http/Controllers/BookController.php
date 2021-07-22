<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Book;
use Validator;
use Storage;
use ZipArchive;

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
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'audio_path' => 'nullable',
            'audio_path.*' => 'file|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav|max:50000',
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

           
            $name = $request->name;
            if($request->hasFile('audio_path')){
                $input['audio_path'] = Str::slug($request->name).'.'.$input['audio_path']->getClientOriginalExtension();
                $request->audio_path->move(public_path('audio/audio_path'), $input['audio_path']);
            }
            $input['path'] = Str::slug($request->name).'.'.$input['path']->getClientOriginalExtension();
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
                'path' => $book->path,
                'audioPath' => $book->audio_path,
            ];
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
    public function update(Request $request, $bookId)
    {
        $book = Book::where('id', $bookId)->first();
        $book->name = $request->name;
        $book->description = $request->description;
        $book->language_id = $request->language_id;
        $book->amount = $request->amount;

        $book->save();
       
        return response()->json(['book' => $book, 'status' => 200]);
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
        $pathToFile = './books/path/'.$book->path;
        $pathToAudio = './audio/audio_path/'.$book->audio_path;
        $name = $book->name;
        $files = array($pathToFile, $pathToAudio);
        $zipname = "'$book->name.zip'";
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file, );
        }
        if (count($zip) > 2) {
            $zip->deleteIndex(0);
            $zip->deleteIndex(1);
        }
        $zip->close();
        return response()->download($zipname);
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
