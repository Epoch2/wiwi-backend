<?php namespace App\Adapters;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 11/12/15
 *
 * (c) 2015 wasitworth.it
 */

// Doctrine
use EntityManager;

// JWT
use Tymon\JWTAuth\Providers\User\UserInterface;

// Models
use App\Models\User;

class DoctrineUserProvider implements UserInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->userRepository = EntityManager::getRepository(User::class);
    }

    public function getBy($key, $value)
    {
        return $this->userRepository->findOneBy([
            $key => $value
        ]);
    }
}

