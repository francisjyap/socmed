<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
//    use SoftDeletes;
    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'email', 'is_admin'
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
