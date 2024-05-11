<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Node\Block\Document;

class PostsController extends Controller
{
    private function file_operations($request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filepath = $image->store("images", "posts_uploads");
            return $filepath;
        }
        return null;
    }
    public function index()
    {
        $posts = Post::paginate(5);
        foreach ($posts as $post) {
            $post->creation = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('H:i d/M/Y');
        }
        return view("index", compact('posts'));
    }
    public function create()
    {
        $users = User::all();
        return view("create", ["users" => $users]);
    }

    public function store(Request $request) 
    {
        $request_params = $request;
        $image_path = $this->file_operations($request_params);
        $post = new Post();
        $post->title = $request_params['title'];
        $post->body = $request_params['body'];
        $post->creator_id = 563;
        $tags =explode(',',$request_params['tags']);
        $post->image = $image_path;
        $post->save();
        $post->attachTags($tags);

        return to_route('posts.show', $post->id);
    }
    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post['creation'] = Carbon::createFromFormat('Y-m-d H:i:s', $post['created_at'])->format('H:i d/M/Y');
            return view('show', ['post' => $post]);
        }
        return abort(404);
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        return view("edit", ["post" => $post, "users" => $users]);
    }
    public function update(Request $request,$id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize("update",  $post);
        $request_data = $request->all();
        $image_path = $this->file_operations($request);
        $post->image = $image_path? 'images'.$image_path : $post->image;
        $post->update($request_data );
        return to_route("posts.show", $post->id);
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        //return redirect()->route("posts.index")->withMethod('GET');
    }
    public function restoreAll()
    {
        Post::onlyTrashed()->restore();
        return to_route("posts.index");
    }
    public function showUsers($id){
        $posts = Post::find($id);
        return view("comments_users", ["posts"=> $posts]);
    }
}
