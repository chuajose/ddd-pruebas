<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 9/01/19
 * Time: 12:42
 */

declare(strict_types=1);

namespace App\UI\Http\Web\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
	/**
	 * @Route(
	 *     "/profile",
	 *     name="profile",
	 *     methods={"GET"}
	 * )
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function profile(): Response
	{
		return $this->render('profile/index.html.twig');
	}
}
