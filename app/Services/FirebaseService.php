<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Storage;


class FirebaseService
{
    protected $database;
    protected $storage;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path(config('firebase.credentials')))
            ->withDatabaseUri(config('firebase.database_url'));

        $this->database = $factory->createDatabase();
        $this->storage = $factory->createStorage(); // ✅ Add this for Firebase Storage
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }

    public function getReference($path)
    {
        return $this->database->getReference($path);
    }

    public function setData($path, $data)
    {
        return $this->database->getReference($path)->set($data);
    }

    public function pushData($path, $data)
    {
        return $this->database->getReference($path)->push($data);
    }

    public function updateData($path, $data)
    {
        return $this->database->getReference($path)->update($data);
    }

    public function deleteData($path)
    {
        return $this->database->getReference($path)->remove();
    }

    public function getStorage() // ✅ Add this function
    {
        return $this->storage;
    }
}
