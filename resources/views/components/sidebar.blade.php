<!-- Sidebar Section -->
<aside class="w-full md:w-1/3 flex flex-col items-center px-3">
    <div class="w-full mb-2">
        <form method="GET" action="{{ route('search') }}">
            <input type="text" name="s" value="{{ request()->get('s') }}" placeholder="Search"
                class="block w-full rounded border-0 px-3 py-2 text-gray-900 shadow-sm
                ring-1 ring-blue-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" />
        </form>
    </div>

    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <h3 class="text-xl font-semibold mb-3">All Categories</h3>
        @foreach ($categories as $categorySidebar)
            <a href="{{ route('categories.show', $categorySidebar) }}"
                class="text-semibold block py-2 px-3 {{ request('category')?->slug === $categorySidebar->slug ? 'bg-blue-600 text-white rounded' : '' }}">
                {{ $categorySidebar->title }} ({{ $categorySidebar->posts_count }})
            </a>
        @endforeach
    </div>

    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <p class="text-xl font-semibold pb-5">{{ \App\Models\TextWidget::getTitle('about-us-sidebar') }}</p>
        {!! \App\Models\TextWidget::getContent('about-us-sidebar') !!}
        <a href="{{ route('about-us') }}"
            class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
            Get to know us
        </a>
    </div>

</aside>
