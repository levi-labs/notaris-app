<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title      = 'Daftar User';
        if (auth()->user()->type_user == 'master') {
            $data       = DB::table('users')->get();

            return view('pages.users.index', compact('title', 'data'));
        }
        $data       = DB::table('users')->where('type_user', '!=', 'master')->get();
        return view('pages.users.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title      = 'Form Tambah User';
        $types       = ['master', 'admin', 'client'];


        return view('pages.users.create', compact('title', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'type' => 'required',
            'email' => 'required',
        ]);


        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'type' => $request->type,
            'email' => $request->email
        ]);
        return redirect()->route('user.index')->with('success', 'User created successfully.');
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

        $title      = 'Form Edit User';
        $types       = ['master', 'admin', 'client'];
        $user       = User::find($id);

        return view('pages.users.edit', compact('title', 'user', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'type' => 'required',
            'email' => 'required',
        ]);

        try {

            $data = User::find($id);

            $data->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'type_user' => $request->type,
                'email' => $request->email
            ]);
            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } catch (\Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

    public function resetPassword(string $id)
    {
        try {

            $data = User::find($id);
            $data->update([
                'password' => bcrypt($data->username)
            ]);
            return redirect()->route('user.index')->with('success', 'Password Reset successfully');
        } catch (\Throwable $th) {

            return back()->with('error', $th->getMessage());
        }
    }
}
