<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags', 'post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|unique:posts|min:3',
            'content'=>'required|string',
            'image'=>'string',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id'
        ],
        [
            'required' => 'Il campo :attribute è obbligatorio',
            'min' => 'Il minimo di caratteri per :attribute è :min',
            'title.unique' => 'Titolo già assegnato'
        ]);
        $data = $request->all();
        $post = new Post();
        $data['user_id'] = Auth::id();
        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->save();
        if(array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);
        return redirect()->route('admin.posts.show', compact('post'));
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
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $tagIds = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('tags', 'tagIds', 'post', 'categories'));
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
        $request->validate([
            'title'=>['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:3'],
            'content'=>'required|string',
            'image'=>'string',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id'
        ],
        [
            'required' => 'Il campo :attribute è obbligatorio',
            'min' => 'Il minimo di caratteri per :attribute è :min',
            'title.unique' => 'Titolo già assegnato'
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');
        if(!array_key_exists('tags', $data)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);
        $post->update($data);
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (count($post->tags)) $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('alert-message', 'Post cancellato')->with('alert-type', 'danger');
    }
}
