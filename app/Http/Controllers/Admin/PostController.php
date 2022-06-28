<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    
    protected $validations = [
        'title' => 'required|max:100',
        'content' => 'required',
        'published' => 'sometimes|accepted',
        'category_id' => 'required|exists:categories,id',
        "image" => "nullable|mimes:jpeg,jpg,bmp,png,svg",
        'tags' => 'nullable|exists:tags,id',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories'), compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validations);
        $data = $request->all();
        $newPost = new Post();
        $newPost->title = $data['title'];
        $slug = Str::of($data['title'])->slug('-');
        $newPost->content = $data['content'];
        $newPost->category_id = $data['category_id'];
        $newPost->published = isset($data['published']);
        $count = 1;
        while(Post::where('slug', $slug)->first()){
            $slug = Str::of($data['title'])->slug('-') . "-{$count}";
            $count++;
        };
        $newPost->slug = $slug;
        if( isset($data['image']) ) {
            $path_image = Storage::put('images', $data['image']);
            $newPost->image = $path_image;
        }
        $newPost->save();
        if(isset($data['tags'])){
            $newPost->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $category = Category::all();
        $tag = Tag::all();
        return view('admin.posts.edit', compact('post'), compact('category'))->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $data = $request->all();
        if($post->title != $data['title']){
            $post->title = $data['title'];
        }
        $post->title = $data['title'];
        $slug = Str::of($data['title'])->slug('-');
        $post->content = $data['content'];
        $post->published = isset($data['published']);
        $post->category_id = $data['category_id'];
        $count = 1;
        while(Post::where('slug', $slug)->first()){
            $slug = Str::of($data['title'])->slug('-') . "-{$count}";
            $count++;
        };
        $post->slug = $slug;
        if($post->title != $data['title']){
            $post->title = $data['title'];
            $slug = Str::of($data['title'])->slug('-');
            if($slug != $post->slug){
                $post->slug = $this->getSlug($post->title);
            }
        }
        if( isset($data['image']) ) {
            Storage::delete($post->image);
            $path_image = Storage::put("images", $data['image']);
            $post->image = $path_image;
        }

        $post->update();
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
