<?php

namespace App\Services;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Storage;

class FirebaseAuthService
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path(config('firebase.credentials')));

        $this->auth = $factory->createAuth();
    }

    // public function registerUser($email, $password)
    // {
    //     return $this->auth->createUserWithEmailAndPassword($email, $password);
    // }

    public function registerUser($email, $password, $name, $profilePicture = null)
    {
        // Create the Firebase user
        $user = $this->auth->createUser([
            'email' => $email,
            'password' => $password,
            'displayName' => $name, // Store user’s name in Firebase
        ]);

        // Upload profile picture if provided
        if ($profilePicture) {
            $profilePicturePath = $profilePicture->store('profile_pictures', 'public'); // Store in Laravel storage
            $profilePictureUrl = url(Storage::url($profilePicturePath));

            // Update Firebase user profile with profile picture and name
            $this->auth->updateUser($user->uid, [
                'photoUrl' => $profilePictureUrl,
                'displayName' => $name, // Update Firebase user name
            ]);
        }

        return $this->auth->getUser($user->uid); // Return updated user data
    }

    public function loginUser($email, $password)
    {
        try {
            return $this->auth->signInWithEmailAndPassword($email, $password);
        } catch (\Exception $e) {
            return false;
        }
    }


    public function getUser($uid)
    {
        return $this->auth->getUser($uid);
    }
}
