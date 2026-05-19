<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Models\Audit;

class PostAdminController extends Controller
{
    public function index()
    {
        $posts = Post::with('author', 'category')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        return redirect()->route('admin.posts.show', $post)
            ->with('success', 'Post creado exitosamente');
    }

    public function show(Post $post)
    {
        $audits = Audit::where('model_type', 'Post')
            ->where('model_id', $post->id)
            ->latest()
            ->get();
        return view('admin.posts.show', compact('post', 'audits'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route('admin.posts.show', $post)
            ->with('success', 'Post actualizado');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post eliminado');
    }
}