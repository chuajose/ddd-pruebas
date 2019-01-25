<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject\Auth;

use App\Domain\User\ValueObject\Email;

class Credentials
{
    /**
     * @var Email
     */
    public $email;

    /**
     * @var HashedPassword
     */
    public $password;

	/**
	 * Credentials constructor.
	 *
	 * @param Email $email
	 * @param HashedPassword $password
	 */
	public function __construct(Email $email, HashedPassword $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
