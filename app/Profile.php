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
// use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    // use SoftDeletes;

	protected $table = 'profiles';
	public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'company_name', 'country_code', 'phone_number', 'country', 'email_sent', 'is_affliate', 'is_influencer', 'mentioned_product', 
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
}
