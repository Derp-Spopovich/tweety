<x-app>
    <header class="mb-6 relative">

        <div class="relative">
            <img 
                src="{{$user->background}}" 
                alt="profile banner"
                id="cover"
                class="mb-2 rounded"
            >

            <img 
                src="{{$user->avatar}}" 
                alt=""
                class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                style="left:50%" 
                width="150"
            >
        </div>
      

        <div class="flex justify-between items-center mb-6">
            <div style="max-width: 270px">
                <h2 class="font-bold text-2xl mb-0">{{$user->name}}</h2>
                <p class="text-sm">Joined {{$user->created_at->diffForHumans()}}</p>
            </div>

            <div class="flex">
                {{-- @if (auth()->user()->is($user)) if the user is the one who owns its profile, then he can see the edit profile --}}
                @can('edit', $user)
                    <a 
                        href="/profiles/{{$user->username}}/edit" 
                        class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2"
                    >
                        Edit Profile
                    </a>
                @endcan
                
              <x-follow-button :user="$user"/>  {{-- blade componenets follow-button. passed down the user para makahibaw siya unsa ang user --}}

            </div>
          
        </div>

        
            @if (empty($user->bio))
                <p class="text-sm">
                    No bio yet.
                </p>
            @else
                <p class="text-sm">
                    {{$user->bio}}
                </p>
            @endif
            
        

    </header>

    @include('includes/timeline', [
        'tweets' => $tweets
    ]) 
    {{-- specify the tweets, only the tweets of the user created --}}
</x-app>
