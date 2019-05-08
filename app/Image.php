<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['category_id', 'uploader_id', 'name', 'path', 'src'];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function uploader() {
        return $this->hasOne('App\User');
    }
}
