<?php

namespace App\Http\Controllers;

use App\Events\SendNotification;
use App\Http\Requests\PostRequest;
use App\Http\Traits\ImageTrait;
use App\Models\Post;
use App\Models\Scopes\PostScope;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
     /**
     * add middleware with different guards to some functions.
     */
    public function __construct()
    {
        if(Auth::guard('admin')->check())
        {
            $this->middleware('auth:admin')->except(['index','search','show']);
        }
        elseif(Auth::guard('web')->check())
        {
        $this->middleware('auth')->except(['index','show','waiting','accept','decline','search']);
        }
    }
    /**
     * Display a listing of the resource.
     */
    use ImageTrait;
    public function index()
    {
        $posts=Post::paginate(6);
        return view('home',compact('posts'));
    }

     /**
     * Display a user posts.
     */
    public function postUser($id)
        {
        $posts = Post::with('author')->where('user_id', $id)->paginate(5);

        // Check if no posts are found for the given user_id
        if ($posts->isEmpty()) {
            $posts = Post::with('author')->where('user_id',null)->paginate(5);
        }

        return view('blog.myblogs', compact('posts'));
    
            }

    /**
     * Display a pinned posts.
     */
    public function waiting()
    {
        $posts = Post::withoutGlobalScope(PostScope::class)->where('status','0')->paginate(10);
        return view('blog.blogrequests',compact('posts'));
    }

     /**
     * approve a pinned posts.
     */
    public function accept($id)
    {
        $post = Post::withoutGlobalScope(PostScope::class)->find($id);
        $post->status='1';
        $post->update();
        return redirect()->route('post.requests')->with(['success'=>'post accepted successfully']);
        //and we have another function with task schedular
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.addblog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
            // Validate in rules of PostRequest
            $request->validated();

            // Prepare post data
            $postData = [
                'title' => $request->title,
                'summary' => $request->summary,
                'content' => $request->content,
                'user_id' => $request->user_id,
            ];

            // Handle image upload by call trait
            $postData['image'] = $this->ImageTrait($request, 'image');
            
            // Create the post
            $post = Post::create($postData);

            // Update status if the user has other posts or if admin
            $userPosts = Post::where('user_id', $post->user_id)->count();
            if ($userPosts >= 1||$post->user_id==null) {
                $post->status = '1';
                $post->update();
            }
            //event related with pusher
            $data=[
                'user_id'=>$post->user_id,
                'title'=>$post->title,
                'summary'=>$post->summary,
            ];
            event(New SendNotification($data));
            return redirect()->route('post.create')->with('success', 'Post added successfully');
   }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog=Post::with('users')->find($id);
        return view('blog.singleblog',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post=Post::find($id);
        return view('blog.editblog',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id)
    {
        $post=Post::find($id);
        $request->validated();
            $post->update([
                'title'=>$request->title,
                'summary'=>$request->summary,
                'content'=>$request->content,
                'user_id'=>$request->user_id,
                //using trait to write clean code and to write his function once a time
                'image'=>$this->ImageTrait($request, 'image')]);  
            return redirect()->route('post.index')->with(['success'=>'post updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->route('post.index')->with(['success'=>'post deleted successfully']);
    }

     /**
     * Remove pinned post .
     */
    public function decline($id)
    {
        $post=Post::withoutGlobalScope(PostScope::class)->find($id);
        $post->delete();
        return redirect()->route('post.requests')->with(['success'=>'post declined successfully']);
    }

     /**
     * search for specified post.
     */

    public function search(HttpRequest $request)
    {
        $query = $request->input('query');
    
        // Search in the `title` and `content` columns
        $posts = Post::where('title', 'LIKE', "%{$query}%")
                     ->orWhere('content', 'LIKE', "%{$query}%")
                     ->paginate(6); // Paginate the results
    
        return view('blog.searchresult', compact('posts', 'query'));
    }
    
}
