<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\Post;

class CommentController extends Controller
{
    public function storeComment(Request $request, $id)
    {
        // If user is authenticated, then user can comment
        $post = new Post();
        $post = $post->findOrFail($id);

        $data = request([
            'user_id', // Auth->user
            'comment'
        ]);
        if($data){
            $post->comments()->create($data);
            return response()->json($post->comments()->latest('created_at')->get(), 200);
        }
        else {
            return 0;
        }
    }
    // For retrieving all posts-comments
    public function getAllComments()
    {
        $comment = Comment::all();
        return response()->json($comment);
    }
    // Retrieving comments for a post
    public function getCommentsForAPost($id)
    {
        $post = Post::findOrFail($id);
        if($post){
            $postComments = $post->comments()->get();
            return response()->json($postComments);
        }
        else{
            return 0;
        }
    }
    // Editing a comment
    public function editComment(Request $request, $postId, $commentId)
    {
        // If user is authenticated, then user can edit his own comment
        $comment = Comment::where('id', $commentId);
        if($comment){
            $newComment = $comment->update($request->only(['comment']));

            return response()->json($newComment);
        }
        else{
            return 0;
        }

    }
    // Deleting a comment
    public function deleteComment($id)
    {
        // If user is authenticated, then user can delete his own comment
        $comment = Comment::where('id', $id);

        if($comment){
            $comment->delete();
            return response()->json(null, 204);
        }
        else {
            return 0;
        }
    }
    // Retrieving all comments of user from posts
    public function getUserComment($id)
    {
        $userComments = User::where('users.id', $id)
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->join('comments', 'posts.id', '=', 'comments.post_id')
            ->select('comment');
        if($userComments){
            $userComments->get();
            return response()->json($userComments);
        }
        else{
            return 0;
        } 
    }

    public function getUserCommentInPost($userId, $postId)
    {
        if(auth::user){
            $userComment = User::where([
                ['users.id', $userId],
                ['posts.id', $postId]
            ])
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->join('comments', 'posts.id', '=', 'comments.post_id')
            ->select('comment');
            if($userComment){
                $userComment->get();
                return response()->json($userComment);
            }
        }
        else{
            return response()->json(['message' => 'Please login to see comment'], 0);
        }
    }

    
}
