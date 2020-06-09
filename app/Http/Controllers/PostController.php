<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Image;
use App\Category;
use Storage;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;
class PostController extends Controller
{
    // Store a new post
	public function savePost(Request $request)
	{
        $posts = new Post();
        $data = Validator::make($request->all(), [
			'body' => 'required',
            'title' => 'required|max:300|unique:posts',           
            'featured' => 'nullable',
            'language_id' => 'required'
        ]);
        if ($data->fails()){
            return response()->json(['errors' => $data->errors()->all()]);
        }
        else {
            if($request->has('featured')) {
                $post = $posts->create([
                'body' => $request->body,
                'title' => $request->title,
                'language_id' => $request->language_id,
                'status' => 'published'
                ])->featured()->create([
                    'featured' => $request->featured
                ]);
                return response()->json(['post' => $post,'message' => 'success'], 200);
            }
            else {
                $post = $posts->create([
                    'body' => $request->body,
                    'title' => $request->title,
                    'language_id' => $request->language_id,
                    'status' => 'published'
                ]);
                return response()->json(['post' => $post,'message' => 'success'], 200);
            }  
        } 
       
	}	
	// View a post by id
	public function getPost(Request $request, $id)
	{
		$posts = Post::where('id', $id);
		if($posts){
			$post = $posts->language()->get();
			return response()->json($post);
		}
		else{
			return 0;
        }
    }
    // Getting posts by title
    public function byTitle($title)
    {
        $posts = new Post();
        $post = Post::where('title', $title);
		if($post){
            $created_at = $post->first();
            $create = Carbon::parse($created_at['created_at'])->isoFormat('MMMM Do YYYY');
			return response()->json(['post' => $post->first(), 'created' => $create]);
		}
		else{
			return 0;
		}
    }
    // Getting all the post
    public function getAllPost()
    {
        $posts = Post::with('language');
        if($posts){
            $allPost = $posts->latest()->simplePaginate(10);
		    return response()->json($allPost);
		}
		else{
			return 0;
		}
    }
    // Gets all fatured post by latest
    public function featuredPost()
    {
        $featurePosts = new \App\Featured();
        if ($featurePosts) {
            $post = $featurePosts->with(['post'])->latest()->take(6)->get();
            return response()->json($post);
        }
        else {
            return 0;
        }
    }
     // Disables a Post
	public function disablePost(Request $request, $post_id)
	{
		$posts = Post::where([
			['id', $post_id],
			['status', 'published']
        ]);
		if($posts){
			$disablePost = $posts->update(['status' => 'disabled']);
			return response()->json($disablePost, 200);
		}
		else{
			return 0;
		}
	}
    // Viewing Disabled Posts
	public function disabledPosts()
	{
        $posts = Post::where('status', 'disabled')
        ->join('images', 'posts.id', '=', 'images.post_id')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select('title', 'body', 'image', 'name', 'categoryName');
        if($posts){
            $disabledPosts = $posts->paginate(5);
            return response()->json($disabledPosts);
        }
        else{
            return 0;
        }
	}
    // Get post to edit
    public function edit($id)
    {
      $posts = Post::findOrFail($id);
      if ($posts) {
        return response()->json($posts);
      }
      else {
          return 0;
      }
    }
	// Editing of a Post
	public function editPost(Request $request, $id) 
	{
        $data = $this->dataToValidate();
        $post = Post::findOrFail($id);
        if (!empty($data)) {
            $post->body = $request->body;
            $post->title = $request->title;
            $post->language_id = $request->language_id;

            $post->save(); 
            return response()->json(['post' => $post]);
        }
        else {
            return 0;
        }
	}

	// Admin deletion of a post
	public function deletePost($id)
	{
        $post = Post::findOrFail($id);
        if ($post)
        {
            $post->delete();
            return response()->json(null, 204);
        }
        else
        {
            return 0;
        }
	}
	// Data to validate for post
	protected function dataToValidate()
	{
		$validator = request()->validate([
			'body' => 'required',
            'title' => 'required|max:300', 
            'language_id' => 'required'            
		]);
		if($validator){
			return $validator;
		}
		else{
			return 0;
		}
	}
}
