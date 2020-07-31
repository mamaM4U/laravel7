<?php

namespace App\Http\Controllers;

use App\{Category,Post,Tag};
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
     $this -> middleware('auth')->except(['index','show']);
    }

    public function index(){
        $posts = Post::latest()->paginate(6);
        return view('posts.index',['posts'=>$posts]);
    }

    public function show(Post $post){
        return view('posts.show',compact('post'));
    }

    public function create(){
        return view('posts.create',[
            'post'=> new Post(),
            'categories'=> Category::get(),
            'tags'=> Tag::get(),
            ]);
    }

    public function store(PostRequest $request){
        // validate request

        $attr = $request->all();
        // Assign title to slug
        $attr['slug']=\Str::slug(request('title'));

        $attr['category_id']=request('category');

        $post = auth()->user()->posts()->create($attr);

        $post->tags()->attach(request('tags'));

        session()->flash('success', 'The post is created');

        return redirect()->to('posts');
        //return back();

    }

    public function edit(Post $post){
        return view('posts.edit',[
            'post'=>$post,
            'categories'=> Category::get(),
            'tags'=> Tag::get(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update',$post);

        $attr = $request->all();

        $attr['category_id']=request('category');

        $post->update($attr);
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'The post is updated');

        return redirect()->to('posts');
    }

    public function destroy(Post $post){

        $this->authorize('delete',$post);
        $post->tags()->detach();
        $post->delete();
        session()->flash("success","The post was deleted");
        return redirect('posts');


    }

}
