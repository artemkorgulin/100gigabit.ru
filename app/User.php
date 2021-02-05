<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Проверка имеет ли пользователь определенную роль
     * @param $check
     * @return boolean
     */
    public function hasPermission($check)
    {
        return in_array($check, array_pluck($this->permissions->toArray(), 'name'));
    }

    /**
     * Получает название права
     * @param $name
     * @return mixed
     */
    public function getPermissionDisplayName($name)
    {
        return DB::table('permissions')->where('name', $name)->first()->display_name;
    }

    /**
     * Функция для получение прав.
     * @return boolean
     **/
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'permission_user', 'user_id', 'permission_id');
    }
}
