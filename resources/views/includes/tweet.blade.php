<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400'}}"> {{-- if the loop is in the last, then dont display the border --}}
    <div class="mr-2 flex-shrink-0">
        <a href="{{route('profile', $tweet->user)}}">
            <img 
            src="{{$tweet->user->avatar}}" 
                alt="" 
                class="rounded-full mr-2" 
                width="50" 
                height="50"
            >
        </a>
    </div>
    
    <div>
        <h5 class="font-bold mb-2">
            <a href="{{route('profile', $tweet->user)}}">
                {{$tweet->user->name}}
            </a>
        </h5>

        @can('delete', $tweet)
            <form action="{{route('tweet.destroy', $tweet->id)}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="bg-red-400 text-sm mb-3">Delete</button>
            </form>     
        @endcan

        <p class="text-sm mb-3">
            {{$tweet->body}}
        </p>

        <div>
            @if (!empty($tweet->tweet_image))
                <img src="{{asset('storage/' .$tweet->tweet_image)}}" alt="tweet image" id="tweetImage" class="mb-3">
            @endif
        </div>

        <x-like-buttons :tweet="$tweet"/>

    </div>
</div>
