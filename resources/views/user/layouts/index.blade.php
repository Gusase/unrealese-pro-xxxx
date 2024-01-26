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


            <main
                class="bg-white rounded-2xl h-full overflow-y-auto parent px-1.5 sm:px-4 w-full md:mx-3 lg:ml-0 no-scrollbar">
                @yield('content')
            </main>

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
                                class="text-white bg-red-700 !mt-0 hover:bg-red-800 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center">
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
            <button type="button"
                class="inline-flex aspect-square h-8 w-8 items-center justify-center rounded-md text-white outline-none ring-1 ring-gray-300 duration-150 focus-within:ring-2 hover:ring-2 focus:ring-2"
                data-dismiss-target="#alert" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 16">
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
