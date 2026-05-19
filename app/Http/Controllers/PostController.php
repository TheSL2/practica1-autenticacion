<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Attachment;
use App\Services\FileService;
use App\Http\Requests\StorePostWithAttachmentsRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests; 
    public function store(StorePostWithAttachmentsRequest $request)
    {
        $post = auth()->user()->posts()->create($request->safe()->except(['attachments']));

        if ($request->hasFile('attachments')) {
            $fileService = new FileService();
            foreach ($request->file('attachments') as $file) {
                $fileService->storeAttachment($file, $post->id);
            }
        }
        return redirect()->route('posts.show', $post);
    }

    public function destroy(Attachment $attachment)
    {
        $this->authorize('delete', $attachment->post);

        $fileService = new FileService();
        $fileService->deleteAttachment($attachment);

        return redirect()->back()->with('success', 'Archivo eliminado');
    }
    public function show(Post $post)
    {
        $post->load('attachments');
        return view('posts.show', compact('post'));
    }
}