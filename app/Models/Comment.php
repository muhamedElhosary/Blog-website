<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=['comment','user_id','admin_id','post_id'];
    //one to many realtion
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    } 
}
