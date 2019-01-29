<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 29/01/19
 * Time: 10:58
 */

namespace App\UI\Http\Web\Controller;

use App\Domain\User\Exception\EmailAlreadyExistException;
use App\Domain\User\Factory\RegisterUser;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\Model\User;
use App\Domain\User\Model\UserId;
use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SignUpController extends AbstractRenderController{

	/**
	 * @Route(
	 *     "/sign-up",
	 *     name="sign-up",
	 *     methods={"GET"}
	 * )
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function get(): Response
	{
		return $this->render('signup/index.html.twig');
	}

	/**
	 * @Route(
	 *     "/sign-up",
	 *     name="sign-up-post",
	 *     methods={"POST"}
	 * )
	 *
	 * @throws \Assert\AssertionFailedException
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 * @throws \Exception
	 */
	public function post(Request $request , UserRepositoryInterface  $userRepository): Response
	{
		$email = $request->request->get('email');
		$password = $request->request->get('password');


		try{
			$uuid = new UserId();
			$user = new User($uuid, Email::fromString($email), "Jose", 'chua', HashedPassword::encode($password), new \DateTimeImmutable(), new \DateTimeImmutable());
			$factory = new RegisterUser($userRepository);
			$factory->execute($user);
			return $this->render('signup/user_created.html.twig', ['uuid' => $uuid, 'email' => $email]);

		} catch (EmailAlreadyExistException $exception) {

			return $this->render('signup/index.html.twig', ['error' => 'Email already exists.'], Response::HTTP_CONFLICT);

		} catch (\InvalidArgumentException $exception) {

			return $this->render('signup/index.html.twig', ['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);

		}

	}
}
