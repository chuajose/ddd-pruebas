<?php

declare(strict_types=1);

namespace App\Infrastructure\User\Auth;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\User;
use App\Domain\User\ValueObject\Email;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class AuthProvider implements UserProviderInterface
{
    /**
     * @throws \Assert\AssertionFailedException
     */
    public function loadUserByUsername($email)
    {
	    return $this->fetchUser($email);
    }

	private function fetchUser($email)
	{
		if (null === ($user = $this->userRepository->findByEmail($email))) {
			throw new UsernameNotFoundException(
				sprintf('Username "%s" does not exist.', $email)
			);
		}

		return new Auth($user);
	}
    /**
     * @throws \Assert\AssertionFailedException
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
    	return $this->fetchUser(Email::fromString($user->getUsername()));
    }

    public function supportsClass($class): bool
    {
	    return Auth::class === $class;
    }

    public function __construct(UserRepositoryInterface $userRepository)
    {
	    $this->userRepository = $userRepository;
    }

    /**
     * @var UserReadModelRepositoryInterface
     */
    private $userRepository;
}
