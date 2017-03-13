<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label', 'permissions'];

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

    public function syncPermissions($permissions_array=[], $slugs = false){
        if($slugs){
            $permissions_array_ids = [];
            if(!empty($permissions_array)) {
                foreach ($permissions_array as $permission) {
                    $permissions_array_ids[] = Permission::where('name', $permission)->get()->first()->id;
                }
            }
            $this->permissions()->sync($permissions_array_ids);
        }
        else{
            $this->permissions()->sync($permissions_array);
        }

    }


}
