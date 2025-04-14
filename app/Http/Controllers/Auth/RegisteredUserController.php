<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\FirebaseAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuthService $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation // Validate the image file (optional)
        ]);


        // Get uploaded file (if any)
        $profilePicture = $request->file('profile_picture');

        try {
            $firebaseUser = $this->firebaseAuth->registerUser(
                $request->email,
                $request->password,
                $request->name,
                $profilePicture
            );
        
            // Create a local Laravel user immediately after Firebase registration
            $user = User::create([
                'firebase_uid' => $firebaseUser->uid,
                'name' => $firebaseUser->displayName ?? 'No Name',
                'email' => $firebaseUser->email ?? 'No Email',
                'profile_picture' => $firebaseUser->photoUrl ?? null,
                'password' => bcrypt(str()->random(32)), // Generate a random password for Laravel
            ]);
        
            return redirect()->route('login')->with('status', 'Registered successfully!');
        } catch (\Exception $e) {
            Log::error("Registration failed: " . $e->getMessage());
            return back()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
        
        // }
        // // Handle file upload
        // if ($request->hasFile('profile_picture')) {
        //     // Store the file and retrieve the file name
        //     $fileName = $request->file('profile_picture')->store('profile_pictures', 'public');
        // }

        //     $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'profile_picture' => $fileName ?? null, // Store the file name or path, not the array
        // ]);

        //     event(new Registered($user));

        //     return redirect()->route('login');
    }
}
