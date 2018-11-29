<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Category
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @mixin \Eloquent
 */
class Category extends Model
{
    // Mass assigned
    protected $fillable = ['title', 'slug', 'parent_id', 'published', 'created_by', 'modified_by'];

    //Mutators
    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }

    //Get children category
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

}
