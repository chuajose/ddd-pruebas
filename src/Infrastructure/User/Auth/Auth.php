<?php

declare(strict_types=1);

namespace App\Infrastructure\User\Auth;

use App\Domain\User\Exception\InvalidCredentialsException;
use App\Domain\User\Model\User;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Auth implements UserInterface, EncoderAwareInterface
{
    public static function fromUser(User $user): self
    {
    	return new self($user);
    }


	public function signIn(string $plainPassword): bool
	{
		$hashedPassword = HashedPassword::fromHash($this->getPassword());
		$match = $hashedPassword->match($plainPassword);
		if (!$match) {
			throw new InvalidCredentialsException('Invalid credentials entered.');
		}
		return true;
		//$this->apply(UserSignedIn::create($this->uuid, $this->email));
	}


    public function getUsername(): string
    {
	    return $this->user->email();
    }

    public function getPassword(): string
    {

        return $this->user->hashedPassword();
    }

    public function getRoles(): array
    {
        return [
            'ROLE_USER',
        ];
    }

    public function getSalt(): void
    {
    }

    public function eraseCredentials(): void
    {
        // noop
    }

    public function getEncoderName(): string
    {
        return 'bcrypt';
    }

    public function uuid(): UuidInterface
    {
        return $this->user->uuid();
    }

	public function getUuid(): string
	{
		return $this->user->uuid->toString();
	}

    public function __toString(): string
    {

	    return $this->user->email();
    }

    public function __construct(User $user)
    {

        $this->user = $user;

    }

    /** @var User */
    private $user;
}
