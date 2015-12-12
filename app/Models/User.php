<?php namespace App\Models;

/**
 * Created by Johan Vester
 * johan.vester@gmail.com
 *
 * Date: 12/12/15
 *
 * (c) 2015 wasitworth.it
 */

// Contracts
use LaravelDoctrine\ORM\Contracts\Auth\Authenticatable;

// Traits
use App\Models\Traits\MagicAccessors;

class User implements Authenticatable
{
    use MagicAccessors;

    protected $id;
    protected $email;
    protected $password;
    protected $firstName;
    protected $lastName;

    /**
     * Get the column name for the primary key
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        $name = $this->getAuthIdentifierName();

        return $this->{$name};
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get the password for the user.
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->getPassword();
    }

    /**
     * Get the token value for the "remember me" session.
     * @return string
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'rememberToken';
    }
}