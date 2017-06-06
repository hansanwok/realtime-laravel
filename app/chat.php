<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class chat extends Model
{
    //
    protected $table = 'chat';
    public function user()
    {
        return $this->belongsTo('App\User','idUser','id');
    }
}
