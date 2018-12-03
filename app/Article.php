<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Article extends Model
{
    
    // Mass assigned
    protected $fillable = ['title', 'slug', 'description_short', 'description', 'image', 'image_show', 'meta_title', 'meta_description', 'published', 'viewed', 'created_by', 'modified_by'];
    
    //Mutators
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . '-' . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }
    
    //Добавляем отношение к категории
    
    public function categories()
    {
        return $this->morphToMany('App\Category', 'categoryable');
    }
}
