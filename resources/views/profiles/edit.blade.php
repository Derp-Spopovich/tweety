<x-app>
    <form action="/profiles/{{$user->username}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-6">
            <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray-700">Username</label>
            <input type="text" name="username" class="border border-gray-400 p-2 w-full" value="{{$user->username}}" required>
            @error('username')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">Name</label>
            <input type="text" name="name" class="border border-gray-400 p-2 w-full" value="{{$user->name}}" required>
            @error('name')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
                <label for="avatar" class="block mb-2 uppercase font-bold text-xs text-gray-700">Avatar</label>
            <div class="flex">
                <input type="file" name="avatar" class="border border-gray-400 p-2 w-full">
                <img src="{{$user->avatar}}" alt="Your avatar" width="40">
            </div>
            @error('avatar')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="background" class="block mb-2 uppercase font-bold text-xs text-gray-700">Cover Photo</label>
            <div class="flex">
                <input type="file" name="background" class="border border-gray-400 p-2 w-full">
                <img src="{{$user->background}}" alt="Your Cover Photo" width="40">
            </div>
            @error('background')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
            <input type="email" name="email" class="border border-gray-400 p-2 w-full" value="{{$user->email}}" required>
            @error('email')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="bio" class="block mb-2 uppercase font-bold text-xs text-gray-700">Bio</label>
            <input type="text" name="bio" class="border border-gray-400 p-2 w-full" value="{{$user->bio}}" required>
            @error('bio')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
            @enderror
        </div>

        {{-- <div class="mb-6">
            <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
            <input type="password" name="password" class="border border-gray-400 p-2 w-full" id="password" required>
            @error('password')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password Confirmation</label>
            <input type="password" name="password_confirmation" class="border border-gray-400 p-2 w-full" id="password_confirmation" required>
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-2">{{$message}}</p>
            @enderror
        </div> --}}

        <div class="mb-6">
            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 mr-4">Submit</button>
            <a href="/profiles/{{$user->username}}" class="hover:underline">Cancel</a>
        </div>

        
        
    </form>
</x-app>