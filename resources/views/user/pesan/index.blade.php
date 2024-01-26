@extends('user.layouts.index')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    @if ($pesan->isEmpty())
        <h1 class="text-center mx-auto text-gray-400 font-semibold text-4xl">Tidak ada notifikasi</h1>
    @endif
    <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($pesan as $pesan)
                <li class="py-3 sm:py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded-full" src="{{ asset('img/defaultProfile.svg') }}"
                                alt="{{ $pesan->user->username }}">
                        </div>
                        <div class="flex-1 min-w-0 ms-4">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $pesan->user->fullname }} | {{ $pesan->user->username }}
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                                {{ $pesan->user->email }}
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                                {{ Carbon::parse($pesan->created_at)->locale('id')->diffForHumans() }}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900">
                            <a href="/notifikasi/{{ $pesan->id_pesan }}">Lihat</a>
                            <form method="post" action="/pesan/{{ $pesan->id_pesan }}">
                                @csrf
                                @method('delete')
                                <button>hapus</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
