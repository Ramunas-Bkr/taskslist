<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function taskUser()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
 
}
