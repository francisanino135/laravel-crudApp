<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Auth as FirebaseAuth;

class FirebaseSessionMiddleware
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('firebase_user')) {
            try {
                // Fetch user from Firebase and store it in session
                if (Auth::check() && Auth::user()->firebase_uid) {
                    try {
                        $firebaseUser = $this->firebaseAuth->getUser(Auth::user()->firebase_uid);
                        session([
                            'firebase_user' => [
                                'name' => $firebaseUser->displayName ?? 'No Name',
                                'email' => $firebaseUser->email ?? 'No Email',
                                'photoUrl' => $firebaseUser->photoUrl ?? asset('storage/images/avatar.png'),
                                'uid' => $firebaseUser->uid,
                            ]
                        ]);
                    } catch (\Exception $e) {
                        // Log the error
                        \Log::error('Firebase user fetch failed: ' . $e->getMessage());
                    }
                }else {
                    \Log::error('User not logged in');
                    return redirect()->route('login')->withErrors(['error' => 'You must be logged in.']);
                    
                }
                
            } catch (\Exception $e) {
                // Handle error
            }
        }

        return $next($request);
    }
}

