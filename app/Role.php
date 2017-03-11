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

        $exists = \DB::table('permission_role')
                ->whereRoleId($this->id)
                ->wherePermissionId($permission->id)
                ->count() > 0;
        if(!$exists) {
            return $this->permissions()->attach($permission);
        }
        else{
            return false;
        }
    }


}
