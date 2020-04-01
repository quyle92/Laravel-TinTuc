<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TinTuc extends Model
{
    use SoftDeletes;
	protected $table='TinTuc';

    protected $dates = ['deleted_at'];

    public function TinTuctoLoaiTin() 
    {
    	return $this->belongsTo('App\LoaiTin','idLoaiTin','id');
    }

    public function TinTuctoComment() 
    {
    	return $this->hasMany('App\Comment','idTinTuc','id');
    }
}
