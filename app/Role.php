<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
//  Relationships

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

//  Methods

    public function addPermission(Permission $permission){
        return $this->permissions()->save($permission);
    }


}
