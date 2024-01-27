@extends('user.layouts.index')

@section('content')
    <div
        class="@if (!$files->isEmpty()) lg:grid-cols-4 2xl:grid-cols-5 min-[2368px]:grid-cols-6  sm:grid-cols-2 md:grid-cols-3 @else sm:grid-cols-1 md:grid-cols-1 place-items-center 2xl:grid-cols-1 min-[2368px]:grid-cols-1 lg:grid-cols-1 h-[90%] @endif grid grid-cols-2 gap-y-[20px] gap-x-[16px] p-3 sm:p-5">
        @if ($files->isEmpty())
            <h1 class="text-center mx-auto text-gray-400 font-semibold text-4xl">Tidak ada file</h1>
        @endif
        @foreach ($files as $file)
            @php
                $namaFile = explode('/', $file->generate_filename);
                $finalNamaFile = explode('.', end($namaFile));
                $finalNamaFile = $finalNamaFile[0];
            @endphp
            <div title="{{ $file->original_filename }}"
                class="flex w-full max-w-full flex-col bg-gray-100 border border-gray-200 rounded-lg shadow hover:bg-gray-200/20 duration-150 hover:shadow-md pb-2 card-file"
                data-id_file="{{ $file->id_file }}">

                <div class="my-1 px-3 py-1">
                    <div class="flex justify-between">
                        <div class="flex items-center gap-1 flex-1 min-w-0">
                            <img alt=""
                                src="{{ $file->user->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . $file->user->pp) }}"
                                class="relative inline-block h-9 w-9 aspect-square !rounded-full  border-2 border-white object-cover object-center hover:z-10" />
                            <div class="w-[90%] sm:min-w-[inherit] lg:w-full">
                                <a href="/global-file/show/{{ $file->id_user }}/{{ $finalNamaFile }}"
                                    class="break-all text-sm antialiased font-medium tracking-normal text-inherit line-clamp-1 w-fit isolate relative font-mona no-underline hover:before:scale-x-100 hover:text-black duration-150 p-0.5 pb-0">
                                    {{ $file->user->fullname }}</a>
                            </div>
                        </div>
                        <button data-dropdown-toggle="file-#{{ $file->id_file }}" data-modal-byclick
                            class="inline-block rounded-full ml-1 h-max mt-0.5 -mr-0.5 p-1.5 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            type="button">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 16 3">
                                <path
                                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                            </svg>
                        </button>
                    </div>
                </div>


                <div class="mt-px cursor-default">
                    <a href="/global-file/show/{{ $file->id_user }}/{{ $finalNamaFile }}"
                        class="overflow-hidden h-40 bg-white grid place-items-center relative isolate before:absolute before:inset-0 before:z-10 before:block before:origin-bottom-left before:scale-x-0 before:bg-gradient-to-r before:from-gray-200/25 before:opacity-25 before:transition-all hover:before:origin-top-left hover:before:scale-x-100 hover:before:opacity-100">
                        <img src="{{ asset('storage/' . $file->generate_filename) }}" alt="{{ $file->judul_file }}"
                            class="object-contain h-[inherit]">
                        {{-- @php
                        $mime = explode('/', $file->mime_type);
                        $extension = $file->ekstensi_file;
                    @endphp
                    @if ($mime[0] == 'image')
                        <img data-src="{{ asset('storage/' . $file->generate_filename) }}" alt="{{ $file->judul_file }}"
                            class="object-contain h-[inherit]">
                    @else
                        @include('user.layouts.svgThumbCard', ['ext' => $extension])
                    @endif --}}
                    </a>
                </div>

                <div class="pt-1 px-3 space-y-px">
                    <a href="/global-file/{{ end($namaFile) }}/{{ $file->id_user }}"
                        class="line-clamp-2 font-normal text-gray-900 isolate relative font-mona no-underline  hover:text-black duration-150 p-0.5 pb-0 w-fit"
                        title="{{ $file->judul_file }}">{{ $file->judul_file }}</a>
                    <p class="-mt-2 text-sm w-[calc(95%_+_1rem)] truncate text-gray-600/70 font-inter font-normal">
                        {{ $file->original_filename }}
                    </p>
                </div>
            </div>




            {{-- Drodown menu --}}
            <div id="file-#{{ $file->id_file }}"
                class="z-50 hidden w-44 list-none divide-y divide-gray-100 overflow-hidden rounded-lg bg-white text-base shadow dropdownUserIndex">
                <ul>
                    <li>
                        <a href="/download/{{ $file->id_file }}/{{ $file->id_user }}/{{ end($namaFile) }}"
                            class="inline-flex w-full items-center px-4 py-2 text-sm hover:bg-gray-100">
                            <svg class="mr-2 h-3 w-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 16 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                            </svg>
                            <span>Download</span>
                        </a>
                    </li>
                    <li>
                        <input type="hidden"
                            value="{{ config('app.url') . '/d/' . $file->id_user . '/' . end($namaFile) }}" id="link"
                            data-id_file="{{ $file->id_file }}">
                        <button
                            class="inline-flex items-center whitespace-nowrap px-4 py-2 text-sm hover:bg-gray-100 w-full"
                            id="salin" data-id_file="{{ $file->id_file }}">
                            <svg class="mr-2 h-3 w-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 19 19">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.013 7.962a3.519 3.519 0 0 0-4.975 0l-3.554 3.554a3.518 3.518 0 0 0 4.975 4.975l.461-.46m-.461-4.515a3.518 3.518 0 0 0 4.975 0l3.553-3.554a3.518 3.518 0 0 0-4.974-4.975L10.3 3.7" />
                            </svg>
                            <span>Share with link</span>
                        </button>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>

    @push('script')
        <script>
            function hideDropdownUserIndex(param) {
                const dpdwn = document.querySelectorAll(param);
                dpdwn.forEach((m) => {
                    m.classList.add("hidden");
                });
            }

            const buttonShowModalDelete = document.querySelectorAll("#buttonShowModalDelete");
            buttonShowModalDelete.forEach((b) => {
                b.addEventListener("click", () => {
                    hideDropdownUserIndex(".dropdownUserIndex");
                    const id_file = b.getAttribute("data-id_file");
                    const form = document.querySelector(`#formDeleteFile`);
                    form.action = `file/${id_file}`;
                });
            });

            const buttonSalinUrl = document.querySelectorAll("#salin");
            buttonSalinUrl.forEach((b) => {
                b.addEventListener("click", () => {
                    const id_file = b.getAttribute("data-id_file");
                    const linkUrl = document.querySelector(`#link[data-id_file="${id_file}"]`);
                    navigator.clipboard.writeText(linkUrl.value);
                    alert(`Link telah disalin ke clipboard`);
                });
            });
        </script>
    @endpush
@endsection
