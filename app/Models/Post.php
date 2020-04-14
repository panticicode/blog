<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'title', 'content', 'featured', 'user_id', 'category_id', 'slug'
	];
	// public function getFeaturedAttribute($featured)
	// {
	// 	return asset($featured);
	// }
	protected $dates = ['deleted_at'];
	
    public function category()
    {
    	return $this->belongsTo('App\Models\Category');
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function tags()
    {
    	return $this->belongsToMany('App\Models\Tag');
    }
}
