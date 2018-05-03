<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfluencerAffliate extends Model
{    
    protected $table = 'influencer_affliates';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id', 'class', 'status', 'status_date', 'follow-up', 'follow-up_date', 'affliate_code', 'latest_inf_log_id', 'latest_aff_log_id', 'email_sent'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['status_date', 'follow-up_date'];
}
