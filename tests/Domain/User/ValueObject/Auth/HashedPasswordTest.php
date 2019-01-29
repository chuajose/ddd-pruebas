<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 25/01/19
 * Time: 10:42
 */

namespace App\Tests\Domain\User\ValueObject\Auth;

use App\Domain\User\ValueObject\Auth\HashedPassword;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class HashedPasswordTest extends TestCase {

	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function check_if_math_to_equals_passwords(): void
	{
		$password = "Milladoiro";
		$passwordEncode = HashedPassword::encode($password);
		$passwordHash = HashedPassword::fromHash($passwordEncode);
		$match = $passwordHash->match($password);
		self::assertTrue($match);

	}



	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function given_error_when_password_lenght_is_down_6(): void
	{
		$this->expectException( \InvalidArgumentException::class);

		$password = "milla";
		$passwordEncode = HashedPassword::encode($password);


	}

}
