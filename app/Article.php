<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];
    use Sluggable;

    protected $casts = [
        'images' => "array"
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function path()
    {
    	return "article/$this->slug";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
