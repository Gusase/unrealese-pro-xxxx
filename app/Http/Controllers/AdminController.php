<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Admin Dashboard';
        $usersQuery = User::whereIn('status', [0, 1]);
        if (request('search')) {
            $searchTerm = '%' . request('search') . '%';
            $usersQuery->where(function ($query) use ($searchTerm) {
                $query->where('fullname', 'like', $searchTerm)
                    ->orWhere('username', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            });
        }
        $users = $usersQuery->paginate(10);
        $countUsers = User::whereIn('status', [0, 1])->count();
        $userVerified = User::where('status', 1)->count();
        $userUnverified = User::where('status', 0)->count();
        $countFiles = File::count();

        return view('user.admin.index', compact('title', 'users', 'countUsers', 'countFiles', 'userVerified', 'userUnverified'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Edit Profil';
        $user = User::where('id_user', $id)->first();

        return view('user.admin.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $id_user)
    {
        dd($request);
        $user = $id_user;
		if ($user->status != 2) {
			abort(404);
		}

		$validated = $request->validated();
		$validated = $request->safe()->only(['fullname', 'username', 'email', 'password', 'pp']);
		$newAvatar = $validated['pp'] ?? null;
		$path = 'users/' . Auth::id();

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
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_user)
    {
        if ($id_user == Auth::id()) {
            session()->flash('gagal', 'Admin tidak boleh dihapus');
            return redirect()->back();
        }

        Storage::deleteDirectory('users/' . $id_user);
        User::destroy($id_user);
        // Pesan::where('id_pengirim', $id_user)->delete();
        File::where('id_user', $id_user)->delete();

        session()->flash('berhasil', 'Berhasil menghapus user');
        return redirect()->back();
    }

    public function verified($id_user)
    {
        User::where('id_user', $id_user)->update(['status' => 1]);
        session()->flash('success', 'User berhasil diverifikasi');
        return redirect()->back();
    }
}
