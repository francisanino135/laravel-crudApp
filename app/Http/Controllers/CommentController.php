<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function show($postId)
    {
        $comments = Comment::where('post_id', $postId)->get(); // Or any query to fetch comments
        return view('comments.index', compact('comments'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'media.*' => 'nullable|file|mimes:jpeg,png,gif,mp4,mov,avi|max:20480', // 20MB
        ]);

        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('uploads', 'public'); // Store file in the 'public/uploads' directory
                $mediaPaths[] = $path; // Add the path to the mediaPaths array
            }
        }

        // Create the post
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'media' => $mediaPaths, // Save the media as a JSON-encoded array
        ]);


        // $post = Post::find($request->post_id);
        // $firebasePath = "posts/{$post->id}/comments/{$comment->id}";
        // $this->firebase->setData($firebasePath, $comment);

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', $comment->post_id)->with('status', 'Comment created successfully!');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'comment' => 'nullable|string|max:255',
            'media.*' => 'nullable|file|mimes:jpeg,png,gif,mp4,mov,avi|max:20480', // 20MB
        ]);

        // Attempt to find the comment
        $comment = Comment::find($id);

        // Check if the comment exists
        if (!$comment) {
            return redirect()->route('posts.index')->with('error', 'Comment not found.');
        }

        // Check if the user is authorized to update the comment
        if ($comment->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized to update this comment.');
        }

        $mediaPaths = $comment->media ?? []; // Preserve existing media

        // Handle media files
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('uploads', 'public'); // Store file in 'public/uploads'
                $mediaPaths[] = $path; // Append new file paths
            }
        }

        // Update the comment
        $comment->update([
            'comment' => $request->comment,
            'media' => $mediaPaths, // Ensure media is stored correctly
        ]);

        // // Update Firebase
        // $post = Post::find($comment->post_id);
        // $firebasePath = "posts/{$post->id}/comments/{$comment->id}";
        // $this->firebase->setData($firebasePath, $comment);

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', $comment->post_id)->with('status', 'Comment updated successfully!');
    }



    public function destroy(Comment $comment)
    {
        // Check if the logged-in user is the owner of the comment
        if ($comment->user_id !== auth()->id()) {
            return redirect()->route('posts.show', $comment->post_id)->with('error', 'Unauthorized to delete this comment.');
        }

        // Delete the comment
        $comment->delete();

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', $comment->post_id)->with('status', 'Comment deleted successfully!');
    }
}
