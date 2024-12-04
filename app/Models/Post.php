<?php

namespace App\Models;

use App\Models\Scopes\PostScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=['title','summary','content','image','status','user_id'];
//Global Scope
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PostScope);
    }

    //one to many realtion
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    } 
    //one to many realtion
    public function comments()
    {
        return $this->hasMany(Comment::class);
    } 

    //has one through relation to get users of post comments

    public function users()
    {
        return $this->hasOneThrough(User::class,Comment::class,'id','id');
    } 
}
