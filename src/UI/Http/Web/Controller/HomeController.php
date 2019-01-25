<?php
/**
 * Created by ddd-pruebas.
 * User: Jose Manuel Suárez Bravo
 * Date: 25/01/19
 * Time: 10:25
 */

namespace App\UI\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController  extends AbstractController {

	/**
	 * @Route(
	 *     "/",
	 *     name="index",
	 *     methods={"GET"}
	 * )
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function index(Request $request): Response
	{

		return $this->render('home/index.html.twig', [
			'message' => 'Bienvenido DDD'
		]);
	}
}
