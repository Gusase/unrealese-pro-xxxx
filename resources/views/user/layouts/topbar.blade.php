<div class="flex flex-wrap items-center gap-5 md:gap-0 md:justify-between mx-auto p-5 md:px-5 px-0 pt-3 w-full">

    <button role="button" data-drawer-target="modal-sidebar" data-drawer-toggle="modal-sidebar"
        aria-controls="modal-sidebar"
        class="inline-flex group items-center p-2 ml-2 text-sm text-gray-500 rounded-lg hover:bg-gray-200/80 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <svg class="w-6 h-6 group-hover:text-black" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    @php
        $currentUrl = url()->current() === env('APP_URL');
    @endphp
    @if ($currentUrl ||
            $currentUrl . '/file-global' ||
            $currentUrl . '/admin' ||
            $currentUrl . '/notifikasi')
        <form class="w-4/5 max-md:mx-auto sm:w-1/2 xl:w-7/12">
            <div class="relative">
                <button role="button" type="submit"
                    class="absolute z-10 inset-y-0 start-0 flex items-center justify-center ml-1 h-9 w-9 mt-[6px] ml-2 rounded-lg hover:bg-gray-200 mx-auto"
                    title="Search something">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Enter to search</span>
                </button>
                <input type="text" id="global-search"
                    class="block w-full p-4 pl-12 md:px-12 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 ring-4 ring-transparent transition placeholder:text-neutral-500 focus:border-neutral-950 focus:outline-none focus:ring-neutral-950/5 h-12"
                    placeholder="Search..." value="{{ request('search') }}" name="search">
                <div
                    class="absolute z-10 inset-y-0 end-0 hidden md:flex items-center ml-1 h-9 w-9 mt-[6px] mr-2 rounded-lg">
                    <label for="global-search" class="mx-auto flex" title="Press / to search">
                        <kbd
                            class="px-2.5 py-1.5 text-xs font-semibold text-gray-800 select-none bg-gray-100 rounded-lg ring-1 ring-gray-900/20">/</kbd>
                    </label>
                </div>
            </div>
        </form>
    @endif

    <div
        class="lg:flex gap-2 md:gap-7 items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse hidden min-w-[10rem] w-0 justify-end">
        @unless (request()->is('notifikasi*'))
            <button role="button" type="button"
                class="relative grid place-items-center text-sm rounded-full w-5 h-5 md:me-0 focus:ring-2 focus:ring-gray-300"
                id="dropdownDefaultButton" data-dropdown-toggle="notif">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                    <path
                        d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
                </svg>
                @unless ($jumlahPesan == 0)
                    <span
                        class="absolute inline-flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2">{{ $jumlahPesan }}</span>
                @endunless
            </button>
            <div class="z-50 w-72 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow"
                id="notif">
                <div class="block px-3 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50">
                    Notifications
                </div>
                <div>
                    @unless (count($pesan))
                        <div class="px-3 py-4">
                            <div class="text-gray-700 text-center">
                                <span>No notification yet</span>
                            </div>
                        </div>
                    @endunless
                    @foreach (array_slice($pesan->all(), 0, 4) as $p)
                        <div class="px-3 py-2.5 flex items-center">
                            <div class="mr-3">
                                <div class="overflow-hidden">
                                    <img class="w-10 aspect-square rounded-full object-cover"
                                        src="{{ $p->user->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . $p->user->pp) }}"
                                        alt="{{ $p->id_pengirim }}">
                                </div>
                            </div>
                            <div>
                                <div title="{{ $p->created_at }}" class="text-xs text-gray-700">
                                    {{ $p->created_at->format('F d, Y h:i A') }}
                                </div>
                                <span class="text-[0.85rem]"><a href=""
                                        class="isolate text-[0.85rem] truncate w-[85%] md:w-max font-normal relative no-underline before:absolute before:inset-0 before:-z-[1] before:block before:bg-gray-300/75 before:transition-transform before:scale-x-0 before:origin-bottom-right hover:before:scale-x-100 hover:before:origin-bottom-left hover:text-black duration-150 p-0.5 pb-0">{{ $p->user->username }}</a>
                                    mengirim anda file! <a href=""
                                        class="text-gray-800 font-medium hover:underline">Lihat file.</a></span>
                            </div>
                        </div>
                    @endforeach
                    @if (count($pesan) > 4)
                        <a href="/notifikasi"
                            class="block py-2 w-full text-xs font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100">Notifikasi
                            lainnya</a>
                    @endif
                </div>
            </div>
        @endunless
        <button role="button"
            class="inline-flex min-w-0 items-center hover:ring-2 duration-150 hover:ring-gray-200 focus:ring-2 focus:ring-gray-200 rounded-full ring-offset-2"
            aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom"
            data-popover-trigger="click">
            <img class="rounded-full object-cover w-8 h-8"
                src="{{ Auth::user()->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . Auth::user()->pp) }}">
        </button>
        <!-- Dropdown menu -->
        <div class="hidden z-20 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg"
            id="user-dropdown">
            <div class="min-w-[250px] py-3">
                <div class="px-4 mb-1.5 mt-1.5">
                    <span class="block text-sm  text-gray-500 truncate">{{ Auth::user()->email }}</span>
                </div>
                <ul>
                    <li>
                        <button disabled href=""
                            class="inline-flex items-center w-full justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 opacity-50">
                            Profile
                            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 19a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 11 14H9a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 10 19Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </li>
                    <li>
                        <a href="/user/{{ auth()->id() }}/edit"
                            class="inline-flex items-center w-full justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Settings
                            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path
                                        d="M19 11V9a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L12 2.757V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L2.929 4.343a1 1 0 0 0 0 1.414l.536.536L2.757 8H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535L8 17.243V18a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H18a1 1 0 0 0 1-1Z" />
                                    <path d="M10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </g>
                            </svg>
                        </a>
                    </li>
                </ul>
                <hr class="my-2.5 w-10/12 mx-auto h-px border-0 bg-gray-300">
                <ul>
                    <li>
                        <button role="button" data-modal-target="modal-signout" data-modal-toggle="modal-signout"
                            type="button"
                            class="w-full block text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Signout</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
