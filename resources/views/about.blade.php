<x-app-layout meta-title="About us page">
    <!-- Post Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <div class="">
                <img src="/storage/{{ $widget->image }}">
            </div>
            <div class="bg-white flex flex-col justify-start p-6">
                <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $widget->title }}</h1>
                <div>
                    {!! $widget->content !!}
                </div>
            </div>
        </article>

    </section>

    <x-sidebar />
</x-app-layout>
