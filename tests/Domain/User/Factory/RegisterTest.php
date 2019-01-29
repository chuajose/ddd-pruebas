<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 29/01/19
 * Time: 11:55
 */

namespace App\Tests\Domain\User\Factory;


use App\Domain\User\Exception\EmailAlreadyExistException;
use App\Domain\User\Model\User;
use App\Domain\User\Factory\RegisterUser;
use App\Domain\User\Model\UserId;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


class RegisterTest extends TestCase {

	private  $registerUser;
	private $userRepository;

	protected function setUp()
	{
		$this->userRepository = self::createMock(UserRepositoryInterface::class);
		$this->registerUser =  new RegisterUser($this->userRepository);

	}
	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function register_new_user_with_valid_data() {

		$emailString = 'lol@aso.maximo';
		$id = new UserId();
		$name = 'Jose';
		$username = 'jose';
		$password = 'secret';
		$update_at = new \DateTimeImmutable();
		$created_at = new \DateTimeImmutable();

		$user = new User($id, Email::fromString($emailString), $name, $username, HashedPassword::encode($password), $update_at, $created_at);

		$this->registerUser->execute($user);
		self::assertTrue(true);

	}

	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function user_factory_must_throw_exception_is_email_already_taken()
	{
		$this->userRepository->method('existsEmail')
		     ->willReturn(Uuid::uuid4());

		$this->expectException(EmailAlreadyExistException::class);

		$emailString = 'lol@aso.maximo';
		$id = new UserId();
		$name = 'Jose';
		$username = 'jose';
		$password = 'secret';
		$update_at = new \DateTimeImmutable();
		$created_at = new \DateTimeImmutable();

		$user = new User($id, Email::fromString($emailString), $name, $username, HashedPassword::encode($password), $update_at, $created_at);

		$this->registerUser->execute($user);
	}


	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function user_factory_must_throw_exception_is_password_or_email_is_invalid()
	{


		$this->expectException(\InvalidArgumentException::class);

		$emailString = ' ';
		$id = new UserId();
		$name = 'Jose';
		$username = 'jose';
		$password = 'sadfasdfasdfasdf';
		$update_at = new \DateTimeImmutable();
		$created_at = new \DateTimeImmutable();

		$user = new User($id, Email::fromString($emailString), $name, $username, HashedPassword::encode($password), $update_at, $created_at);

		$this->registerUser->execute($user);
	}




}
