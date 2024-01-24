@extends('user.layouts.index')

@section('content')
    <div class="max-w-4xl py-5 xl:mx-auto mt-10">

        <form action="/editUser/{{ $user->id_user }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex mx-auto">
                <div class="space-y-5 w-2/3 mx-auto">
                    <div
                        class="!pb-1 w-[80%] relative mb-5 pb-4 before:absolute before:bottom-0 before:left-0 before:h-px
              before:w-6 before:bg-gray-950 after:absolute after:bottom-0 after:left-8 after:right-0 after:h-px
              after:bg-gray-900/20">
                        <h2 class="text-2xl font-normal font-mona leading-7 text-gray-900 pb-2">Edit profil</h2>
                    </div>
                    <div class="mt-1.5 grid w-[80%] sm:grid-cols-1">
                        <label class="text-gray-900 font-semibold mb-1.5 block md:text-base text-sm" for="fullname">Nama
                            Lengkap</label>
                        <input
                            class="w-full rounded-md border-0
                                px-2 py-2.5 sm:py-1.5 text-gray-900m bg-gray-100/50m shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 outline-none text-sm md:text-base @error('fullname') ring-red-600 ring-2 @enderror"
                            id="fullname" type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}"
                            required />
                        @error('fullname')
                            <ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
                                <p>{{ $message }}</p>
                            </ul>
                        @enderror
                    </div>
                    <div class="mt-1.5 grid w-[80%] sm:grid-cols-1">
                        <label class="text-gray-900 font-semibold mb-1.5 block md:text-base text-sm"
                            for="username">Username</label>
                        <input
                            class="w-full rounded-md border-0
                                px-2 py-2.5 sm:py-1.5 text-gray-900m bg-gray-100/50m shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 outline-none text-sm md:text-base @error('username') ring-red-600 ring-2 @enderror"
                            id="username" type="text" name="username" value="{{ old('username', $user->username) }}"
                            required />
                        @error('username')
                            <ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
                                <p>{{ $message }}</p>
                            </ul>
                        @enderror
                    </div>
                    <div class="mt-1.5 grid w-[80%] sm:grid-cols-1">
                        <label class="text-gray-900 font-semibold mb-1.5 block md:text-base text-sm"
                            for="email">Email</label>
                        <input
                            class="w-full rounded-md border-0
                                px-2 py-2.5 sm:py-1.5 text-gray-900m bg-gray-100/50m shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 outline-none text-sm md:text-base @error('email') ring-red-600 ring-2 @enderror"
                            id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                            required />
                        @error('email')
                            <ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
                                <p>{{ $message }}</p>
                            </ul>
                        @enderror
                    </div>
                    <div class="mt-1.5 grid w-[80%] sm:grid-cols-1">
                        <label class="text-gray-900 font-semibold mb-1.5 block md:text-base text-sm"
                            for="password">Password</label>
                        <input
                            class="w-full rounded-md border-0
                                px-2 py-2.5 sm:py-1.5 text-gray-900m bg-gray-100/50m shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 outline-none text-sm md:text-base @error('password') ring-red-600 ring-2 @enderror"
                            id="password" type="text" name="password" />
                        @error('password')
                            <ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
                                <p>{{ $message }}</p>
                            </ul>
                        @enderror
                    </div>
                    <small>
                        *jika password terisi otomatis dan tidak ingin merubah password silahkan kosongkan password.
                    </small>
                    <button type="submit"
                        class="inline-flex w-min mt-4 justify-center px-4 py-2.5 bg-gray-700 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Edit</button>
                </div>
                {{-- <div class="w-1/3 -mx-1.5">
                    <div class="flex flex-col items-center sm:mt-5">
                        <button
                            class="w-48 h-48 focus:outline-none focus:ring-1 focus:ring-gray-400 ring-offset-4 rounded-full duration-100 group relative"
                            type="button" onclick="openFile()">
                            <img class="w-full h-full object-cover rounded-full shadow-lg hover:brightness-95 duration-150"
                                src="{{ Auth::user()->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . Auth::user()->pp) }}"
                                id="imgPreview" />
                            <span
                                class="absolute inset-0 bg-white/70 rounded-full backdrop-blur-md flex justify-center items-center text-xl capitalize text-gray-800 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-300">change
                                image</span>
                        </button>
                        <div class="mt-3">
                            <input
                                class="!hidden !invisible !p-1.5 w-full rounded-md border-0
                                px-2 py-2.5 sm:py-1.5 text-gray-900m bg-gray-100/50m shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 outline-none text-sm md:text-base @error('pp') ring-red-600 ring-2 @enderror"
                                id="pp" type="file" name="pp" required
                                accept="image/gif,image/png,image/jpg,image/jpeg" onchange="showPreview(event)" />
                            @error('pp')
                                <ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
                                    <p>{{ $message }}</p>
                                </ul>
                            @enderror
                        </div>
                    </div>
                </div> --}}
            </div>
        </form>
    </div>

    @push('script')
        <script>
            function openFile() {
                document.getElementById('pp').click();
            }

            function showPreview(event) {
                if (event.target.files.length > 0) {
                    let src = URL.createObjectURL(event.target.files[0]);
                    let preview = document.getElementById("imgPreview");
                    preview.src = src;
                }
            }
        </script>
    @endpush
@endsection
