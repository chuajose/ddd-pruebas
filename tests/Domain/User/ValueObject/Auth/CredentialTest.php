<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 25/01/19
 * Time: 10:30
 */

namespace App\Tests\Domain\User\ValueObject\Auth;

use App\Domain\User\ValueObject\Auth\HashedPassword;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Domain\User\ValueObject\Auth\Credentials;
use App\Domain\User\ValueObject\Email;

class CredentialTest extends TestCase {

	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function given_a_valid_email_it_should_create_a_valid_credentials(): void
	{
		$emailString = 'lol@aso.maximo';
		$email = Email::fromString($emailString);
		$credentials = new Credentials($email, HashedPassword::encode('milladoiro'));
		self::assertSame($emailString, $credentials->email->toString());
	}
}
