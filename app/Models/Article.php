<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    use HasFactory;
    protected $with = ['category'];
    protected $fillable=['name','slug','description','link','category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
