<?php

namespace Suhm\Entity;

use Illuminate\Auth\UserInterface;
use Suhm\Support\Mutable;

class User implements UserInterface
{
    use Mutable;

    protected $id;
    protected $email;
    protected $password;

    public function __construct($input = null)
    {
        if ( ! is_null($input)) {
            foreach ($input as $field => $value) {
                $this->$field = $value;
            }
        }
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        // ...
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // ...
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        // ...
    }
}
