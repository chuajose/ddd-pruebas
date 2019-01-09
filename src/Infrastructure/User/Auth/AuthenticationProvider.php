<?php

declare(strict_types=1);

namespace App\Infrastructure\User\Auth;

use App\Domain\User\Auth\AuthenticationProviderInterface;
use App\Domain\User\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthenticationProvider implements AuthenticationProviderInterface
{
    public function generateToken(User $user): string
    {
        $auth = Auth::fromUser($user);
        return $this->JWTManager->create($auth);
    }

    public function __construct(JWTTokenManagerInterface $JWTManager)
    {
	    $this->JWTManager = $JWTManager;
    }

    /**
     * @var JWTTokenManagerInterface
     */
    private $JWTManager;
}
