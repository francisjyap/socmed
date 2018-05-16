<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMediaTypes extends Model
{
    protected $table = 'social_media_types';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
