<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'Blog';
    public $timestamps = false;

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
