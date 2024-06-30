<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /**
     * Display the login page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.login');
    }

    /**
     * Authenticates a user's credentials and redirects them to the dashboard if successful.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the user's credentials.
     * @return \Illuminate\Http\RedirectResponse Redirects the user back to the previous page with an error message if the credentials are incorrect. Otherwise, redirects the user to the dashboard.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (!auth()->validate($credentials)) {
            return Redirect::back()->with('error', 'Invalid credentials.');
        }

        auth()->loginUsingId(User::where('username', $credentials['username'])->value('id'));

        return redirect()->route('dashboard');
    }

    /**
     * Display the registration page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View The registration page view.
     */
    public function showRegister()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'nama' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email',
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'type_user' => 'client',
        ];

        User::create($data);
        auth()->loginUsingId(User::latest()->first()->id);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
