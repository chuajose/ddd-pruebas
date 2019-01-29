<?php
declare(strict_types=1);

/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 9/01/19
 * Time: 11:33
 */



namespace App\UI\Http\Web\Controller;

use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Auth\Credentials;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Domain\User\Model\User;
use App\Domain\User\Model\UserId;
use App\Domain\User\Repository\UserRepositoryInterface;

class SignInController extends AbstractController{
	/**
	 * @Route(
	 *     "/sign-in",
	 *     name="login",
	 *     methods={"GET"}
	 * )
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function login(AuthenticationUtils $authenticationUtils): Response
	{

		/*try{
			$email = Email::fromString('chua.jose@gmail.com');
			$user = new User(new UserId(), $email, "Jose", 'chua', 'password', new \DateTimeImmutable(), new \DateTimeImmutable());
			$this->createUser->save($user);
			$users = $this->createUser->findAll();
		}catch (\Exception $exception){

			$message =  ($exception->getMessage());chua
			dd($message);
			//$users = [];
		}*/


		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		return $this->render('signin/login.html.twig', [
			'last_username' => $lastUsername,
			'error' => $error
		]);
	}

	/**
	 * @Route(
	 *     "/login",
	 *     name="loginIn",
	 *     methods={"POST"}
	 * )
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function loginIn(AuthenticationUtils $authenticationUtils, Security $security): Response
	{
dd($security->getUser());		die(78);
	}
	/**
	 * @Route(
	 *     "/logout",
	 *     name="logout"
	 * )
	 */
	public function logout(): void
	{
		throw new AuthenticationException('I shouldn\'t be here..');
	}


	public function __construct( UserRepositoryInterface  $createUserUseCase ) {

		$this->createUser = $createUserUseCase;
	}

	private  $createUser;

}
