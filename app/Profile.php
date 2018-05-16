<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The table the Model is associated with.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'company_name', 'country_code', 'phone_number', 'country', 'email_sent', 'is_affliate', 'is_influencer', 'mentioned_product', 'payment_email',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function websites()
    {
        return $this->hasMany(Website::class);
    }

    public function socmed()
    {
        return $this->hasMany(SocialMedia::class);
    }

    public function infaff()
    {
        return $this->hasMany(InfluencerAffliate::class);
    }
}
