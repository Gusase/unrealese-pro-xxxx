@extends('user.layouts.index')

@section('content')
    @push('style')
        <style>
            .thumbnailCard {
                background: #ddd;
                min-height: 200px;
            }

            .dropArea {
                max-width: 100%;
                height: 200px;
                padding: 25px;
                display: grid;
                background-color: #f7f9fe;
                place-items: center;
                text-align: center;
                font-family: sans-serif;
                font-weight: 500;
                font-size: 1.2rem;
                cursor: pointer;
                color: #ccc;
                border: 4px dashed #4b5563;
                border-radius: 10px;
            }

            .dropArea.error {
                border: 2px solid red
            }

            .dropArea-over {
                border-style: solid;
            }

            .dropFile {
                display: none;
            }

            .dropArea-thumb {
                width: 100%;
                height: 100%;
                border-radius: 10px;
                overflow: hidden;
                background: #ccc;
                background-size: contain;
                background-position: center;
                background-repeat: no-repeat;
                position: relative;
            }

            .dropArea-thumb::after {
                content: attr(data-label);
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                padding: 5px 0;
                color: white;
                background: rgba(0, 0, 0, .75);
                font-size: .9rem;
                text-align: center;
            }

            .thumb-card {
                display: grid;
                place-items: center;
                background: #ddd;
                height: 200px;
            }

            .thumb-card img {
                width: 100%;
                max-height: 200px;
                object-fit: cover;
                object-position: top;
            }
        </style>
    @endpush

    <div class="max-w-2xl px-1.5 sm:px-0 py-5 lg:mx-auto">
        <form method="post" action="/file" enctype="multipart/form-data" id="form">
            @csrf

            <div
                class="!pb-1 relative mb-5 pb-4 before:absolute before:bottom-0 before:left-0 before:h-px
            before:w-6 before:bg-gray-950 after:absolute after:bottom-0 after:left-8 after:right-0 after:h-px
            after:bg-gray-900/20">
                <h2 class="text-2xl font-mona leading-7 text-gray-900 font-medium">Tambah file baru</h2>
            </div>

            <div class="dropArea mb-4">
                <div class="dropText font-poppins font-normal">
                    <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Klik untuk unggah</span> atau tarik dan
                        taruh file</p>
                    @error('files')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <input type="file" name="files" id="files" class="dropFile">
            </div>

            <div class="mt-6">
                <label class="text-gray-900 font-semibold mb-1.5 block md:text-base text-sm" for="judul_file">Judul
                    file</label>
                <input
                    class="w-full rounded-md border-0
                    px-2 py-2.5 sm:py-1.5 text-gray-900m bg-gray-100/50m shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 outline-none text-sm md:text-base @error('judul_file') ring-red-600 ring-2 @enderror"
                    id="judul_file" type="text" name="judul_file" value="{{ old('judul_file') }}" required />
                @error('judul_file')
                    <ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
                        <p>{{ $message }}</p>
                    </ul>
                @enderror
            </div>

            <div class="my-4">
                <p class="mb-2 block text-sm font-medium text-gray-900">Status file</p>
                <ul class="mb-4 gap-y-2 sm:gap-y-0 grid grid-cols-1 gap-x-2 sm:grid-cols-2">
                    <li>
                        <input type="radio" id="status-2" name="status" value="public" class="peer hidden"
                            {{ old('status') == 'public' ? 'checked' : '' }}>
                        <label for="status-2"
                            class="@error('status') animate-shake @enderror inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-3 text-gray-900 hover:bg-gray-100 hover:text-gray-900 peer-checked:border-gray-600 peer-checked:text-gray-600">
                            <div class="block">
                                <div class="w-full text-base font-normal">Public</div>
                                <div class="mt-1 w-full text-xs text-gray-500">File dapat dilihat oleh orang lain pada menu
                                    file global</div>
                            </div>
                            <svg class="ms-3 h-4 w-4 text-gray-500 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                </g>
                            </svg>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="status-1" name="status" value="private" class="peer hidden"
                            {{ old('status') == 'public' ? 'checked' : '' }}>
                        <label for="status-1"
                            class="@error('status') animate-shake @enderror inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-3 text-gray-900 hover:bg-gray-100 hover:text-gray-900 peer-checked:border-gray-600 peer-checked:text-gray-600">
                            <div class="block">
                                <div class="w-full text-base font-normal">Privat</div>
                                <div class="mt-1 w-full text-xs text-gray-500">File tidak dapat diliat orang lain tapi bisa
                                    dilihat jika dikirim antar user</div>
                            </div>
                            <svg class="ms-3 h-4 w-4 text-gray-500 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1.933 10.909A4.357 4.357 0 0 1 1 9c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 19 9c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M2 17 18 1m-5 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </label>
                    </li>
                </ul>
                @error('status')
                    <ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
                        <p>{{ $message }}</p>
                    </ul>
                @enderror
            </div>

            <div class="mb-4">
                <label for="floatingTextarea2"
                    class="mb-2 block text-sm font-medium text-gray-900 capitalize">Deskripsi</label>
                <textarea
                    class="block w-full rounded-lg border outline-none border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-gray-500 focus:ring-2 ring-inset focus:ring-gray-500 @error('deskripsi') animate-shake ring-gray-600 ring-2 @enderror"
                    placeholder="Tambahkan deskripsi disini" id="floatingTextarea2" style="height: 100px" name="deskripsi"></textarea>
                @error('deskripsi')
                    <span class="text-gray-500 text-xs" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>


            <div class="mt-6 flex items-center justify-start gap-x-4">
                <div class="!w-max -mt-6">
                    <div class="mt-6 w-full">
                        <button
                            class="inline-flex w-full justify-center px-4 py-2.5 bg-gray-700 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                            <p>Tambah</p>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('script')
        <script>
            document.querySelectorAll(".dropFile").forEach((i) => {
                const dropArea = i.closest(".dropArea");
                dropArea.addEventListener("click", (e) => {
                    i.click();
                });

                i.addEventListener("change", (e) => {
                    if (i.files.length) {
                        thumb(dropArea, i.files[0]);
                    }
                });

                dropArea.addEventListener("dragover", (e) => {
                    e.preventDefault();
                    dropArea.classList.add("dropArea-over");
                });
                ["dragleave", "dragend"].forEach((type) => {
                    dropArea.addEventListener(type, (e) => {
                        dropArea.classList.remove("dropArea-over");
                    });
                });
                dropArea.addEventListener("drop", (e) => {
                    e.preventDefault();
                    if (e.dataTransfer.files.length) {
                        i.files = e.dataTransfer.files;
                        thumb(dropArea, e.dataTransfer.files[0]);
                    }
                    dropArea.classList.remove("dropArea-over");
                });
            });

            function thumb(dropArea, file) {
                let thumbElement = dropArea.querySelector(".dropArea-thumb");

                if (dropArea.querySelector(".dropText")) {
                    dropArea.querySelector(".dropText").remove();
                }

                if (!thumbElement) {
                    thumbElement = document.createElement("div");
                    thumbElement.classList.add("dropArea-thumb");
                    dropArea.appendChild(thumbElement);
                }
                thumbElement.dataset.label = file.name;

                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => {
                        thumbElement.style.backgroundImage = `url('${reader.result}')`;
                    };
                } else {
                    thumbElement.style.backgroundImage = null;
                }
            }
        </script>
    @endpush
@endsection