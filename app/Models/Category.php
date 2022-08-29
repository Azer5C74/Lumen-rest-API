<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
@mixin Eloquent
 * Post
 *
 * @mixin Eloquent
 * */


class Category extends Model
{
    use HasFactory;
    protected $fillable =['name','slug'];
   // protected $with=['article'];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
