<?php declare( strict_types=1 );

/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 8/01/19
 * Time: 19:20
 */

namespace App\Infrastructure\User\Repository;

use App\Domain\User\Model\User;
use App\Domain\User\Model\UserId;
use App\Domain\User\ValueObject\Email;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Repository\CheckUserByEmailInterface;
use Ramsey\Uuid\UuidInterface;

class DoctrineUserRepository  implements UserRepositoryInterface{

	public function existsEmail(Email $email): ?UuidInterface
	{
		$userId = $this->findByEmail($email);
		return ($userId) ? $userId->getId() : null;
	}

	public function save( User $user ): void {
		$this->em->persist( $user );
		$this->em->flush();
	}

	public function getById( UserId $id ): User {
		$user = $this->em->find( User::class, $id );
		return $user;
	}

	public function findByEmail( Email $email ): ?User {
		/** @var User $user */
		$user = $this->em->getRepository( User::class )->findOneBy( [ 'email' => $email->toString() ] );

		return $user;
	}

	public function findAll(): array {

		return [];
		// TODO: Implement findAll() method.
	}

	public function __construct( EntityManagerInterface $em ) {

		$this->em = $em;
	}

	private $em;

}
