@extends('layout.main-layout')
@section('body')
<section class="bg-white dark:bg-gray-900">

    {{-- Introduction --}}

    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Tutorial Dokumentasi API Bot Telegram.</h2>
            <p class="mb-8 font-light text-gray-500 sm:text-xl dark:text-gray-400">Mari belajar step - step membuat pesan ke telegram dengan menggunakan bot. Step ini didukung dengan menggunakan framework laravel serta menggunakan tailwind.css dan flowbite</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                <a href="{{ route('dokumentasi') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-base font-medium text-center text-white bg-primary rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900" style="text-decoration: none;">
                    Get started
                </a>
            </div>
        </div>
    </div>



</section>
@endsection