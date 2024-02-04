<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @if (session('download'))
    <meta http-equiv="refresh" content="0; url={{ url('/do/' . session('download')) }}">
    @endif
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    {{-- <title>{{ $title }} | {{ env('APP_NAME') }}</title> --}}
    <title>{{ $title }} | {{ config('app.name') }}</title>

    <!-- Tailwindcss-->
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('style')
</head>

<body class="antialiased bg-gray-100">

    <div class="bg-[inherit] h-screen md:pe-3 px-3 md:px-0 pb-4 2xl:pb-2 md:min-w-[1000px] md:max-w-[2000px] mx-auto">

        <header class="h-[70px]">
            <nav class="flex md:justify-between items-center gap-6 md:gap-0">
                @include('user.layouts.topbar')
            </nav>
        </header>

        <div class="flex w-full h-[90%]">
            <aside class="hidden lg:block h-full w-24 py-1 px-5">
                @include('user.layouts.sidebar')
            </aside>


            <main class="bg-white rounded-2xl h-full overflow-y-auto parent px-1.5 sm:px-4 w-full md:mx-3 lg:ml-0">
                @yield('content')
            </main>

        </div>
    </div>

    <div id="modalShareAnotherUser" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Share Another User
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 focus:bg-gray-200 focus:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalShareAnotherUser">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form id="formShareFile" method="post">
                        @csrf
                        {{-- <div class="mb-3 -mt-2 space-y-1">
                            <h5 class="font-medium">Now sharing: </h5>
                            <span class="font-mono fileshrnm truncate inline-block w-[calc(95%_+_1rem)]">~</span>
                        </div> --}}
                        <div class="space-y-4">
                            <div class="relative">
                                <label for="searchUser" class="block mb-2 text-sm font-medium text-gray-900">To
                                    user</label>
                                <input type="text" id="searchUser" name="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="someone..." required>
                                <small id="notfon" class="block text-sm font-medium text-gray-800 my-1.5"></small>
                                <ul id="result"
                                    class="hidden absolute z-20 shadow w-full py-2 text-sm text-gray-700 bg-white border-2 rounded-b-lg border-x border-gray-500">
                                </ul>
                            </div>
                            <div>
                                <label for="pesan" class="block mb-2 text-sm font-medium text-gray-900">Your
                                    message</label>
                                <textarea rows="2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="From {{ Auth::user()->username }}..." name="pesan"
                                    id="pesan"></textarea>
                            </div>
                        </div>
                        <div class="flex flex-col items-center border-t border-gray-200 rounded-b mt-2">
                            <div class="mt-6 w-full">
                                <button type="submit" id="sendFile"
                                    class="!w-full text-white bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 font-medium rounded-lg focus:ring-offset-2 text-sm px-5 py-2.5 text-center inline-flex w-full justify-center px-4 py-2.5 bg-gray-700 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                                    Kirim
                                </button>
                            </div>
                            <button
                                class="justify-center w-full text-center mt-2 inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-redd-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                data-modal-hide="modalShareAnotherUser">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="modal-sidebar"
        class="fixed top-0 left-0 z-40 w-64 2xl:w-[339px] h-screen overflow-y-auto transition-transform -translate-x-full bg-white"
        tabindex="-1">
        <div class="h-full px-4 py-3 overflow-y-auto bg-gray-50 rounded-e-xl">
            <div class="flex items-center justify-between gap-x-2">
                <button role="button" data-drawer-target="modal-sidebar" data-drawer-toggle="modal-sidebar"
                    aria-controls="modal-sidebar" type="button"
                    class="inline-flex group items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-200/80 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <svg class="w-5 h-5 group-hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
                <div class="flex justify-center items-center gap-2">
                    <a href="" class="flex items-center group">
                        <img class="rounded-full object-cover w-7 h-7 hover:ring-2 duration-150 hover:ring-gray-200 ring-offset-2"
                            src="{{ Auth::user()->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . Auth::user()->pp) }}"
                            width="40">
                    </a>

                    <div class="inline-block h-8 w-0.5 self-stretch bg-gray-300 opacity-100">
                    </div>

                    <a href="/notifikasi"
                        class="relative grid place-items-center text-sm rounded-full w-5 h-5 md:me-0 focus:ring-2 focus:ring-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                            <path
                                d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="mt-2.5">
                <a href="/baru"
                    class="p-2 rounded-xl shadow-md text-base max-md:w-full bg-white pe-4 flex items-center gap-3 px-3 w-max transition-all hover:bg-gray-900 hover:text-white">
                    <span class="-mr-1.5 text-3xl mb-1">+</span> Baru
                </a>

                <div class="block mt-5">
                    <a href="/"
                        class="flex gap-3 items-center mb-3 px-4 py-2.5 rounded-full @if (request()->is('/')) bg-gray-300 @else hover:bg-gray-200 @endif">
                        <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 18a.969.969 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V9l4-4m-4 5h5m3-4h5V1m5 1v12a.97.97 0 0 1-.933 1H9.933A.97.97 0 0 1 9 14V5l4-4h5.067A.97.97 0 0 1 19 2Z" />
                        </svg>
                        <span>File saya</span>
                    </a>
                    <a href="/global-file"
                        class="flex gap-3 items-center mb-3 px-4 py-2.5 rounded-full @if (request()->is('global-file*')) bg-gray-300 @else hover:bg-gray-200 @endif">
                        <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 21 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6.487 1.746c0 4.192 3.592 1.66 4.592 5.754 0 .828 1 1.5 2 1.5s2-.672 2-1.5a1.5 1.5 0 0 1 1.5-1.5h1.5m-16.02.471c4.02 2.248 1.776 4.216 4.878 5.645C10.18 13.61 9 19 9 19m9.366-6h-2.287a3 3 0 0 0-3 3v2m6-8a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span style="ml-1">File global</span>
                    </a>
                    @if (Auth::user()->status == 2)
                    <a href="/admin"
                        class="flex gap-3 items-center mb-3 px-4 py-2.5 rounded-full @if (request()->is('admin*')) bg-gray-300 @else hover:bg-gray-200 @endif">
                        <svg class="w-5 h-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z">
                            </path>
                        </svg>
                        <span class="ml-1">User Data</span>
                    </a>
                    @endif


                    <hr class="my-2 h-px bg-gray-300 border-0" />


                    <button data-tooltip-target="modal-signout" data-tooltip-placement="right"
                        data-modal-target="modal-signout" data-modal-toggle="modal-signout"
                        class="flex w-full gap-3 items-center mb-3 px-4 py-2.5 rounded-full hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            aria-hidden="true" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M12 2.25a.75.75 0 01.75.75v9a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM6.166 5.106a.75.75 0 010 1.06 8.25 8.25 0 1011.668 0 .75.75 0 111.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788a.75.75 0 011.06 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span style="ml-1">Log out</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div id="modal-signout" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button role="button" type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="modal-signout">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">Apakah serius ingin keluar?</h3>
                    <form action="/signout" method="post" class="inline-block mr-1">
                        @csrf
                        <div class="!w-max">
                            <button
                                class="inline-flex w-full justify-center px-4 py-2.5 bg-red-700 border border-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150""
                                class=" text-white bg-red-700 !mt-0 hover:bg-red-800 focus:ring-2 focus:ring-offset-2
                                focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center">
                                Signout
                            </button>
                        </div>
                    </form>
                    <button
                        class="inline-flex items-center px-4 py-2.5 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-redd-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                        data-modal-hide="modal-signout">
                        Tidak, batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalDeleteFile" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="modalDeleteFile">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">Kamu serius mau menghapus file dengan permanen?
                    </h3>
                    <form action="" id="formDeleteFile" class="inline" method="post">
                        @csrf
                        @method('delete')
                        <button data-modal-hide="modalDeleteFile" type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Delete
                        </button>
                    </form>
                    <button data-modal-hide="modalDeleteFile" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No,
                        Batal</button>
                </div>
            </div>
        </div>
    </div>

    <div id="verifyAccountModal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button role="button" type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="verifyAccountModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="text-lg font-normal text-gray-600"><span id="target-accv"
                            class="font-medium underline text-black"></span>
                        akan aktif dan dapat signin ke dalam web</h3>
                    <form action="" method="post" class="inline-block mr-1" id="form">
                        @csrf
                        <div class="!w-max">
                            <div class="mt-6 w-full">
                                <button
                                    class="inline-flex w-full justify-center px-4 py-2.5 bg-gray-700 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Verify</button>
                            </div>
                        </div>
                    </form>
                    <button data-modal-hide="verifyAccountModal"
                        class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-redd-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-deleteAcc" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button role="button" type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="modal-deleteAcc">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="text-lg font-normal text-gray-600"><span id="target-acc"
                            class="font-medium underline text-black"></span>
                        account's will be remove from database.</h3>
                    <form method="post" action="" class="inline-block mr-1" id="dxz">
                        @csrf
                        <div class="!w-max">
                            <div class="mt-6 w-full">
                                <button
                                    class="inline-flex w-full justify-center px-4 py-2.5 bg-gray-700 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Delete</button>
                            </div>
                        </div>
                    </form>
                    <button data-modal-hide="verifyAccountModal"
                        class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-redd-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('berhasil') || session()->has('gagal'))
    <div id="alert"
        class="absolute bottom-[2vh] left-[4vh] z-20 !mb-5 flex max-w-xl items-center space-x-2 rounded-lg bg-gray-700 p-3 text-white"
        role="alert">
        <div class="w-full pe-2 text-sm font-medium">
            <p>{{ session('gagal') }}</p>
            <p>{{ session('berhasil') }}</p>
        </div>
        <button type="button" autofocus
            class="inline-flex aspect-square h-8 w-8 items-center justify-center rounded-md text-white outline-none ring-1 ring-gray-300 duration-150 focus-within:ring-2 hover:ring-2 focus:ring-2"
            data-dismiss-target="#alert" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
            </svg>
        </button>
    </div>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    @stack('script')
    <script>
        document.addEventListener("keydown", (event) => {
            if (event.key === "/" && event.code === "Slash") {
                event.preventDefault();
                document.getElementById("global-search").focus();
            }
        });
    </script>
</body>

</html>