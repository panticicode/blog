<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post :: all();
        return view('dashboard.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category :: all();
        $tags = Tag :: all();
        if($categories->count() == 0 && $tags->count() == 0):
            Session::flash('info', 'You must have some categories and tags before attempting to create post');
            return redirect()->back();
        endif;    
        return view('dashboard.posts.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',
            'tags' => 'required'
        ]);
        $featured = $request->featured;
        $featuredNewName = time(). $featured->getClientOriginalName();
        $image_path = 'uploads/posts/';
        $featured->move($image_path, $featuredNewName);
        $post = Post :: create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => $image_path . $featuredNewName,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'slug' => str_slug($request->title)
        ]);
        $post->tags()->attach($request->tags);
        Session::flash('success', 'Post created succesfully');
        return redirect()->route('post.index');
        //dd($request->all());
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
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.posts.edit',[
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'tags' => 'required'
        ]);
        $post = Post :: find($id);

        if($request->hasFile('featured')):
            $featured = $request->featured;
            $image_path = 'uploads/posts/';
            $featuredNewName = time() . $featured->getClientOriginalName();
            $featured->move($image_path, $featuredNewName);
            $post->featured = $image_path . $featuredNewName;
        endif; 

        $post->title = $request->title;
        $post->content = $request->content; 
        $post->category_id = $request->category_id;
        $post->tags()->sync($request->tags);
        $post->save();
        Session::flash('info', 'Post Updated successfully.');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post :: find($id);
        $post->delete();
        Session::flash('warning', 'Your post was trashed!');
        return redirect()->back();
    }
    public function trashed()
    {
        $posts = Post :: onlyTrashed()->get();
        return view('dashboard.posts.trashed', [
            'posts' => $posts
        ]);
    }
    public function restore($id)
    {
        $post = Post :: withTrashed()->where('id', $id)->first();
        $post->restore();
        Session::flash('success', 'Post restored successfully.');
        return redirect()->route('post.index');
    }
    public function deletedFromTrash($id)
    {
        $post = Post :: withTrashed()->where('id', $id)->first();

        if(!empty($post->featured))
        { 
           unlink(public_path() . '/' . $post->featured); 
           if($post->featured !== NULL)
           { 
                $post->forceDelete();
           }
        }else{ 
            $post->forceDelete();
        } 
        Session::flash('danger', 'Post deleted permanently.');
        return redirect()->back();
    }
}
