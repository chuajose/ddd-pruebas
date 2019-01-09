<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 8/01/19
 * Time: 15:25
 */

namespace App\Domain\User\Model;

use Ramsey\Uuid\Uuid;

class UserId {

	/**
	 * @var string
	 */
	private $id;

	/**
	 * @param string $id
	 */
	public function __construct($id = null)
	{
		$this->id = $id ?? Uuid::uuid4()->toString();
	}

	/**
	 * @param UserId $userId
	 *
	 * @return bool
	 */
	public function equals( UserId $userId)
	{
		return $this->id() === $userId->id();
	}

	/**
	 * @return string
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->id();
	}
}
