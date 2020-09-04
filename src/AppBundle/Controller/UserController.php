<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Service\User\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 *
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/register",
     *     name="user_register",
     *     methods={"GET"})
     *
     * @return Response
     */
    public function register() {
        return $this->render('user/register.html.twig');
    }

    /**
     * @Route("/register",
     *     name="user_register_process",
     *     methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function registerProcess(Request $request) {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $this->userService->save($user);

        return $this->redirectToRoute('login_user');
    }

    /**
     * @Route("/login",
     *     name="login_user",
     *     methods={"GET"})
     */
    public function login() {

    }
}
