<x-app-layout :meta-title="$category->title" meta-description="Danyk personal development blog">
    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">
        @foreach ($posts as $post)
            <x-post-item :post="$post"/>
        @endforeach

        <!-- Pagination -->

        {{ $posts->links() }}

    </section>

    <x-sidebar />

</x-app-layout>

