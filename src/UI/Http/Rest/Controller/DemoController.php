<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 8/01/19
 * Time: 19:26
 */

namespace App\UI\Http\Rest\Controller;

use App\Domain\User\Model\User;
use App\Domain\User\Model\UserId;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\User\ValueObject\Email;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DemoController extends AbstractController{
	/**
	 * @Route(
	 *     "/",
	 *     name="home",
	 *     methods={"GET"}
	 * )
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function index()
	{
		//$users = [];
		try{
			$email = Email::fromString('chua.jose@gmail.com');
			$user = new User(new UserId(), $email, "Jose", 'chua', HashedPassword::encode('milladoiro'), new \DateTimeImmutable(), new \DateTimeImmutable());
			$this->createUser->save($user);
			$users = $this->createUser->findAll();
		}catch (\Exception $exception){

			$message =  ($exception->getMessage());
			dd($message);
			//$users = [];
		}

		$response = new JsonResponse(array('data' => $users));

		return $response;
	}


	public function __construct( UserRepositoryInterface  $createUserUseCase ) {

		$this->createUser = $createUserUseCase;
	}

	private  $createUser;
}
