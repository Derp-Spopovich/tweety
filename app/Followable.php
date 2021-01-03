<?php 

namespace App;

use App\Models\User;
trait Followable
{
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {

        $this->follows()->toggle($user); //this is just same method just as the code below.

        // if ($this->following($user)) { 
        //     return $this->unfollow($user);  //if the user is following the user, unfollow them
        // }

        // return $this->follow($user); //else if not, follow them.
    }

    public function follows()
    {
        return $this->belongsToMany(
            'App\Models\User',
             'follows',
              'user_id',
               'following_user_id'
               )
               ->withTimeStamps(); //find the  table name => follows. and the foreign keys are user_id and following_user_id
    }

    public function following(User $user)
    {
        return $this->follows()
        ->where('following_user_id', $user->id)//where the following user id is the person where we are following $user->id
        ->exists(); //and check if it exist it the record
    }
}