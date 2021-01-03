<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form action="{{route('tweet.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <textarea name="body" class="w-full" placeholder="What's up duck?" required></textarea>
        <input type="file" name="tweet_image">

        <hr class="my-4">

        <footer class="flex justify-between items-center">
            <img src="{{auth()->user()->avatar}}" alt="Your avatar" class="rounded-full mr-2" width="50" height="50">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 rounded-lg rounded-lg shadow px-10 text-sm text-white h-10">Publish</button>
        </footer>

    </form>

    @error('body')
        <p class="text-red-500 text-sm mt-2">{{$message}}</p>
    @enderror
    @error('tweet_image')
        <p class="text-red-500 text-sm mt-2">{{$message}}</p>
    @enderror
</div>