<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfluencerAffliate extends Model
{
    use SoftDeletes;
    
    protected $table = 'influencer_affliates';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'status', 'status_date', 'follow-up', 'follow-up_date', 'affliate_code',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['status_date', 'follow-up_date'];
}
