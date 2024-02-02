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

                <div class="flex justify-between px-2 mt-2 my-1">
                    <a href="/file/show/{{ $file->id_user }}/{{ $finalNamaFile }}" class="w-full">
                        <span
                            class="line-clamp-1 break-all font-medium text-gray-800 w-fit isolate relative font-mona no-underline hover:text-black duration-150 p-0.5 pb-0 text-base sm:text-lg font-mona"
                            title="{{ $file->original_filename }}">{{ $file->original_filename }}</span>
                    </a>
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

                <a href="/file/show/{{ $file->id_user }}/{{ $finalNamaFile }}"
                    class="overflow-hidden h-40 mt-px cursor-pointer bg-white grid place-items-center relative isolate before:absolute before:inset-0 before:z-10 before:block before:origin-bottom-left before:scale-x-0 before:bg-gradient-to-r before:from-gray-200/25 before:opacity-25 before:transition-all hover:before:origin-top-left hover:before:scale-x-100 hover:before:opacity-100">
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




            {{-- Drodown menu --}}
            <div id="file-#{{ $file->id_file }}"
                class="z-50 hidden w-44 list-none divide-y divide-gray-100 overflow-hidden rounded-lg bg-white text-base shadow dropdownUserIndex">
                <ul>
                    <li>
                        <a href="/file/{{ $file->id_file }}/edit"
                            class="inline-flex w-full items-center px-4 py-2 text-sm hover:bg-gray-100">
                            <svg class="mr-2 h-3 w-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                <path
                                    d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                            </svg>
                            <span>Edit</span>
                        </a>
                    </li>
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
                    <li>
                        <button
                            class="inline-flex items-center whitespace-nowrap px-4 py-2 text-sm hover:bg-gray-100 w-full"
                            id="buttonShowModalShare" data-user="{{ Auth::user()->username }}"
                            data-modal-target="modalShareAnotherUser" data-modal-toggle="modalShareAnotherUser"
                            data-id_file="{{ $file->id_file }}">
                            <svg class="mr-2 h-4 w-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            <span>Share with user</span>
                        </button>
                    </li>
                    <li>
                        <button data-modal-target="modalDeleteFile" data-modal-toggle="modalDeleteFile"
                            id="buttonShowModalDelete" data-id_file="{{ $file->id_file }}"
                            class="inline-flex w-full items-center bg-red-500 px-4 py-2 text-left text-sm text-white hover:bg-red-600">
                            <svg class="mr-2 h-3 w-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                            </svg>
                            <span>Hapus</span>
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

            /**
             * Modal Share Another User
             */
            const buttonShowModalShare = document.querySelectorAll("#buttonShowModalShare");
            buttonShowModalShare.forEach((b) => {
                b.addEventListener("click", () => {
                    const modalShareAnotherUser = document
                        .querySelector("#modalShareAnotherUser")
                        .classList.add("hidden");
                    const id_file = b.getAttribute("data-id_file");
                    hideDropdownUserIndex(".dropdownUserIndex");
                    const form = document.querySelector('#formShareFile');
                    form.action = "";
                    form.action = "file/send/" + id_file;
                    console.log(form.action)
                });
            });

            // /**
            //  * Kalau pas search nama user klik diluar elemnt daftar nama user
            //  */
            // const areaResultUser = document.querySelector("#result");
            // areaResultUser &&
            //     document.addEventListener("click", function(event) {
            //         // Periksa apakah klik dilakukan di luar elemen result
            //         if (!areaResultUser.contains(event.target)) {
            //             // Jika ya, tambahkan class hidden pada elemen result
            //             areaResultUser.classList.add("hidden");
            //         }
            //     });
            // // Event listener untuk menampilkan kembali elemen result jika diklik
            // areaResultUser &&
            //     areaResultUser.addEventListener("click", function(event) {
            //         // Hapus class hidden saat elemen result diklik
            //         areaResultUser.classList.remove("hidden");
            //     });

            // /**
            //  * Deklarasi variable
            //  */
            // const result = document.querySelector("#result");
            // const textAreaPesan = document.querySelector("#pesan");
            // const buttonModalShare = document.querySelectorAll("#bSearch");
            // const searchUser = document.querySelector("#searchUser");
            // const notfon = document.querySelector("#notfon");
            // const btnSendFile = document.querySelector("#sendFile");
            // let clicked = false;
            // let username;

            // textAreaPesan &&
            //     textAreaPesan.addEventListener("focus", () => {
            //         result.classList.add("hidden");
            //         searchUser.classList.add("rounded-lg");
            //         searchUser.classList.remove("rounded-t-lg");
            //     });

            // searchUser &&
            //     searchUser.addEventListener("input", () => {
            //         let valueSearch = searchUser.value.trim();
            //         if (valueSearch != "") {
            //             result.innerHTML = "<span class='block px-4 py-2'>Loading...</span>";
            //             const {
            //                 userPromise
            //             } = fetch(`/username?q=${valueSearch}`, {
            //                     method: "GET",
            //                     headers: {
            //                         "Content-Type": "application/json",
            //                     },
            //                 })
            //                 .then((response) => {
            //                     return response.json();
            //                 })
            //                 .then((dataUsers) => {
            //                     const users = dataUsers.dataUsers;
            //                     result.innerHTML = "";
            //                     searchUser.addEventListener("keyup", function() {
            //                         clicked = false;
            //                         btnSendFile.disabled = true;
            //                     });

            //                     if (users.length == 0) {
            //                         searchUser.classList.add("rounded-lg");
            //                         searchUser.classList.remove("rounded-t-lg");
            //                         result.classList.add("hidden");
            //                         notfon.textContent = `User '${valueSearch}' tidak ada!`;
            //                         notfon.classList.remove("hidden");
            //                         notfon.classList.add("block");
            //                         btnSendFile.disabled = true;
            //                     } else {
            //                         searchUser.classList.remove("rounded-lg");
            //                         searchUser.classList.add("rounded-t-lg");
            //                         result.classList.remove("hidden");
            //                         result.classList.add("block");
            //                         notfon.classList.remove("block");
            //                         notfon.classList.add("hidden");
            //                     }

            //                     users.forEach((user) => {
            //                         const li = document.createElement("li");
            //                         li.textContent = user.username;
            //                         li.classList.add(
            //                             "userLi",
            //                             "block",
            //                             "px-4",
            //                             "py-2",
            //                             "hover:bg-gray-100"
            //                         );
            //                         li.setAttribute("role", "button");
            //                         result.appendChild(li);

            //                         let liUser = document.querySelectorAll(".userLi");
            //                         liUser.forEach((uli) => {
            //                             uli.addEventListener("click", () => {
            //                                 searchUser.value = uli.innerText;
            //                                 result.innerHTML = "";
            //                                 countResult = null;
            //                                 clicked = true;

            //                                 if (clicked) {
            //                                     searchUser.classList.add("rounded-lg");
            //                                     searchUser.classList.remove("rounded-t-lg");
            //                                     result.classList.add("hidden");
            //                                     btnSendFile.disabled = false;
            //                                 } else {
            //                                     btnSendFile.disabled = true;
            //                                 }
            //                             });
            //                         });
            //                     });
            //                 })
            //                 .catch((error) => {
            //                     console.error(`Tetot ada error ni: ${error.message}`);
            //                 });
            //         } else {
            //             searchUser.classList.add("rounded-lg");
            //             searchUser.classList.remove("rounded-t-lg");
            //             notfon.classList.add("hidden");
            //             notfon.classList.remove("block");
            //             result.classList.add("hidden");
            //             result.classList.remove("block");
            //             result.innerHTML = "";
            //             btnSendFile.disabled = true;
            //         }
            //     });
        </script>
    @endpush
@endsection
