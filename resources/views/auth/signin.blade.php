<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    <title>Signin | {{ config('app.name') }}</title>

    <!-- Tailwindcss-->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-200 grid place-items-center min-h-screen">

    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

        <div class="w-96">
            <div>
                <h2 class="mb-8 text-center text-2xl font-semibold leading-9 text-gray-900">
                    Signin
                </h2>
            </div>

            <div class="bg-white rounded-lg shadow-xl">
                <div class="p-6 sm:p-8">
                    <form action="signin" method="post">
                        @csrf
                        <div class="mt-2.5">
                            <label class="text-gray-900 font-semibold mb-1.5 block md:text-base text-sm"
                                for="username_email">Username
                                atau Email</label>
                            <input
                                class="w-full rounded-md border-0
                                px-2 py-2.5 sm:py-1.5 text-gray-900m bg-gray-100/50m shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 outline-none text-sm md:text-base @error('username_email') ring-red-600 ring-2 @enderror"
                                id="username_email" type="text" name="username_email"
                                value="{{ old('username_email') }}" required />
                            @error('username_email')
                                <ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
                                    <p>{{ $message }}</p>
                                </ul>
                            @enderror
                        </div>
                        <div class="mt-6">
                            <label class="text-gray-900 font-semibold mb-1.5 block md:text-base text-sm"
                                for="password">Password</label>
                            <input
                                class="w-full rounded-md border-0
                                px-2 py-2.5 sm:py-1.5 text-gray-900m bg-gray-100/50m shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6 outline-none text-sm md:text-base @error('username_email') ring-red-600 ring-2 @enderror"
                                id="password" type="password" name="password" required />
                            @error('password')
                                <ul class="text-red-500 text-xs space-y-1 list-disc list-inside mt-1.5">
                                    <p>{{ $message }}</p>
                                </ul>
                            @enderror
                        </div>

                        <div class="mt-6 w-full">
                            <button
                                class="inline-flex w-full justify-center px-4 py-2.5 bg-gray-700 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">signin</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="sm:mx-auto sm:w-full sm:max-w-sm bg-white rounded-lg shadow-xl p-6 sm:p-5 mt-4">
                <p class="text-sm font-light text-gray-500">
                    Belum punya akun? <a href="/signup"
                        class="font-semibold leading-6 text-gray-600 decoration-2 underline-offset-2 hover:underline hover:decoration-gray-700">signup</a>
                </p>
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

    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>
