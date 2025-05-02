
<article class="bg-white flex flex-col shadow my-4">
    <!-- Article Image -->
    <a href="{{ route('posts.show', $post) }}" class="hover:opacity-75">
        <img src="{{ $post->getThumbnail() }}">
    </a>
    <div class="bg-white flex flex-col justify-start p-6">
        <div class="flex gap-4">
            @foreach ($post->categories as $categoryRecent)
                <a href="{{ route('categories.show', $categoryRecent) }}" class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $categoryRecent->title }}</a>
            @endforeach
        </div>

        <div class="flex justify-between items-center pb-4">
            <a href="{{ route('posts.show', $post) }}" class="text-3xl font-bold hover:text-gray-700 ">{{ $post->title }}</a>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="size-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <div>{{ $post->views()->count() }}</div>
            </div>
        </div>
        <p class="text-sm pb-3">
            By <a href="#" class="font-semibold hover:text-gray-800">
            {{ $post->user->name }}</a>,
            Published on {{ $post->getFormattedDate() }} |
            {{ $post->human_read_time }}
        </p>

        <a href="{{ route('posts.show', $post) }}" class="pb-6">{{ $post->shortBody() }}</a>

        <a href="{{ route('posts.show', $post) }}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
    </div>
</article>
