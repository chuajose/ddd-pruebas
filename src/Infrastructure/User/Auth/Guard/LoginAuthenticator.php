<?php

declare(strict_types=1);

namespace App\Infrastructure\User\Auth\Guard;

use App\Domain\User\Exception\InvalidCredentialsException;
use App\Domain\User\ValueObject\Email;
use App\Infrastructure\User\Auth\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use App\Domain\User\Repository\UserRepositoryInterface;

final class LoginAuthenticator extends AbstractGuardAuthenticator
{
    private const LOGIN = 'login';

    private const SUCCESS_REDIRECT = 'profile';

    /**
     * Does the authenticator support the given Request?
     *
     * If this returns false, the authenticator will be skipped.
     */
    public function supports(Request $request): bool
    {
        return $request->getPathInfo() === $this->router->generate(self::LOGIN) && $request->isMethod('POST');
    }

    /**
     * Get the authentication credentials from the request and return them
     * as any type (e.g. an associate array).
     *
     * Whatever value you return here will be passed to getUser() and checkCredentials()
     *
     * For example, for a form login, you might:
     *
     *      return array(
     *          'username' => $request->request->get('_username'),
     *          'password' => $request->request->get('_password'),
     *      );
     *
     * Or for an API token that's on a header, you might use:
     *
     *      return array('api_key' => $request->headers->get('X-API-TOKEN'));
     *
     *
     * @throws \UnexpectedValueException If null is returned
     *
     * @return mixed Any non-null value
     */
    public function getCredentials(Request $request)
    {
        return [
            'email'    => $request->request->get('_email'),
            'password' => $request->request->get('_password'),
        ];
    }

    /**
     * Return a UserInterface object based on the credentials.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * You may throw an AuthenticationException if you wish. If you return
     * null, then a UsernameNotFoundException is thrown for you.
     *
     *
     * @throws AuthenticationException
     * @throws \Assert\AssertionFailedException
     */
    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        try {
            $email = $credentials['email'];
			$userGet =  $this->userRepository->findByEmail(Email::fromString($email));
			return Auth::fromUser($userGet);
        } catch (InvalidCredentialsException $exception) {
            throw new AuthenticationException();
        }
    }

    /**
     * Returns true if the credentials are valid.
     *
     * If any value other than true is returned, authentication will
     * fail. You may also throw an AuthenticationException if you wish
     * to cause authentication to fail.
     *
     * The *credentials* are the return value from getCredentials()
     *
     *
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $user): bool
    {
    	return $user->signIn($credentials['password']);
    }

    /**
     * Called when authentication executed and was successful!
     *
     * This should return the Response sent back to the user, like a
     * RedirectResponse to the last page they visited.
     *
     * If you return null, the current request will continue, and the user
     * will be authenticated. This makes sense, for example, with an API.
     *
     * @param string $providerKey The provider (i.e. firewall) key
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): ?Response
    {

    	//die('parece que bien');
        return new RedirectResponse($this->router->generate(self::SUCCESS_REDIRECT));
    }

	public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
	{
		$data = array(
			'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

			// or to translate this message
			// $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
		);

		return new JsonResponse($data, Response::HTTP_FORBIDDEN);
	}

    protected function getLoginUrl(): string
    {
        return $this->router->generate(self::LOGIN);
    }

	/**
	 * Called when authentication is needed, but it's not sent
	 */
	public function start(Request $request, AuthenticationException $authException = null)
	{
		$data = array(
			// you might translate this message
			'message' => 'Authentication Required'
		);

		return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
	}
	public function supportsRememberMe()
	{
		return false;
	}

    public function __construct( UrlGeneratorInterface $router, UserRepositoryInterface $userRepository)
    {
        $this->router = $router;
        $this->userRepository = $userRepository;
    }

    /**
     * @var UrlGeneratorInterface
     */
    private $router;
    private  $userRepository;
}
