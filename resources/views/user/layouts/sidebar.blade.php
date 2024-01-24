<div class="hidden lg:block">

    <a href="/baru" data-tooltip-target="create-file" data-tooltip-placement="right"
        class="!w-full rounded-xl shadow-md text-base max-md:w-full bg-white grid place-items-center pb-2 py-1 w-max transition-all hover:bg-gray-900 hover:text-white">
        <span class="text-3xl text-center block w-full">+</span>
    </a>
    <div id="create-file" role="tooltip"
        class="absolute z-30 whitespace-normal opacity-0 break-words inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm">
        <span class="text-xs">File baru</span>
    </div>

    <a href="" data-tooltip-target="file-mine" data-tooltip-placement="right"
        class="mt-5 flex gap-3 items-center px-4 py-2.5 rounded-full flex-col justify-center w-full aspect-square !mb-1 @if(request()->is('/') || request()->is('file*')) bg-gray-300 @else hover:bg-gray-200 @endif">
        <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 18a.969.969 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V9l4-4m-4 5h5m3-4h5V1m5 1v12a.97.97 0 0 1-.933 1H9.933A.97.97 0 0 1 9 14V5l4-4h5.067A.97.97 0 0 1 19 2Z" />
        </svg>
    </a>
    <div id="file-mine" role="tooltip"
        class="absolute z-30 whitespace-normal opacity-0 break-words inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm">
        <span class="text-xs">File saya</span>
    </div>

    <a href="/global-file" data-tooltip-target="public-file" data-tooltip-placement="right"
        class="mt-1.5 flex gap-3 items-center px-4 py-2.5 rounded-full flex-col justify-center w-full aspect-square !mb-1 @if(request()->is('global-file*')) bg-gray-300 @else hover:bg-gray-200 @endif">
        <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 21 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6.487 1.746c0 4.192 3.592 1.66 4.592 5.754 0 .828 1 1.5 2 1.5s2-.672 2-1.5a1.5 1.5 0 0 1 1.5-1.5h1.5m-16.02.471c4.02 2.248 1.776 4.216 4.878 5.645C10.18 13.61 9 19 9 19m9.366-6h-2.287a3 3 0 0 0-3 3v2m6-8a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </a>
    <div id="public-file" role="tooltip"
        class="absolute z-30 whitespace-normal opacity-0 break-words inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm">
        <span class="text-xs">File global</span>
    </div>

    @if (Auth::user()->status == 2)
        <a href="/admin" data-tooltip-target="admin-dashboard" data-tooltip-placement="right"
            class="mt-1.5 flex gap-3 items-center px-4 py-2.5 rounded-full flex-col justify-center w-full aspect-square !mb-1 @if(request()->is('admin*')) bg-gray-300 @else hover:bg-gray-200 @endif">
            <svg class="w-5 h-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z">
                </path>
            </svg>
        </a>
        <div id="admin-dashboard" role="tooltip"
            class="absolute z-30 whitespace-normal opacity-0 break-words inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm">
            <span class="text-xs">Admin dashboard</span>
        </div>
    @endif


    <hr class="my-2 h-px bg-gray-300 border-0" />


    <button data-tooltip-target="signout" data-tooltip-placement="right" data-modal-target="modal-signout"
        data-modal-toggle="modal-signout"
        class="mt-1.5 flex gap-3 items-center px-4 py-2.5 rounded-full flex-col justify-center w-full aspect-square !mb-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
            class="w-4 h-4">
            <path fill-rule="evenodd"
                d="M12 2.25a.75.75 0 01.75.75v9a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM6.166 5.106a.75.75 0 010 1.06 8.25 8.25 0 1011.668 0 .75.75 0 111.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788a.75.75 0 011.06 0z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
    <div id="signout" role="tooltip"
        class="absolute z-30 whitespace-normal opacity-0 break-words inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm">
        <span class="text-xs">Signout</span>
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
            <a href="/baru" data-tooltip-target="new-file" data-tooltip-placement="right"
                class="p-2 rounded-xl shadow-md text-base max-md:w-full bg-white pe-4 flex items-center gap-3 px-3 w-max transition-all hover:bg-gray-900 hover:text-white">
                <span class="-mr-1.5 text-3xl mb-1">+</span> Baru
            </a>

            <div class="block mt-5">
                <a href="{{ env('APP_URL') }}" data-tooltip-target="my-file" data-tooltip-placement="right"
                    class="flex gap-3 items-center mb-3 px-4 py-2.5 rounded-full @if(request()->is('/')) bg-gray-300 @else hover:bg-gray-200 @endif">
                    <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 18a.969.969 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V9l4-4m-4 5h5m3-4h5V1m5 1v12a.97.97 0 0 1-.933 1H9.933A.97.97 0 0 1 9 14V5l4-4h5.067A.97.97 0 0 1 19 2Z" />
                    </svg>
                    <span>File saya</span>
                </a>
                <a href="/global-file" data-tooltip-target="my-file" data-tooltip-placement="right"
                    class="flex gap-3 items-center mb-3 px-4 py-2.5 rounded-full @if(request()->is('global-file*')) bg-gray-300 @else hover:bg-gray-200 @endif">
                    <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 21 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6.487 1.746c0 4.192 3.592 1.66 4.592 5.754 0 .828 1 1.5 2 1.5s2-.672 2-1.5a1.5 1.5 0 0 1 1.5-1.5h1.5m-16.02.471c4.02 2.248 1.776 4.216 4.878 5.645C10.18 13.61 9 19 9 19m9.366-6h-2.287a3 3 0 0 0-3 3v2m6-8a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span style="ml-1">File global</span>
                </a>
                @if (Auth::user()->status == 2)
                    <a href="/admin" data-tooltip-target="my-file" data-tooltip-placement="right"
                        class="flex gap-3 items-center mb-3 px-4 py-2.5 rounded-full @if(request()->is('admin*')) bg-gray-300 @else hover:bg-gray-200 @endif">
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
                    class="flex w-full gap-3 items-center mb-3 px-4 py-2.5 rounded-full">
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