{{-- follow button --}}
@if (auth()->user()->isNot($user))   {{-- if the user is currently login, then he cant see the follow button in his profile --}}
    <form action="/profiles/{{$user->username}}/follow" method="post">
        @csrf
        <button type="submit"
            class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs"
        >
            {{auth()->user()->following($user) ? 'Unfollow Me' : 'Follow Me'}}
        </button>
    </form>
@endif