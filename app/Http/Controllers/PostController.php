<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            $html = view('pages.admin.posts.table', compact('posts'))->render();
            $records = $posts;
            $pagination = view('pages.admin.append.pagination', compact('records'))->render();

            return response()->json([
                'error' => false,
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        return view('pages.admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $validation['is_published'] = $request->has('is_published') ? 1 : 0;
        $validation['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/posts'), $name_gen);
            $validation['image'] = 'uploads/posts/' . $name_gen;
        }
        Post::create($validation);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('user');
        return view('pages.admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('pages.admin.posts.edit', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->comments()->delete();
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
