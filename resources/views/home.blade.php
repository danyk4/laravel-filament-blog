<x-app-layout meta-description="Danyk personal development blog">
    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col px-3">

        {{-- @foreach ($posts as $post)
                <x-post-item :post="$post" />
            @endforeach
        --}}

        <div class="block grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Latest Post -->
            <div class="col-span-2">
                <h2 class="text-lg sm:text-xl font-bold mb-4 uppercase text-blue-500 border-b-2 border-blue-500">
                    Latest Post
                </h2>
                <x-post-item :post="$latestPost" />
            </div>

            <!-- Popular 3 posts -->
            <div>
                <h2 class="text-lg sm:text-xl font-bold mb-4 uppercase text-blue-500 border-b-2 border-blue-500">
                    Popular Posts
                </h2>

                @foreach ($popularPosts as $post)
                    <div class="grid grid-cols-4 gap-2 pb-4">
                        <div>
                            <img src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}">
                        </div>
                        <div class="col-span-3">
                            <h3 class="text-xl font-semibold">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </h3>
                            <div class="flex gap-2">
                                @foreach ($post->categories as $categoryRecent)
                                    <a href="{{ route('categories.show', $categoryRecent) }}"
                                        class="bg-blue-500 text-xs text-white uppercase p-1 rounded ">{{ $categoryRecent->title }}</a>
                                @endforeach
                            </div>
                            <div class="test-sm">
                                {{ $post->shortBody() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Categories -->
        <div class="my-4">
            <h2 class="text-lg sm:text-xl font-bold mb-4 uppercase text-blue-500 border-b-2 border-blue-500">
                Recent Categories
            </h2>

        </div>

        <!-- Pagination -->

        {{-- $posts->links() --}}

    </section>

    <x-sidebar />

</x-app-layout>
