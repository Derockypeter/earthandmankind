<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Image;
use App\Category;
use Storage;
use Carbon\Carbon;
use App\Events\PostNotifier;
class PostController extends Controller
{
    // Store a new post
	public function publishPost(Request $request)
	{
        $data = request()->validate([
			'body' => 'required',
            'title' => 'required|max:300|unique:posts', //TODO: make title to be unique:posts
            'imageName' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
			'category_id' => 'required'
        ]);
        if(!empty($data) && ($request->hasFile('imageName'))){
            $imageValidator = $request->file('imageName');
            $name = $imageValidator->getClientOriginalName();
            
            \Image::make($request->file('imageName'))->resize(500, 400)->save(public_path('blogImages/').$name);
            
            $post = new Post();
            $post->body = $request->body;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->status = 'published';
            $post->save();

            // Image link
            $imageUrl = url('/'.$name);

            $image = new Image();
            $imageToSave = $imageValidator->getClientOriginalName();
            $image->imageName = $imageToSave;
            $image->post_id = $post['id'];
            $image->save();
            // if($post){
            //     $post = Post::where('id', $post->id)->first();
                
                // event(new PostNotifier($post));  //TODO MAKE AN EVENT EMITTER
    
                return response()->json(['post' => $post, 'url' => $imageUrl, 'message' => 'success'], 200);
            // }
        }
        elseif (!empty($data) && !($request->hasFile('imageName'))) {
            $post = new Post();
            $post->body = $request->body;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->status = 'published';
            $post->save();
            // if($post){
            //     $post = Post::where('id', $post->id)->first();
                
            //     event(new PostNotifier($post));
    
                return response()->json(['post' => $post, 'message' => 'success'], 200);
            // }
        }
        
		else{
			return 0;
		}
	}
	// Publishes a post on the timeline
	public function savePost(Request $request)
	{
		$data = request()->validate([
			'body' => 'required',
            'title' => 'required|max:300|unique', //TODO: make title to be unique:posts
            'imageName' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
			'category_id' => 'required'
        ]);
        if(!empty($data) && ($request->hasFile('imageName'))){
            $imageValidator = $request->file('imageName');
            $name = $imageValidator->getClientOriginalName() ;

            \Image::make($request->file('imageName'))->resize(300, 200)->save(public_path('blogImages/').$name);

            $post = new Post();
            $post->body = $request->body;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->status = 'unpublished';
            $post->save();

            $imageUrl = url('/'.$name);
            $image = new Image();
            $imageToSave = url('/', $imageValidator->getClientOriginalName());
            $image->imageName = $imageToSave;
            $image->post_id = $post['id'];
            $image->save();

            return response()->json(['post' => $post, 'url' => $imageUrl, 'message' => 'success'], 200);
        }
        elseif (!empty($data) && !($request->hasFile('imageName'))) {
            $post = new Post();
            $post->body = $request->body;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->status = 'unpublished';
            $post->save();

            return response()->json(['post' => $post, 'message' => 'success'], 200);
        }
		else {
			return 0;
		}
	}
	// Viewing all Posts that are "published" for only Admin"
	public function getPosts()
	{
        $posts = Post::where('status', 'published')
            ->join('images', 'posts.id', '=', 'images.post_id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('title', 'body', 'imageName', 'categoryName', 'posts.created_at');
		if($posts){
            $allPost = $posts->simplePaginate(5);
		    return response()->json($allPost);
		}
		else{
			return 0;
		}
	}		
	// View a post
	public function getPost($title)
	{
		$posts = Post::where([
            ['posts.title', $title]
        ])
        ->join('images', 'posts.id', '=', 'images.post_id')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select('title', 'body', 'imageName', 'categoryName', 'posts.created_at');
		if($posts){
            // dd($posts->created_at);
            // Carbon::parse($posts->created_at)->isoFormat('MMMM Do YYYY, h:mm:ss a');
			$post = $posts->get();

			return response()->json($post);
		}
		else{
			return 0;
		}

    }
    // Getting posts by category
    public function categorizedPost($category_id)
    {
        $posts = Post::where([
            ['posts.category_id', $category_id]
        ])
        ->join('images', 'posts.id', '=', 'images.post_id')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select('title', 'body', 'imageName', 'categoryName', 'posts.created_at', 'category_id');
		if($posts){
            // dd($posts->created_at);
            // Carbon::parse($posts->created_at)->isoFormat('MMMM Do YYYY, h:mm:ss a');
			$post = $posts->get();

			return response()->json($post);
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
        ->select('title', 'body', 'imageName', 'categoryName', 'posts.created_at');
		if($categories){
			$category = $categories->get();

			return response()->json($category);
		}
		else{
			return 0;
		}
    }
    // Getting all the post
    public function getAllPost()
    {
        $posts = Post::join('images', 'posts.id', '=', 'images.post_id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.id', 'title', 'body', 'imageName', 'categoryName', 'status')
            ->orderBy('posts.id');
		if($posts){
            $allPost = $posts->simplePaginate(20);
		    return response()->json($allPost);
		}
		else{
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
        ->select('title', 'body', 'imageName', 'categoryName');
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
      $post = Post::find($id);
      return response()->json($post);
    }
	// Editing of a Post
	public function editPost(Request $request, $id) // TODO:Test editing with an image
	{
        $data = $this->dataToValidate();
        $post = Post::findOrFail($id);
        $image = new Image();
        // dd($imageToDelete);
        if($request->hasFile('imageName'))//If request has images
        {
            $image = $request->file('imageName');
            $imageToDelete = $post->images()->get(['imageName']);
            if (Image::exists($imageToDelete)) { // unlink or remove previous image from folder
                Storage::delete(public_path('blogImages/'{$imageToDelete}));
            }
            //update both images and other fields
            $post->body = $request->body;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->save();

            $image = new Image();
            $imageToSave = $image->getClientOriginalName();
            $image->imageName = $imageToSave;
            $image->save();
            
            \Image::make($request->file('imageName'))->resize(300, 200)->save(public_path('blogImages/').$imageToSave);
            
            return response()->json(['post' => $post, 'post-image' => $post->images()->get()]);
        }
        elseif (!$request->hasFile('imageName')){
            $post->body = $request->body;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->save();
            return response()->json($post);
        }
	}

	// Admin deletion of a post
	public function deletePost($id)
	{
        $post = Post::findOrFail($id);
        if ($post)
        {
            $imageToDelete = $post->images()->first('imageName');
            $imageToDelete = public_path("blogImages/{$imageToDelete}");
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
            'image' => 'nullable|jpg,png',
			'category_id' => 'required'
		]);
		if($validator){
			return $validator;
		}
		else{
			return 0;
		}
	}
}
