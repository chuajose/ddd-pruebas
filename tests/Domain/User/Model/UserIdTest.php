<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 8/01/19
 * Time: 15:11
 */

namespace App\Tests\Domain\User\Model;

use App\Domain\User\Model\UserId;
use App\Domain\User\ValueObject\Email;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class UserIdTest extends TestCase
{
	/**
	 * @test
	 *
	 * @group unit
	 *
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	public function check_if_userid_pased_is_equal_to_generate(): void
	{
		$newId = new UserId();
		$id = new UserId($newId->id());

		self::assertSame($newId->id(), $id->id());
		self::assertTrue($id->equals($newId));
	}

}
