<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 8/01/19
 * Time: 19:08
 */

namespace App\Domain\User\Repository;


use App\Domain\User\Model\User;
use App\Domain\User\Model\UserId;
use App\Domain\User\ValueObject\Email;

interface UserRepositoryInterface {

	function save(User $user) :void;
	function getById(UserId $id) :User;
	function findByEmail(Email $email):?User;
	function findAll(): array ;

}
