<div class="border border-gray-300 rounded-lg mb-6">
    @forelse ($tweets as $tweet)
        @include('includes/tweet')
    @empty
        <p class="py-4">No post available yet</p>
    @endforelse

    {{$tweets->links()}}
</div>