<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
    	$title = Setting :: first()->site_name;
    	//TAKE FIRST 5 RECORDS FROM DATABASE
    	$categories = Category :: take(5)->get();
    	$first_post = Post :: orderBy('created_at', 'desc')->first();
    	$second_post = Post :: orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first();
    	$third_post = Post :: orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first();
    	$career = Category :: find(6);
    	$tutorials = Category :: find(5);
    	$settings = Setting :: first();
    	// dd($oldest_post);
    	return view('index',[
    		'title' => $title,
    		'categories' => $categories,
    		'first_post' => $first_post,
    		'second_post' => $second_post,
    		'third_post' => $third_post,
    		'career' => $career,
    		'tutorials' => $tutorials,
    		'settings' => $settings
    	]);
    }
    public function singlePost($slug)
    {
    	// dd($slug);
    	$post = Post :: where('slug', $slug)->first();
    	$categories = Category :: take(5)->get();
    	$settings = Setting :: first();
        $next_id = Post :: where('id', '>', $post->id)->min('id');
        $next = Post :: find($next_id);
        $prev_id = Post :: where('id', '<', $post->id)->max('id');
        $prev = Post :: find($prev_id);
        $tags = Tag :: all();
    	return view('single', [
    		'post' => $post,
    		'title' => $post->title,
    		'categories' => $categories,
    		'settings' => $settings,
            'next' => $next,
            'prev' => $prev,
            'tags' => $tags
    	]);
    }
    public function category($id)
    {
        $category = Category :: find($id);
        $categories = Category :: take(5)->get();
        $settings = Setting :: first();
        return view('category', [
            'category' => $category,
            'title' => $category->name,
            'settings' => $settings,
            'categories' => $categories
        ]);
    }
    public function tag($id)
    {
        $tag = Tag :: find($id);
        $categories = Category :: take(5)->get();
        $settings = Setting :: first();
        return view('tags', [
            'tag' => $tag,
            'title' => $tag->tag,
            'settings' => $settings,
            'categories' => $categories
        ]);
    }
}
