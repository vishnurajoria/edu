<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
//  Relationships

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

//  Methods


}
