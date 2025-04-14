<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\FirebaseAuthService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuthService $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $signInResult = $this->firebaseAuth->loginUser($request->email, $request->password);

        if ($signInResult) {
            // Fetch user from Firebase
            $firebaseUser = $this->firebaseAuth->getUser($signInResult->firebaseUserId());

            // Find the existing Laravel user by Firebase UID or email
            $user = User::where('firebase_uid', $firebaseUser->uid)
                ->orWhere('email', $firebaseUser->email)
                ->first();

            if (!$user) {
                return back()->withErrors(['email' => 'User not found. Please register first.']);
            }

            // Log the user into Laravel
            Auth::guard('web')->login($user);

            // ✅ Debugging check after login
            // dd(auth()->user());

            return redirect()->route('posts.index')->with('status', 'Logged in successfully!');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
        // $request->authenticate();

        // $request->session()->regenerate();

        // // Flash a success message to the session
        // session()->flash('status', 'Login successful!');

        // return redirect()->route('posts.index');

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
