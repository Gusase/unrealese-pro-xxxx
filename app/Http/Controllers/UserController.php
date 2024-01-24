<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\File;
use App\Models\Pesan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Beranda';
        $pesan = Pesan::where('id_penerima', auth()->id())->with(['user','file'])->orderBy('created_at','desc')->get();
        $jumlahPesan = $pesan->count();
        $files = File::where('id_user', auth()->id());

        if (request('search')) {
            $files->where('judul_file', 'like', '%' . request('search') . '%')->orWhere('original_filename', 'like', '%' . request('search') . '%');
        }

        $files = $files->get();

        return view('user.index', compact('title', 'files', 'pesan', 'jumlahPesan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Edit Profil';
        $pesan = Pesan::where('id_penerima', auth()->id())->with(['user','file'])->orderBy('created_at','desc')->get();
        $jumlahPesan = $pesan->count();

        if ($user->id_user != auth()->id()) {
            abort(404);
        }

        return view('user.edit', compact('title', 'user', 'pesan', 'jumlahPesan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user->id_user != auth()->id()) {
            abort(404);
        }

        $validated = $request->validated();
        $validated = $request->safe()->only(['fullname', 'username', 'email', 'password', 'pp']);
        $newAvatar = $validated['pp'] ?? null;
        $path = 'users/' . auth()->id();

        if (Storage::disk('public')->exists(Auth::user()->pp) && !is_null($newAvatar)) {
            Storage::delete(Auth::user()->pp);
        }

        if (!is_null($newAvatar)) {
            $validPathPP = Storage::disk('public')->put($path, $newAvatar);
            $validated['pp'] = $validPathPP;
        }

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($request->input('password'));
        }

        $user->update($validated);

        session()->flash('berhasil', 'Berhasil mengedit data');
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
