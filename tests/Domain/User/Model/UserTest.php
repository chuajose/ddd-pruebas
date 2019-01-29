<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 8/01/19
 * Time: 15:11
 */

namespace App\Tests\Domain\User\Model;

use App\Domain\User\Model\UserId;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Domain\User\Model\User;

class UserTest extends TestCase
{
	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function given_a_valid_email_it_should_create_a_user_instance(): void
	{
		$emailString = 'lol@aso.maximo';
		$id = new UserId();
		$name = 'Jose';
		$username = 'jose';
		$passwordPlain = 'secret';
		$update_at = new \DateTimeImmutable();
		$created_at = new \DateTimeImmutable();
		$password = HashedPassword::encode($passwordPlain);

		$user = new User($id, Email::fromString($emailString), $name, $username, $password, $update_at, $created_at);

		self::assertSame($emailString, $user->email());
		self::assertSame($username, $user->username());
		self::assertSame($id, $user->getId());
		self::assertSame($password, $user->getPassword());
	}


	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function given_a_invalid_email_it_should_not_create_a_user_instance(): void
	{
		$this->expectException( \InvalidArgumentException::class);

		$emailString = 'mail_invalido@';
		$id = new UserId();
		$name = 'Jose';
		$username = 'jose';
		$password = 'secret';
		$update_at = new \DateTimeImmutable();
		$created_at = new \DateTimeImmutable();

		$user = new User($id, Email::fromString($emailString), $name, $username, HashedPassword::encode($password), $update_at, $created_at);

	}

	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function change_an_email_it_should_return_new_email(): void
	{
		$emailString = 'lol@aso.maximo';
		$emailNewString = 'new@aso.maximo';
		$id = new UserId();
		$name = 'Jose';
		$username = 'jose';
		$password = 'secret';
		$update_at = new \DateTimeImmutable();
		$created_at = new \DateTimeImmutable();

		$user = new User($id, Email::fromString($emailString), $name, $username, HashedPassword::encode($password), $update_at, $created_at);

		$user->setEmail(Email::fromString($emailNewString));
		$newMailReturn =$user->email();

		self::assertSame($emailNewString, $newMailReturn);
	}

}
