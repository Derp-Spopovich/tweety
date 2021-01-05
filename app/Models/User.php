<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Followable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets()
    {
        return $this->hasMany('App\Models\Tweet')->latest();
    }

    public function timeline()
    {
        //include all the current login user's tweet
        //as well as the tweets of everyone he/she follows
        //in desc order by date
       
        $friends = $this->follows()->pluck('id'); //^ Find all the users that the current person follows. But we don't want the full User model; we only care about the user's id. So we'll "pluck" the id column.

        return Tweet::whereIn('user_id', $friends) //^ Give me only the tweets where the user_id (the person who created the tweet) is in the list of $friends that we fetched earlier. Remember, we don't want all tweets in the database. We only care about the tweets from our friends.
            ->orWhere('user_id', $this->id) //^ We also want to see our own tweets, so let's add that to the query as well.
            ->withLikes() //include all the likes and dislikes
            ->latest()->paginate(50); //^ Order the results in descending order according to the created_at timestamp. This means the most recent tweets show up first, which makes sense.
    }

    public function getAvatarAttribute($value)
    {
        if ($value) {
            return asset('avatars/' . $value);  //return the profile avatar of the user
        } else{
            return asset('/images/default-avatar.jpg'); //else if no profile avatar return default avatar
        }
       

        // return "https://i.pravatar.cc/200?u=" . $this->email; //if no avatar yet putted
    }

    public function getbackgroundAttribute($value)
    {
        if ($value) {
            return asset('backgrounds/' . $value);  //return the profile avatar of the user
        } else{
            return asset('/images/default-profile-banner.jpg'); //else if no profile avatar return default avatar
        }
    }

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);  //if your changing the password manually, use this attribute to hash the password
    // }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }


    // public function getRouteKeyName()
    // {
    //     return 'name'; //find user by name not by id
    // }
}
