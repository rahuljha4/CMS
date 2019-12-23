<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Upload the image
        $image = $request->image->store('posts');
        // Create post
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at
        ]);
        // Flash Message
        session()->flash('success', 'Post Created Succesfully');
        // Redirect User
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content', 'published_at']);

        // Check if new image is uploaded
        if ($request->hasFile('image'))
        {
            // Upload new one
            $image = $request->image->store('posts');

            // Delete old one
            $post->deleteImage();

            $data['image'] = $image;
        }

        // Update Data
        $post->update($data);

        session()->flash('success', 'Post updated successfully.');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed())
        {
            // To delete the image of the post from the server.
            $post->deleteImage();

            $post->forceDelete();
            session()->flash('success', 'Post Deleted Succesfully');
        }
        else
        {
            $post->delete();
            session()->flash('success', 'Post Trashed Succesfully');
        }

        // Redirect User
        return redirect(route('posts.index'));
    }

   /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->withPosts($trashed);
    }

    public function restore ($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        session()->flash('success', 'Post Restored Succesfully');

        return redirect()->back();
    }
}
