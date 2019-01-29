<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 8/01/19
 * Time: 15:11
 */

namespace App\Domain\User\Model;


use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use Assert\Assertion;

class User {

	/**
	 * @var UserId
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var object
	 */
	private $email;

	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var string
	 */
	private $updated_at;

	/**
	 * @var string
	 */
	private $created_at;


	public function __construct(UserId $id, Email $email, string $name, string $username, HashedPassword $password, \DateTimeImmutable $update_at, \DateTimeImmutable $created_at) {
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->username = $username;
		$this->password = $password;
		$this->updated_at = $update_at;
		$this->created_at = $created_at;
		//$this->setPassword($password);
	}

	public function getId()
	{
		return $this->id;
	}

	public  function setEmail(Email $email){
		$this->email = $email;
	}

	public function email(){
		if(is_string($this->email)) $this->email = Email::fromString($this->email);
		return $this->email->toString();
	}

	public function username(){
		return $this->username;
	}

	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param mixed $password
	 * @return self
	 */
	/*public function setPassword($password)
	{
		$this->password = HashedPassword::encode($password);
		return $this;
	}*/

	/**
	 * @return string
	 */
	public function hashedPassword(){
		return $this->password;
	}
}
