<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
   public $timestamps=false;
   protected $table='permission';
   protected $primaryKey='id';
   protected $fillable=['id','namaPermission'];
	
	public function r_role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function r_user()
    {
        return $this->hasManyThrough(User::class, Role::class);
    }
    
}
