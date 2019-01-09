<?php

declare(strict_types=1);

namespace App\Domain\User\Auth;

use App\Domain\User\User;

interface AuthenticationProviderInterface
{
    public function generateToken(User $user): string;
}
