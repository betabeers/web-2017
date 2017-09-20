<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'User';
    public $timestamps = false;
    protected $casts = [
        'id' => 'integer',
        'admin' => 'boolean',
        'permissions' => 'string',
        'facebook_id' => 'string',
        'twitter_id' => 'string',
        'google_id' => 'string',
        'github_id' => 'string',
        'linkedin_id' => 'string',
        'amazon_id' => 'string',
        'category_id' => 'string',
        'email' => 'string',
        'pass' => 'string',
        'name' => 'string',
        'body' => 'string',
        'location' => 'string',
        'date' => 'date',
        'date_update' => 'date',
        'date_login' => 'date',
        'votes' => 'integer',
        'visits' => 'integer',
        'freelance' => 'boolean',
        'url' => 'string',
        'linkedin_url' => 'string',
        'twitter_url' => 'string',
        'forrst_url' => 'string',
        'github_url' => 'string',
        'dribbble_url' => 'string',
        'flickr_url' => 'string',
        'youtube_url' => 'string',
        'stackoverflow_url' => 'string',
        'vimeo_url' => 'string',
        'delicious_url' => 'string',
        'pinboard_url' => 'string',
        'itunes_url' => 'string',
        'android_url' => 'string',
        'chrome_url' => 'string',
        'masterbranch_url' => 'string',
        'bitbucket_url' => 'string',
        'can_contact' => 'boolean',
        'ref_id' => 'integer',
        'total_logins' => 'integer',
        'avatar_type' => 'integer',
        'ip' => 'string',
        'unemployed' => 'integer',
        'country_id' => 'integer',
        'city_id' => 'integer',
        'search_team' => 'boolean',
        'newsletter' => 'boolean',
        'phone' => 'string',
        'slug' => 'integer',
        'moderator' => 'boolean',
        'visits_google' => 'integer',
        'visits_finder' => 'integer',
        'portafolio' => 'string',
        'lookingfor' => 'string',
        'banned' => 'boolean',
        'company' => 'boolean',
        'amount' => 'string',
        'featured' => 'boolean',
        'date_featured' => 'date',
        'origin' => 'string',
        'cv' => 'boolean',
        'province_id' => 'string',
        'karma' => 'integer',
        'github_data' => 'string',
        'linkedin_data' => 'string',
        'twitter_data' => 'string',
        'remember_week' => 'boolean',
        'remember_day' => 'boolean',
        'refs' => 'integer',
        'new' => 'boolean',
        'visible' => 'boolean',
        'company_email' => 'string',
        'company_cif' => 'string',
        'company_name' => 'string',
        'company_address' => 'string',
        'date_newsletter' => 'date',
        'alert_commercial' => 'boolean',
        'photo1' => 'date',
        'photo2' => 'date'
    ];


    protected $hidden = ['password', 'remember_token'];
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'body', 'phone', 'freelance', 'country_id', 'city_id', 'province_id',
        'location', 'portafolio', 'lookingfor', 'unemployed', 'can_contact', 'newsletter', 'alert_commercial',
        'company_name', 'company_email', 'company_cif', 'company_addresses', 'url', 'linkedin_url', 'twitter_url',
        'forrst_url', 'github_url', 'dribbble_url', 'flickr_url', 'youtube_url', 'stackoverflow_url', 'vimeo_url',
        'delicius_url', 'pinboard_url', 'itunes_url', 'android_url', 'chrome_url', 'masterbranch_url', 'bitbucket_url',
    ];

    public function findBySlugAndId($slug, $id)
    {
        return $this->where('slug', $slug)->findOrFail($id);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function followers()
    {
        return $this->hasMany(UserFollow::class, 'to_id');
    }

    public function followings()
    {
        return $this->hasMany(UserFollow::class, 'from_id');
    }
}