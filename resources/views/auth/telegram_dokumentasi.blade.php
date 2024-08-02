@extends('layout.main-layout')
@section('body')
<section class="bg-white dark:bg-gray-900">

    {{-- //Intalisasi Composer --}}

    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">

        
     
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Instalisasi Composer SDK Telegram Bot</h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Hal yang pertama yang harus dilakukan adalah menginstal composer sdk di project laravel anda. Step ini sangat mudah anda tinggal copy paste keyword dibawah ini kemudian jalankan di terminal.</p>
        <div class="text-lg font-extrabold text-gray-500 lg:text-xl sm:px-16 xl:px-48">
            <center>                

                <input type="hidden" id="hs-clipboard-tooltip-on-hover" value="composer require irazasyed/telegram-bot-sdk">

                <button type="button" class="font-normal js-clipboard-example [--is-toggle-tooltip:false] hs-tooltip relative py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-mono rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" data-clipboard-target="#hs-clipboard-tooltip-on-hover" data-clipboard-action="copy" data-clipboard-success-text="Copied">
                <span>$ <span class="text-emerald-500">composer</span> require irazasyed/telegram-bot-sdk</span> 
                <span class="border-s ps-3.5 dark:border-neutral-700">
                    <svg class="js-clipboard-default size-4 group-hover:rotate-6 transition" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                    </svg>

                    <svg class="js-clipboard-success hidden size-4 text-blue-600 rotate-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </span>

                <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity hidden invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-lg shadow-sm dark:bg-neutral-700" role="tooltip">
                    <span class="js-clipboard-success-text">Copy</span>
                </span>
                </button>
        </center>

        
        </div>
        <br>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Kemudian publish configurasi di terminal.</p>
        <div class="text-lg font-extrabold text-gray-500 lg:text-xl sm:px-16 xl:px-48">

            <center>
                <input type="hidden" id="hs-clipboard-tooltip-on-hover_2" value='php artisan vendor:publish --tag="telegram-config"'>

                <button type="button" class="font-normal js-clipboard-example [--is-toggle-tooltip:false] hs-tooltip relative py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-mono rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" data-clipboard-target="#hs-clipboard-tooltip-on-hover_2" data-clipboard-action="copy" data-clipboard-success-text="Copied">
                <span>$ php artisan vendor:publish<i class="text-violet-600">--tag=<span class="text-pink-500">"telegram-config"</span></i></span>
                <span class="border-s ps-3.5 dark:border-neutral-700">
                    <svg class="js-clipboard-default size-4 group-hover:rotate-6 transition" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                    </svg>

                    <svg class="js-clipboard-success hidden size-4 text-blue-600 rotate-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </span>

                <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity hidden invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-lg shadow-sm dark:bg-neutral-700" role="tooltip">
                    <span class="js-clipboard-success-text">Copy</span>
                </span>
                </button>
            </center>






        </div>

    </div>

    {{-- Contents Bot --}}

    <div class="gap-8 items-center py-4 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
        <img class="w-full dark:hidden" src="{{ asset('gambar_1.png') }}" alt="dashboard image">
        <img class="w-full hidden dark:block" src="{{ asset('gambar_1.png') }}" alt="dashboard image">
        <div class="mt-0 md:mt-0">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Membuat Bot Telegram</h2>
            <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">Cari bot father di telegram atau di sini <a href="https://telegram.me/BotFather" target="_blank">https://telegram.me/BotFather</a>. Kemudian buat bot dengan mengetik <i>/newbot</i> dan lengkapi nama bot serta username botnya. Setelah itu bot akan menampilkan token api sebagai contoh: 
                <span class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                    <span class="token_bot">
                    </span>
                </span>
            </p>
           
        </div>
    </div>


    
    {{-- Contents Grup --}}

    <div class="gap-8 items-center py-2 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
        
        <div class="mt-0 md:mt-0">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Membuat Grup Telegram</h2>
            <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">Buat grup yang dimana berisikan bot yang sudah dibuat. Kemudian jadikan bot sebagai admin grup dan berikan permission untuk mengirim pesan.</p>
           
        </div>

        <img class="w-full dark:hidden" src="{{ asset('gambar_2.png') }}" alt="dashboard image">
        <img class="w-full hidden dark:block" src="{{ asset('gambar_2.png') }}" alt="dashboard image">
        
    </div>

        <!-- Features -->
    <div class="max-w-[85rem] px-4 py-8 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Tab Nav -->
        <nav class="font-sans max-w-6xl mx-auto grid sm:flex gap-y-px sm:gap-y-0 sm:gap-x-4" aria-label="Tabs" role="tablist">
        <span type="button" class="hs-tab-active:bg-gray-100 hs-tab-active:hover:border-transparent w-full flex flex-col text-start hover:bg-gray-100 p-3 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-800 dark:hover:bg-neutral-800 active" id="tabs-with-card-item-1" data-hs-tab="#tabs-with-card-1" aria-controls="tabs-with-card-1" role="tab">
            <img src="{{ asset('one.svg')}}" class="w-12 h-auto">
            <span class="mt-3">
            <span class="hs-tab-active:text-blue-600 block font-semibold text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200">Memulai perintah</span>
            <span class="hidden lg:block mt-2 text-gray-800 dark:text-neutral-200">Langkah pertama, untuk memulai perintah bot maka lakukan <span class="text-blue-500">/start</span>. Maka akan muncul berbagai perintah yang bisa kita gunakan</span>
            </span>
        </span>
    
        <span type="button" class="hs-tab-active:bg-gray-100 hs-tab-active:hover:border-transparent w-full flex flex-col text-start hover:bg-gray-100 p-3 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-800 dark:hover:bg-neutral-800" id="tabs-with-card-item-2" data-hs-tab="#tabs-with-card-2" aria-controls="tabs-with-card-2" role="tab">
            <img src="{{ asset('two.svg')}}" class="w-12 h-auto">
            <span class="mt-3">
            <span class="hs-tab-active:text-blue-600 block font-semibold text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200">Memulai bot dan dapatkan Token API</span>
            <span class="hidden lg:block mt-2 text-gray-800 dark:text-neutral-200">Langkah kedua, membuat bot dengan melakukan perintah <span class="text-blue-500">/newbot</span>. Maka bot akan membuat perintah untuk mengisi nama serta username bot yang akan dibuat. Setelah itu bot akan memberikan token api telegram, sebagai contoh:<br><span class="text-blue-500 token_bot"></span></span>
            </span>
        </span>
    
        <span type="button" class="hs-tab-active:bg-gray-100 hs-tab-active:hover:border-transparent w-full flex flex-col text-start hover:bg-gray-100 p-3 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-800 dark:hover:bg-neutral-800" id="tabs-with-card-item-3" data-hs-tab="#tabs-with-card-3" aria-controls="tabs-with-card-3" role="tab">
            <img src="{{ asset('three.svg')}}" class="w-12 h-auto">
            <span class="mt-3">
            <span class="hs-tab-active:text-blue-600 block font-semibold text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200">Membuat grup telegram dan undang bot</span>
            <span class="hidden lg:block mt-2 text-gray-800 dark:text-neutral-200">Langkah ketiga, membuat grup telegram serta mengundang bot yang sudah dibuat ke dalam grup</span>
            </span>
        </span>

        <span type="button" class="hs-tab-active:bg-gray-100 hs-tab-active:hover:border-transparent w-full flex flex-col text-start hover:bg-gray-100 p-3 md:p-5 rounded-xl dark:hs-tab-active:bg-neutral-800 dark:hover:bg-neutral-800" id="tabs-with-card-item-3" data-hs-tab="#tabs-with-card-4" aria-controls="tabs-with-card-4" role="tab">
            <img src="{{ asset('four.svg')}}" class="w-12 h-auto">
            <span class="mt-3">
            <span class="hs-tab-active:text-blue-600 block font-semibold text-gray-800 dark:hs-tab-active:text-blue-500 dark:text-neutral-200">Membuat bot menjadi Admin</span>
            <span class="hidden lg:block mt-2 text-gray-800 dark:text-neutral-200">Langkah terakhir, menjadikan bot sebagai admin agar bisa mengirim pesan ke dalam grup</span>
            </span>
        </span>
        </nav>
        <!-- End Tab Nav -->
    
        <!-- Tab Content -->
        <div class="mt-12 md:mt-16">
        <div id="tabs-with-card-1" role="tabpanel" aria-labelledby="tabs-with-card-item-1">
            <!-- Devices -->
            <div class="max-w-[1140px] lg:pb-32 relative">
    
            <!-- Browser Device -->
            <figure class="ms-auto me-20 relative z-[1] max-w-full w-[50rem] h-auto shadow-[0_2.75rem_3.5rem_-2rem_rgb(45_55_75_/_20%),_0_0_5rem_-2rem_rgb(45_55_75_/_15%)] dark:shadow-[0_2.75rem_3.5rem_-2rem_rgb(0_0_0_/_20%),_0_0_5rem_-2rem_rgb(0_0_0_/_15%)] rounded-b-lg">
                <div class="bg-gray-800 rounded-b-lg">
                <img class="max-w-full h-auto rounded-b-lg" src="{{ asset('tahap_1.png') }}" alt="Image Description">
                </div>
            </figure>
            <!-- End Browser Device -->
            </div>
            <!-- End Devices -->
        </div>
    
        <div id="tabs-with-card-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-card-item-2">
            <!-- Devices -->
            <div class="max-w-[1140px] lg:pb-32 relative">
    
            <!-- Browser Device -->
            <figure class="ms-auto me-20 relative z-[1] max-w-full w-[50rem] h-auto shadow-shadow-[0_2.75rem_3.5rem_-2rem_rgb(0_0_0_/_20%),_0_0_5rem_-2rem_rgb(0_0_0_/_15%)] rounded-b-lg">
    
                <div class="bg-gray-800 rounded-b-lg">
                <img class="max-w-full h-auto rounded-b-lg" src="{{ asset('tahap_2.png')}}" alt="Image Description">
                </div>
            </figure>
            <!-- End Browser Device -->
            </div>
            <!-- End Devices -->
        </div>
    
        <div id="tabs-with-card-3" class="hidden" role="tabpanel" aria-labelledby="tabs-with-card-item-3">
            <!-- Devices -->
            <div class="max-w-[1140px] lg:pb-32 relative">
    
            <!-- Browser Device -->
            <figure class="ms-auto me-20 relative z-[1] max-w-full w-[50rem] h-auto shadow-[0_2.75rem_3.5rem_-2rem_rgb(45_55_75_/_20%),_0_0_5rem_-2rem_rgb(45_55_75_/_15%)] dark:shadow-[0_2.75rem_3.5rem_-2rem_rgb(0_0_0_/_20%),_0_0_5rem_-2rem_rgb(0_0_0_/_15%)] rounded-b-lg">
                <div class="bg-gray-800 rounded-b-lg">
                <img class="max-w-full h-auto rounded-b-lg" src="{{ asset('tahap_3.png') }}" alt="Image Description">
                </div>
            </figure>
            <!-- End Browser Device -->
            </div>
            <!-- End Devices -->
        </div>

        <div id="tabs-with-card-4" class="hidden" role="tabpanel" aria-labelledby="tabs-with-card-item-4">
            <!-- Devices -->
            <div class="max-w-[1140px] lg:pb-32 relative">
    
            <!-- Browser Device -->
            <figure class="ms-auto me-20 relative z-[1] max-w-full w-[50rem] h-auto shadow-[0_2.75rem_3.5rem_-2rem_rgb(45_55_75_/_20%),_0_0_5rem_-2rem_rgb(45_55_75_/_15%)] dark:shadow-[0_2.75rem_3.5rem_-2rem_rgb(0_0_0_/_20%),_0_0_5rem_-2rem_rgb(0_0_0_/_15%)] rounded-b-lg">
                <div class="bg-gray-800 rounded-b-lg">
                <img class="max-w-full h-auto rounded-b-lg" src="{{ asset('tahap_4.png') }}" alt="Image Description">
                </div>
            </figure>
            <!-- End Browser Device -->
            </div>
            <!-- End Devices -->
        </div>
        </div>
        <!-- End Tab Content -->
    </div>
    <!-- End Features -->


    <div class="py-0 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <h2 class="text-5xl font-extrabold dark:text-white">Inisiasi SDK Bot Telegram</h2>

        <ol class="relative border-s border-gray-200 dark:border-gray-700">                  
            <li class="mb-10 ms-4">
                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                {{-- <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"></time> --}}
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Konfigurasi Enviroment</h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Buka file konfigurasi <i>config/telegram.php</i> dan atur tokennya dengan Telegram Bot Token Anda atau Anda juga dapat mengatur variabel lingkungan TELEGRAM_BOT_TOKEN dengan nilai yang sesuai.</p>
                

                <div id="accordion-arrow-icon" data-accordion="open">

                    <h7 id="accordion-arrow-icon-heading-1">
                    <button type="button" class="flex items-center justify-between w-full p-3 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-arrow-icon-body-1" aria-expanded="true" aria-controls="accordion-arrow-icon-body-1">
                        <span><b><i>form input token</i></b></span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                    </h7>
                    <div id="accordion-arrow-icon-body-1" class="hidden" aria-labelledby="accordion-arrow-icon-heading-1">
                        <div class="p-4 border border-t-0 border-gray-200 dark:border-gray-700">
                            <div class="block max-w-100 p-6 bg-dark border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                    
                                    <div class="max-w-xl space-y-3">
                                            <div>
                                                <label for="inline-input-label-with-helper-text" class="block text-sm font-medium text-white dark:text-white">Token API</label>
                                                <div class="flex rounded-lg shadow-sm">
                                                    <input type="text" id="token_api" name="name" class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-s-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                    <button type="submit" id="list_grup" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-e-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                        Send
                                                    </button>
                                                </div>
                                            </div>

                                            <div role="status" class="hidden loadingBar">
                                                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                </svg>
                                                <span class="sr-only">Loading...</span>
                                            </div>

                                            <div id="tableContainer"></div>


                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                    
                    <h7 id="accordion-arrow-icon-heading-3">
                    <button type="button" class="flex items-center justify-between w-full p-3 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-arrow-icon-body-3" aria-expanded="false" aria-controls="accordion-arrow-icon-body-3">
                        <span><b><i>config/telegram.php</i></b></span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                    </h7>
                    <div id="accordion-arrow-icon-body-3" class="hidden" aria-labelledby="accordion-arrow-icon-heading-3">
                        <div class="p-4 border border-t-0 border-gray-200 dark:border-gray-700">
                            <div class="block max-w-100 p-6 bg-dark border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                <p class="font-normal text-white dark:text-white">
                                    'bots' => [<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;'mybot' => [<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'token' => <code>env('TELEGRAM_BOT_TOKEN')</code>,<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'certificate_path' => <code>env('TELEGRAM_CERTIFICATE_PATH', 'YOUR-CERTIFICATE-PATH')</code>,<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'webhook_url' => <code>env('TELEGRAM_WEBHOOK_URL', 'YOUR-BOT-WEBHOOK-URL')</code>,<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'allowed_updates' => null,<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'commands' => [<br>
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<code>
                                                    <i class="text-green-500">//Acme\Project\Commands\MyTelegramBot\BotCommand::class</i></code><br>
                                                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;],<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;],<br>
                                    ],
                                </p>

                            </div>
                        </div>
                    </div>

                    <h7 id="accordion-arrow-icon-heading-4">
                        <button type="button" class="flex items-center justify-between w-full p-3 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-arrow-icon-body-4" aria-expanded="false" aria-controls="accordion-arrow-icon-body-4">
                            <span><b><i>.env</i></b></span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                        </h7>
                        <div id="accordion-arrow-icon-body-4" class="hidden" aria-labelledby="accordion-arrow-icon-heading-4">
                        <div class="p-4 border border-t-0 border-gray-200 dark:border-gray-700">
                            <div class="block max-w-100 p-6 bg-dark border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    
                                <p class="font-normal text-white dark:text-white">
                                    <span class="font-normal text-blue-500">TELEGRAM_BOT_TOKEN</span> = <span class="token_bot"></span>
                                </i>
                                </p>
                            </div>
                        </div>
                        </div>
                </div>
  
            </li>
            <li class="mb-10 ms-4">
                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                {{-- <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">March 2022</time> --}}
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Method mengirim pesan telegram</h3>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Buat method untuk mengirim pesan telegram menggunakan library yang sudah disediakan oleh SDK Telegram. Kemudian parameter yang dibutuhkan adalah CHAT_ID dan MESSAGE yang ingin dikirim. 
                </p>
                <div class="block max-w-100 p-6 bg-dark border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                    
                    <p class="font-normal text-blue-500">
                        <span class="font-normal text-blue-500">use</span> <span class="font-normal text-white">Telegram\Bot\Laravel\Facades\</span><span class="font-normal text-green-400">Telegram</span>;<br>
                        <br>
                        $groupIds = <span class="font-normal text-white"><br>[
                            <span id="groupIds"></span>
                        <br>];</span><br><br>
                            {{-- <br>[@foreach ($chat_id as $index => $id)
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;[<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="font-normal text-green-500">"id"</span> : <code>{{ $id['id']}}</code>,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="font-normal text-green-500">"title"</span> : "{{ $id['title']}}"
                                @if ($index !== $lastIndex)
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;],
                                @else
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;]<br>
                                @endif
                            
                        @endforeach];</span><br><br> --}}
                        $message = <span class="font-normal text-orange-400">"Horizon sedang mati !!!"</span><span class="font-normal text-white">;</span>
                    
                    </p>

                    <p class="font-normal text-white dark:text-white">
                        <span class="font-normal text-purple-500">foreach</span><span class="font-normal text-yellow-300">(</span><span class="font-normal text-blue-500">$groupIds</span> as <span class="font-normal text-blue-500">$item</span><span class="font-normal text-yellow-300">)</span>  <span class="font-normal text-blue-300">{</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="font-normal text-green-400">Telegram</span><span class="font-normal text-yellow-300">::bot</span>(<span class="font-normal text-orange-400">'mybot'</span>)<span class="font-normal text-yellow-300">->sendMessage(</span><span class="font-normal text-purple-400">[</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="font-normal text-orange-400">'chat_id'</span> => <span class="font-normal text-blue-500">$item<span class="font-normal text-purple-400">[</span><span class="font-normal text-orange-400">"id"</span><span class="font-normal text-purple-400">]</span>,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="font-normal text-orange-400">'text'</span>  => <span class="font-normal text-blue-500">$message</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="font-normal text-purple-400">]</span><span class="font-normal text-yellow-300">)</span>;<br>       
                        <span class="font-normal text-blue-300">}</span>;<br>
                    
                    </p>
                </div>
            </li>
            <li class="ms-4">
                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                {{-- <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">April 2022</time> --}}
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pesan Terkirim</h3>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Ketika function dijalankan maka pesan akan terkirim ke dalam grup melalui bot yang sudah dibuat.</p>
                <div class="p-3 text-xs italic font-normal text-gray-500 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300 w-96">
                    <img class="dark:hidden" src="{{ asset('gambar_3.png') }}" alt="dashboard image">
                    <img class="hidden dark:block" src="{{ asset('gambar_3.png') }}" alt="dashboard image">
                </div>

            </li>
        </ol>
    </div>

</section>

<script>

    $(document).ready(function() {
        var groupIds = $('#groupIds');
        var token_bot = $('.token_bot');

        function fetchData() {
            $.ajax({
                url: 'getDataDoc',
                method: 'GET',
                success: function(response) {
                    var chatIds = response.chat_id;
                    var lastIndex = response.lastIndex;

                    // Kosongkan elemen sebelum menambahkan data baru
                    groupIds.empty();
                    token_bot.empty();

                    chatIds.forEach(function(item, index) {
                        var container = '<br>&nbsp;&nbsp;&nbsp;&nbsp;[<br>'+
                                        '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="font-normal text-green-500">"id"</span> : <code>' + item.id + '</code>,<br>'+
                                        '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="font-normal text-green-500">"title"</span> : "' + item.title + '"';
                        if (index !== lastIndex) {
                            container += '<br>&nbsp;&nbsp;&nbsp;&nbsp;],';
                        } else {
                            container += '<br>&nbsp;&nbsp;&nbsp;&nbsp;]';
                        }

                        groupIds.append(container);
                    });

                    var container_token = response.token_bot;
                    token_bot.append(container_token);
                },
                error: function() {
                    alert('gagal');
                }
            });
        }

        setInterval(fetchData, 5000);

        fetchData();

        $('#list_grup').click(function() {
  
            var value_api = $('#token_api').val();
            var tableContainer = $('#tableContainer');
            tableContainer.empty();
            if(value_api){  
                if(value_api != '') {
                  $('.loadingBar').show();
                      $.ajax({
                        url: 'getData/' + value_api,
                        method: 'GET',
                        success: function(response) {
                            $('.loadingBar').hide();
                            if(response.status == 'error') {
  
                                var container = '<span class="font-normal text-white">'+response.message+'</span>';
                                
                                tableContainer.append(container);
  
                                tableContainer.fadeOut(2000, function() {
                                    tableContainer.empty(); 
                                    tableContainer.show();
                                });
  
                            }else{
                                var container = '<div class="relative overflow-x-auto">'+
                                                        '<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">'+
                                                            '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">'+
                                                                '<tr>'+
                                                                    '<th scope="col" class="px-6 py-3">'+
                                                                        'List Grup'+
                                                                    '</th>'+
                                                                    '<th scope="col" class="px-6 py-3">'+
                                                                        'List Id'+
                                                                    '</th>'+
                                                                '</tr>'+
                                                            '</thead>'+
                                                            '<tbody id="testing">'+
                                                            '</tbody>'+
                                                        '</table>'+
                                                    '</div>';
                              tableContainer.append(container);
  
                              var bodyContainer = $('#testing');

  
                              response.forEach(function(item) {
  
                                  var table = '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">'+
                                                  '<td class="px-6 py-4">'+
                                                      item.title+
                                                  '</td>'+
                                                  '<td class="px-6 py-4">'+
                                                      item.id+
                                                  '</td>'+
                                              '</tr>';
                                  
                                     bodyContainer.append(table);
                                     
                              });

                              
                            }
  
                            
                        },
                        error: function() {
  
                          $('.loadingBar').hide();
                          $('#tableContainer').empty();
                        }
                    });
                }
                
  
            }else {
  
                $('.loadingBar').hide();
                $('#tableContainer').empty();
  
            }
        })
    });
    </script>

@endsection