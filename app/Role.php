<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='role';
    protected $primaryKey='roleId';
    public $timestamps=false;
    protected $fillable=['roleId','namaRole'];


   public function r_user()
    {
        return $this->belongsToMany(User::class,'role_user','role_id','userId');
    }

    public function r_permission()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function addPermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('namaPermission', $permission)->first();
        }

        return $this->r_permission()->attach($permission);
    }

    public function removePermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('roleId', $permission)->first();
        }

        return $this->r_permission()->detach($permission);
    }
}
