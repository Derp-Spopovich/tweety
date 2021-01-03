<div>
    <input wire:model="search" type="text" placeholder="Search people by name">{{$search}}
    <h1>Search Results:</h1>

    @foreach ($users as $user)
        <a href="/profiles/{{$user->username}}" class="flex items-center mb-5">
        {{-- <a href="{{route('profile', $user)}}" class="flex items-center mb-5"> --}}
        <img src="{{$user->avatar}}" alt="{{$user->username}}" width="60" class="mr-4 rounded">
        <div>
            <h4 class="font-bold">{{'@' . $user->username}}</h4>
        </div>
        </a>
    @endforeach
    {{ $users->links() }}
</div>
