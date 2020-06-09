<?php
 
 namespace App\Http\Controllers;
  
 use Illuminate\Http\Request;
 use App\Http\Requests;
 use App\ContactUS;
  
 class ContactUSController extends Controller
 {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUS()
    {
        return view('contact.contact-us');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactSaveData(Request $request)
    {
        $this->validate($request, [
         'name' => 'required',
         'subject' => 'required',
         'email' => 'required|email',
         'message' => 'required'
         ]);
  
       ContactUS::create($request->all()); 
    
     \Mail::send('contact.contactus',
        array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'user_message' => $request->get('message')
        ), function($message) use ($request)
    {
       $message->from($request->get('email'));
       $message->to('amaizupeter1@gmail.com', 'Admin')->subject($request->get('subject'));
    });
  
     return response()->json(['Thanks for contacting us!, We\'ll get back to you soon']); 
    }
 }