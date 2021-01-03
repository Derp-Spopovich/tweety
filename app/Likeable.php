<?php 

namespace App;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
trait Likeable
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    //tweet->like(); == true;
    // public function like(User $user)
    // {
    //     $this->likes()->updateOrCreate(  //pg imo ni gitawag, ug wala pa siya sa db, mg create siya, if naa na siya sa db, iya ra e update
    //         ['user_id' => $user->id],
    //         ['liked' => true]
    //     );
    // }
    public function like(User $user)
    {
    	if ($this->isLikedBy($user)) {
    		// Delete
		    $this->likes()->delete();
	    } else {
            $this->likes()->updateOrCreate(  //pg imo ni gitawag, ug wala pa siya sa db, mg create siya, if naa na siya sa db, iya ra e update
                        ['user_id' => $user->id],
                        ['liked' => true]
                    );
	    }
    }

    //tweet->dislike(); == false;
    // public function dislike(User $user)
    // {
    //     $this->likes()->updateOrCreate( //pg imo ni gitawag, ug wala pa siya sa db, mg create siya, if naa na siya sa db, iya ra e update
    //         ['user_id' => $user->id],
    //         ['liked' => false]
    //     );
    // }
    
    public function dislike(User $user)
    {
       	if ($this->isDislikedBy($user)) {
    		// Delete
		    $this->likes()->delete();
	    } else {
            $this->likes()->updateOrCreate(  //pg imo ni gitawag, ug wala pa siya sa db, mg create siya, if naa na siya sa db, iya ra e update
                ['user_id' => $user->id],
                ['liked' => false]
            );
	    }
    }

    public function isLikedBy(User $user)
    {
        return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', true)->count();  //check tweet if how many likes it have
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', false)->count(); //check tweet if how many dislikes it have
    }
}