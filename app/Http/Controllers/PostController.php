<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Image;
use App\Category;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Events\PostNotifier;
class PostController extends Controller
{
    // Store a new post
	public function savePost(Request $request)
	{
        $data = request()->validate([
			'body' => 'required',
            'title' => 'required|max:300|unique:posts',
            'category_id' => 'required',
            'image.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imagename' => 'required',
            'featured' => 'nullable'
        ]);
        if(!empty($data) && ($request->hasFile('image'))){
            $imageValidator = $request->file('image');
            $name = Str::slug($request->title).'.'.$imageValidator->getClientOriginalExtension() ;
            
            \Image::make($request->file('image'))->resize(400, 300)->save(public_path('blogImages/').$name);
            $imageToSave = Str::slug($request->title).'.'.$imageValidator->getClientOriginalExtension();
            
            $post = Post::create([
                'body' => $request->body,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'status' => 'published',
            ])->image()->create([
                'imagename' => $request->imagename,
                'image' => $imageToSave
            ]);
            $featured = new \App\Featured();
            if ($request->has('featured')){
                $featured->featured = $request->featured;
                $featured->post_id = $post->id;
                $featured->save();
            }
            // Image link
            $imageUrl = url('/'.$name);
            return response()->json(['post' => $post , 'featured' => $featured, 'message' => 'success'], 200);
        }
        elseif (!empty($data) && !($request->hasFile('image'))) {
            $post = Post::create([
               'body' => $request->body,
               'title' => $request->title,
               'category_id' => $request->category_id,
               'status' => 'published',
            ])->featured()->create([
                'featured' => $request->featured
            ]);
            return response()->json(['post' => $post, 'message' => 'success'], 200);
        }
		else{
			return 0;
		}
	}	
	// View a post by id
	public function getPost($id)
	{
		$posts = Post::where([
            ['posts.id', $id]
        ])
        ->join('images', 'posts.id', '=', 'images.post_id')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select('title', 'body', 'imagename', 'image', 'categoryName', 'posts.created_at', 'posts.id');
		if($posts){
			$post = $posts->get();
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
        $post = $posts->where([
            ['posts.title', $title]
        ])
        ->join('images', 'posts.id', '=', 'images.post_id')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select('title', 'body', 'image', 'imagename', 'categoryName', 'posts.created_at', 'posts.id')->get();
		if($post){
            $created_at = $post->first();
            
            $create = Carbon::parse($created_at['created_at'])->isoFormat('MMMM Do YYYY');
			return response()->json(['post' => $post, 'created' => $create]);
		}
		else{
			return 0;
		}
    }
    // Getting only posts with Bible Teachings
    public function bibleTeaching()
    {
        $categories = Category::where([
            ['categoryName', 'bible-teachings']
        ])
        ->join('posts', 'categories.id', '=', 'posts.category_id')
        ->join('images', 'posts.id', '=', 'images.post_id')
        ->select('title', 'body', 'image', 'name', 'categoryName', 'posts.created_at');
		if($categories){
			$category = $categories->get();
			return response()->json($category);
		}
		else{
			return 0;
		}
    }
    // Getting only posts with Bible-Teachings and is a fetured post
    public function featuredBibleTeaching()
    {
        $categories = Category::where([
            ['categoryName', 'bible-teachings']
        ])
        ->join('posts', 'categories.id', '=', 'posts.category_id')
        ->join('featureds', 'posts.id', '=', 'featureds.post_id')
        ->join('images', 'posts.id', '=', 'images.post_id')
        ->select('title', 'body', 'image', 'imagename', 'categoryName', 'posts.created_at', 'posts.id');
        if($categories){
            $category = $categories->latest('featureds.created_at')->take(1)->get();
            return response()->json($category);
        }
        else{
            return 0;
        }
    }
    // Getting all the post
    public function getAllPost()
    {
        $posts = Post::where('status', 'published')
            ->join('images', 'posts.id', '=', 'images.post_id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.id', 'title', 'body', 'image', 'imagename', 'categoryName', 'status', 'posts.created_at');
		if($posts){
            // dd($posts);
            $allPost = $posts->latest('images.created_at')->simplePaginate(9);
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
            $post = $featurePosts->with('post')->latest()->take(3)->get();
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
	public function editPost(Request $request, $id) // TODO:Test editing with an image
	{
        $data = $this->dataToValidate();
        $post = Post::findOrFail($id);
        $image = new Image();
        // dd($imageToDelete);
        if($request->hasFile('image'))//If request has images
        {
            $image = $request->file('image');
            $imageToDelete = $post->images()->get(['image']);
            if (Image::exists($imageToDelete)) { // unlink or remove previous image from folder
                unlink($imageToDelete);
            }
            //update both images and other fields
            $post->body = $request->body;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->save();

            $image = new Image();
            $imageToSave = $image->getClientOriginalName();
            $image->image = $imageToSave;
            $image->imagename = $request->imagename;
            $image->save();
            
            \Image::make($request->file('image'))->resize(300, 200)->save(public_path('blogImages/').$imageToSave);
            
            return response()->json(['post' => $post, 'post-image' => $post->image()->get()]);
        }
        elseif (!$request->hasFile('image')){
            $post->body = $request->body;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->save();

            if ($request->has('imagename')){
                $imageToSave = $image->getClientOriginalName();
                $image->image = $imageToSave;
                $image->imagename = $request->imagename;
                $image->save();
            }
            return response()->json($post);
        }
	}

	// Admin deletion of a post
	public function deletePost($id)
	{
        $post = Post::findOrFail($id);
        if ($post)
        {
            $imageToDelete = public_path("blogImages/{$post->image['image']}");
            if ( file_exists($imageToDelete) )
            {
                unlink($imageToDelete);
            }
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
            'title' => 'required|max:300', //TODO: make title to be unique:posts
            // 'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            // 'imagename' => 'required'
            
		]);
		if($validator){
			return $validator;
		}
		else{
			return 0;
		}
	}
}
