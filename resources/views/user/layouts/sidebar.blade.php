<div class="hidden lg:block">

    <a href="/baru" data-tooltip-target="create-file" data-tooltip-placement="right"
        class="!w-full rounded-xl shadow-md text-base max-md:w-full bg-white grid place-items-center pb-2 py-1 w-max transition-all hover:bg-gray-900 hover:text-white">
        <span class="text-3xl text-center block w-full">+</span>
    </a>
    <div id="create-file" role="tooltip"
        class="absolute z-30 whitespace-normal opacity-0 break-words inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm">
        <span class="text-xs">File baru</span>
    </div>

    <a href="/" data-tooltip-target="file-mine" data-tooltip-placement="right"
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
        class="mt-1.5 flex gap-3 items-center px-4 py-2.5 rounded-full flex-col justify-center w-full aspect-square !mb-1 hover:bg-gray-200">
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




