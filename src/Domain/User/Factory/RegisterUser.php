<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 29/01/19
 * Time: 12:04
 */

namespace App\Domain\User\Factory;


use App\Domain\User\Exception\EmailAlreadyExistException;
use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;

final class RegisterUser {

	function execute(User $user) :?User
	{

		if($this->userRepository->existsEmail(Email::fromString($user->email()))){
			throw new EmailAlreadyExistException('Email already registered.');
		}
		return $this->userRepository->save($user);
	}

	function __construct(UserRepositoryInterface $userRepository) {

		$this->userRepository = $userRepository;
	}

	private $userRepository;
}
