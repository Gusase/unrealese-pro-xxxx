@extends('user.layouts.index')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div
        class="relative mb-5 pb-4 mt-5 before:absolute before:bottom-0 before:left-0 before:h-px
            before:w-6 before:bg-gray-950 after:absolute after:bottom-0 after:left-8 after:right-0 after:h-px
            after:bg-gray-900/20">
        <h3 class="text-2xl font-mona font-medium">
            Detail File
        </h3>
    </div>

    <ul role="list" class="grid w-full grid-cols-2 gap-x-6 gap-y-3 text-sm sm:grid-cols-3 md:gap-y-10 lg:grid-cols-4 my-4">
        <li
            class="rounded-2xl md:border border-gray-200 p-4 sm:p-6 border-l border-gray-600 flex flex-col items-start gap-x-1.5">
            <div class="w-8 h-8">
                <h2 class="text-2xl sm:text-3xl font-semibold font-mona"
                    style="font-variation-settings: &quot;wdth&quot; 125;">{{ $countUsers }}
                </h2>
            </div>
            <h3 class="font-mona font-normal text-sm sm:text-base text-gray-900 mt-2">Total User</h3>
        </li>
        <li
            class="rounded-2xl md:border border-gray-200 p-4 sm:p-6 border-l border-gray-600 flex flex-col items-start gap-x-1.5">
            <div class="w-8 h-8">
                <h2 class="text-2xl sm:text-3xl font-semibold font-mona"
                    style="font-variation-settings: &quot;wdth&quot; 125;">{{ $countFiles }}
                </h2>
            </div>
            <h3 class="font-mona font-normal text-sm sm:text-base text-gray-900 mt-2">Total file</h3>
        </li>
        <li
            class="rounded-2xl md:border border-gray-200 p-4 sm:p-6 border-l border-gray-600 flex flex-col items-start gap-x-1.5">
            <div class="w-8 h-8">
                <h2 class="text-2xl sm:text-3xl font-semibold font-mona"
                    style="font-variation-settings: &quot;wdth&quot; 125;">{{ $userVerified }}
                </h2>
            </div>
            <h3 class="font-mona font-normal text-sm sm:text-base text-gray-900 mt-2">User Terverifikasi</h3>
        </li>
        <li
            class="rounded-2xl md:border border-gray-200 p-4 sm:p-6 border-l border-gray-600 flex flex-col items-start gap-x-1.5">
            <div class="w-8 h-8">
                <h2 class="text-2xl sm:text-3xl font-semibold font-mona"
                    style="font-variation-settings: &quot;wdth&quot; 125;">{{ $userUnverified }}
                </h2>
            </div>
            <h3 class="font-mona font-normal text-sm sm:text-base text-gray-900 mt-2">User Belum Terverifikasi</h3>
        </li>
    </ul>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 text-center">
                        #
                    </th>
                    <th scope="col" class="py-3 text-center">
                        Nama
                    </th>
                    <th scope="col" class="py-3 text-center">
                        Username
                    </th>
                    <th scope="col" class="py-3 text-center">
                        Email
                    </th>
                    <th scope="col" class="text-center">
                        Tanggal Register
                    </th>
                    <th scope="col" class="py-3 text-center">
                        Status
                    </th>
                    <th scope="col" class="py-3 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @unless ($countUsers > 0)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" colspan="6">
                            Tidak ada data user
                        </th>
                    </tr>
                @endunless
                @foreach ($users as $user)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                            {{ $loop->iteration }}
                        </th>
                        <td class="py-4">
                            {{ $user->fullname }}
                        </td>
                        <td class="py-4 text-center">
                            {{ $user->username }}
                        </td>
                        <td class="py-4 text-center">
                            {{ $user->email }}
                        </td>
                        <td class="py-4 text-center">
                            {{ Carbon::parse($user->created_at)->locale('id')->diffForHumans() }}
                        </td>
                        <td class="py-4 text-center">
                            @if ($user->status == 0)
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-sm font-medium px-2.5 py-0.5 rounded">pending</span>
                            @else
                                <span
                                    class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">verified</span>
                            @endif
                        </td>
                        <td class="py-4 text-center">
                            <button
                                class="font-medium @if ($user->status == 1) text-gray-300 @else text-blue-600
                          hover:underline @endif verifyA"
                                @if ($user->status == 1) disabled @endif data-user="{{ $user->id_user }}"
                                data-acc="{{ $user->fullname }}" data-modal-target="verifyAccountModal"
                                data-modal-show="verifyAccountModal">
                                Verify
                            </button>
                            |
                            <a href="admin/edit/{{ $user->id_user }}"
                                class="font-medium text-blue-600 hover:underline">Edit</a>
                            |
                            <button class="font-medium text-blue-600 hover:underline deleteA"
                                data-user="{{ $user->id_user }}" data-acc="{{ $user->fullname }}"
                                data-modal-target="modal-deleteAcc" data-modal-show="modal-deleteAcc">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="ml-3">
            {{ $users->links('user.layouts.paginate') }}
        </div>
    </div>

    @push('script')
        <script>
            const targetVerify = document.querySelectorAll(".verifyA");
            const formVer = document.querySelector("#form");
            targetVerify.forEach((target) => {
                target.addEventListener("click", () => {
                    const namaAkun = document.querySelector("#target-accv");
                    let idTarget = target.getAttribute("data-user");
                    let nmTarget = target.getAttribute("data-acc");

                    formVer.action = `/verified/${idTarget}`;
                    namaAkun.textContent = nmTarget;
                });
            });

            const targetDelete = document.querySelectorAll(".deleteA");
            const formDel = document.querySelector("#dxz");
            targetDelete.forEach((target) => {
                target.addEventListener("click", () => {
                    const namaAkun = document.querySelector("#target-acc");
                    let idTarget = target.getAttribute("data-user");
                    let nmTarget = target.getAttribute("data-acc");

                    formDel.action = `/hapusUser/${idTarget}`;
                    namaAkun.textContent = nmTarget;
                });
            });
        </script>
    @endpush
@endsection
