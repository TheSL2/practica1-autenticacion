<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
    $post = auth()->user()->posts()->create([
    'title' => $request->title,
    'content' => $request->content,
    'category_id' => $request->category_id,
    'published_at' => $request->published_at,
    ]);
    if ($request->has('tags')) {
    $post->tags()->attach($request->tags);
    }
    return redirect()->route('posts.show', $post)
    ->with('success', 'Post creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
    $this->authorize('update', $post); // Policy
    $post->update($request->validated());
    $post->tags()->sync($request->tags);
    return redirect()->route('posts.show', $post)
    ->with('success', 'Post actualizado');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
