<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
