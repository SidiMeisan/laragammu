<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Roles\EloquentRole as SentinelRole;

class Role extends SentinelRole
{
    public static $rules = [
        'slug'			=> 'required',
        'name'          => 'required|min:5|unique:roles,name',
    ];

    public function appMenu() {
		return $this->belongsToMany('App\Models\AppMenu','appmenu_role','role_id','appmenu_id');
	}

	public function user() {
		return $this->belongsToMany('App\Models\User','role_users','role_id','user_id');
	}
}
