<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // protected $firebase;

    // public function __construct(FirebaseService $firebase)
    // {
    //     $this->firebase = $firebase;
    // }

    public function show($id)
    {
        $post = Post::with('comments')->withCount('comments')->findOrFail($id); // Load post with comments and count
        return view('posts.show', compact('post'));
    }


    public function showCreatePostForm()
    {
        return view('posts.create');
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'media.*' => 'nullable|file|mimes:jpeg,png,gif,mp4,mov,avi|max:20480', // 20MB
        ]);

        $mediaPaths = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('uploads', 'public');
                $mediaPaths[] = $path;
            }
        }

        // Create the post
        $post = Post::create([
            'user_id' => auth()->id(), // Ensure user is authenticated
            'title' => $request->title,
            'body' => $request->body,
            'media' => $mediaPaths,
        ]);

        // $this->firebase->setData("posts/{$post->id}", $post);

        return redirect()->route('posts.index')->with('status', 'Post created successfully!');
    }

    public function index(Request $request)
    {
        // Get search query from request
        $search = $request->input('search');

         // Fetch all registered users from the database with post count
         $users = User::withCount('posts')->get()->keyBy('id'); // Store users in a lookup table (key = user ID)

        // Fetch posts, filter if search query exists
        $posts = Post::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%");
        })->latest()->get();

        // Return the view with posts data
        return view('posts.index', compact('posts', 'search', 'users'));
    }


    // public function index(Request $request)
    // {
    //     // Get search query from request
    //     $search = $request->input('search');
    
    //     // Fetch all registered users from the database with post count
    //     $users = User::withCount('posts')->get()->keyBy('id'); // Store users in a lookup table (key = user ID)
    
    //     // Fetch posts from Firebase
    //     $firebasePosts = $this->firebase->getReference('posts')->getValue();
    
    //     // Convert Firebase data to an array
    //     $posts = collect($firebasePosts)->map(function ($post, $key) use ($users) {
    //         // Fetch user from the lookup table instead of querying the database multiple times
    //         $user = $users[$post['user_id'] ?? null] ?? null;
    
    //         // Fetch comments count for the post
    //         $comments = $this->firebase->getReference("posts/{$key}/comments")->getValue();
    //         $commentsCount = is_array($comments) ? count($comments) : 0; // Count comments if they exist
    
    //         return (object) array_merge($post, [
    //             'id' => $key, // Include Firebase key as 'id'
    //             'user' => $user, // Attach user object from lookup table
    //             'comments_count' => $commentsCount, // Attach comments count
    //         ]);
    //     });
    
    //     // Apply search filter if a query exists
    //     if ($search) {
    //         $posts = $posts->filter(function ($post) use ($search) {
    //             return stripos($post['title'], $search) !== false || stripos($post['body'], $search) !== false;
    //         });
    //     }
    
    //     // Pass users and posts to the view
    //     return view('posts.index', compact('posts', 'search', 'users'));
    // }
    
    
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Check if the logged-in user is the owner of the post
        if ($post->user_id != auth()->id()) {
            return redirect()->route('posts.index')->withErrors(['error' => 'You are not authorized to edit this post.']);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'media.*' => 'nullable|file|mimes:jpeg,png,gif,mp4,mov,avi|max:20480', // 20MB
        ]);

        $post = Post::findOrFail($id);

        // Check if the logged-in user is the owner of the post
        if ($post->user_id != auth()->id()) {
            return redirect()->route('posts.index')->withErrors(['error' => 'You are not authorized to edit this post.']);
        }

        // Delete old media files if new media is provided
        if ($request->hasFile('media')) {
            if (!empty($post->media)) {
                foreach ($post->media as $mediaItem) {
                    Storage::disk('public')->delete($mediaItem); // Delete old media files
                }
            }

            // Store new media files
            $mediaPaths = [];
            foreach ($request->file('media') as $file) {
                $path = $file->store('uploads', 'public'); // Store file in the 'public/uploads' directory
                $mediaPaths[] = $path; // Add the new file path to the mediaPaths array
            }
        } else {
            $mediaPaths = $post->media; // Keep old media if no new media is uploaded
        }

        // Update the post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'media' => $mediaPaths, // Save the updated media as a JSON-encoded array
        ]);

        // Update the post in Firebase
        // $this->firebase->updateData("posts/{$post->id}", $post->toArray());

        return redirect()->route('posts.index')->with('status', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {

        // Check if the logged-in user is the owner of the post
        if ($post->user_id != auth()->id()) {
            return redirect()->route('posts.index')->withErrors(['error' => 'You are not authorized to delete this post.']);
            ;
        }

        // // Delete post from Firebase Realtime Database
        // $firebasePath = "posts/{$post->id}";
        // $this->firebase->deleteData($firebasePath);

        // Delete the post from sql
        $post->delete();

        // Redirect back to the posts list with a success message
        return redirect()->route('posts.index')->with('status', 'Post deleted successfully!');
    }


}