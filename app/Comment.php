<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    protected $table='Comment';
    use SoftDeletes;

    public function CommenttoTinTuc() 
    {
    	return $this->belongsTo('App\TinTuc','idTinTuc','id');
    }

    public function CommenttoUser() 
    {
    	return $this->belongsTo('App\User','idUser','id');
    }
}
