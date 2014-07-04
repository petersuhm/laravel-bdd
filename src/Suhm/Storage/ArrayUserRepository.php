<?php

namespace Suhm\Storage;

use Suhm\Entity\User;
use Illuminate\Auth\UserProviderInterface;
use Illuminate\Auth\UserInterface;

use Illuminate\Hashing\HasherInterface as Hasher;

class ArrayUserRepository implements UserRepository, UserProviderInterface
{
    protected $hasher;
    protected $users = [];

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function newInstance($input = null)
    {
        return new User($input);
    }

    public function persist(User $user)
    {
        $this->users[] = $user;
    }

    public function allUsers()
    {
        return $this->users;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveById($identifier)
    {
        foreach ($this->users as $user) {
            if ($user->id == $identifier) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByToken($identifier, $token)
    {
        // ...
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Auth\UserInterface  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(UserInterface $user, $token)
    {
        // ...
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        foreach ($this->users as $user) {
            if ($user->email == $credentials['email']) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\UserInterface  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials)
    {
        if (($user->email == $credentials['email']) and $this->hasher->check($credentials['password'], $user->getAuthPassword())) {
            return true;
        }

        return false;
    }
}
