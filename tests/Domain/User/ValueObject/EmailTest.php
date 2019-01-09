<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 8/01/19
 * Time: 15:22
 */

namespace App\Tests\Domain\User\ValueObject;

use App\Domain\User\Model\UserId;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Domain\User\Model\User;

class EmailTest extends TestCase{

	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function given_a_valid_email_it_should_create_a_valid_email(): void
	{
		$emailString = 'lol@aso.maximo';
		$email = Email::fromString($emailString);
		self::assertSame($emailString, $email->__toString());
	}

}
