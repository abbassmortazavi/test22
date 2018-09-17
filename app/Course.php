<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];
    use Sluggable;
    protected $casts = [
        'images' => 'array'
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
        return "courses/$this->slug";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['description'] = str_limit(preg_replace('/<[^>]*>/' , '' , $value) , 200);
        $this->attributes['body'] = $value;
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

}
