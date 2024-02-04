 @extends('user.layouts.index')

@section('content')
    <div class="mx-auto mt-5 px-5 max-w-md">
        <div
            class="relative mb-5 pb-2 before:absolute before:bottom-0 before:left-0 before:h-px
                      before:w-6 before:bg-gray-950 after:absolute after:bottom-0 after:left-8 after:right-0 after:h-px
                      after:bg-gray-900/20">
            <h3 class="text-2xl font-mona font-medium">
                Notifikasi
            </h3>
        </div>
        @php
            use Carbon\Carbon;
        @endphp
        @if ($pesan->isEmpty())
            <h1 class="text-center mx-auto text-gray-400 font-semibold text-4xl">Tidak ada notifikasi</h1>
        @endif
        <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach ($pesan as $pesan)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="w-10 h-10 rounded-full" src="{{ asset('img/defaultProfile.svg') }}"
                                    alt="{{ $pesan->user->username }}">
                            </div>
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-base font-medium text-gray-900 truncate">
                                    {{ $pesan->user->fullname }} | {{ $pesan->user->username }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ Carbon::parse($pesan->created_at)->locale('id')->diffForHumans() }}
                                </p>
                            </div>
                            <div class="inline-flex gap-1 items-center text-sm font-semibold text-gray-900">
                                <a href="/notifikasi/{{ $pesan->id_pesan }}" class="text-blue-600 hover:underline">Lihat</a>
                                |
                                <form method="post" action="/pesan/{{ $pesan->id_pesan }}">
                                    @csrf
                                    @method('delete')
                                    <button class="text-blue-600 hover:underline">hapus</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
