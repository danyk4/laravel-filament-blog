<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?: 'Danyk dev blog' }}</title>
    <meta name="description" content="{{ $metaDescription }}">

    <!-- Tailwind -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    <!-- AlpineJS -->
    <!-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> -->
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-50 font-family-karla">

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="{{ route('home') }}">
                Danyk dev blog
            </a>
            <p class="text-lg text-gray-600">
                {{ \App\Models\TextWidget::getTitle('header') }}
            </p>
        </div>
    </header>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a href="#"
                class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open">
                Topics <i :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block' : 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div
                class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-xl font-bold uppercase mt-0 px-6 py-2">
                <a href="{{ route('home') }}"
                    class="hover:bg-blue-600 hover:text-white rounded py-2 px-4 mx-2
                    {{ request()->routeIs('home') ? 'bg-blue-600 text-white rounded' : '' }}
                ">
                    Home
                </a>
                @foreach ($categoriesMain as $categoryMain)
                    <a href="{{ route('categories.show', $categoryMain) }}"
                        class="hover:bg-blue-600 hover:text-white rounded py-2 px-4 mx-2
                        {{ request('category')?->slug === $categoryMain->slug ? 'bg-blue-600 text-white rounded' : '' }}">
                        {{ $categoryMain->title }}
                    </a>
                @endforeach
                <a href="{{ route('about-us') }}"
                    class="hover:bg-blue-600 hover:text-white rounded py-2 px-4 mx-2">About Us</a>
            </div>
        </div>
    </nav>


    {{-- <div class="container p-3 mx-auto my-4">
        <form method="GET" action="{{ route('search') }}">
            <input type="text" name="s" value="{{ request()->get('s') }}" placeholder="Search"
                class="block w-full rounded border-0 px-3 py-2 text-gray-900 shadow-sm
                ring-1 ring-blue-300 placeholder:text-gray-400 sm:text-sm sm:leading-6" />
        </form>
    </div> --}}

    <div class="container mx-auto flex flex-wrap py-6">

        {{ $slot }}

    </div>

    <footer class="w-full border-t bg-white pb-1">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="uppercase py-6">&copy; <a href="https://danyk.ru" target="_blank">danyk.ru</a></div>
        </div>
    </footer>

</body>

</html>
