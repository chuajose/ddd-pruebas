<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 9/01/19
 * Time: 10:15
 */

namespace App\Infrastructure\User\Repository;


use App\Domain\User\Model\User;
use App\Domain\User\Model\UserId;
use App\Domain\User\Repository\UserRepositoryInterface;

class InMemoryUserRepository {


	public function save( User $user ): void {
		$this->users[$user->getId()->id()] = $user;
	}

	public function getById( UserId $id ): User {
		// TODO: Implement getById() method.
	}

	public function findAll(): array {

		return $this->users;
	}

	public function __construct() {

		$this->users = [];
	}
	private  $users;
}
