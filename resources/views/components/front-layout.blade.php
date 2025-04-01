<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100">
        

      <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_UkaqTxfnwaSBYrABaoEdnQI-EuZHoUSA9w&s" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Cargo Forwarder</span>
            </a>
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                <a href="/login" class="text-sm  text-black dark:text-white hover:underline">Login</a>
            </div>
        </div>
      </nav>
      <nav class="bg-blue-600 dark:bg-gray-700">
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex items-center">
                <ul class="flex flex-row font-medium mt-0 space-x-10 rtl:space-x-reverse text-sm">
                    <li>
                        <a href="/" class="text-white p-1 rounded-full mx-5 hover:underline">Home</a>
                    </li>
                    <li>
                        <a href="/shipping-rate" class="text-white p-1 rounded-full mx-5 hover:underline">Shipping Rate</a>
                    </li>
                    <li>
                        <a href="/tracking" class="text-white p-1 rounded-full mx-5 hover:underline">Tracking</a>
                    </li>
                    <li>
                        <a href="/about" class="text-white p-1 rounded-full mx-5 hover:underline">About Us</a>
                    </li>
                </ul>
            </div>
        </div>
      </nav>

    
        <main>
            {{$slot}}
        </main>
    </body>
</html>