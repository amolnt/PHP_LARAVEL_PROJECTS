<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class UserLogin extends Model implements AuthenticatableContract
{
    //
    use Authenticatable;
	use Notifiable;
    protected $table="employee";
    protected $primaryKey="emp_id";
}
