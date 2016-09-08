<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';
    public $incrementing = false;
    protected $fillable = ['userId','namaUser', 'foto', 'password','id_lokasi'];
    public $timestamps=false;
    protected $primaryKey='userId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

public static $rules = [
                'userId'=>'required|unique:user,userId,:userId,userId',
                'password'=>'required|between:4,10|confirmed',
                'password_confirmation'=>'required|between:4,10'
                ];
    public function r_role()
    {
        return $this->belongsToMany(Role::class,'role_user','userId','role_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class,'id_lokasi');
    }

    public function r_permission()
    {
        return $this->hasManyThrough(Permission::class, Role::class);
    }

    public function admin()
    {
       if ($this->r_role->contains('namaRole', 'admin')) {
            return true;
        }

        return false;
    }

    public function hasRole($role)
    {
        if ($this->admin()) {
            return true;
        }

        if (is_string($role)) {
            return $this->r_role->contains('namaRole', $role);
        }

        return !! $this->r_role->intersect($role)->count();
    }

    public function assignRole($role)
        {
            if (is_string($role)) {
                $role = Role::where('namaRole', $role)->first();
            }

            return $this->r_role()->attach($role);
        }

        public function revokeRole($role)
        {
            if (is_string($role)) {
                $role = Role::where('namaRole', $role)->first();
            }

            return $this->r_role()->detach($role);
        }
}
