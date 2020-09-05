<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Service\Encryption\EncryptionServiceInterface;
use AppBundle\Service\User\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
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

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(
        UserServiceInterface $userService,
        EncryptionServiceInterface $encryptionService
    )
    {
        $this->userService = $userService;
        $this->encryptionService = $encryptionService;
    }

    /**
     * @Route("/register",
     *     name="user_register",
     *     methods={"GET"})
     *
     * @return Response
     */
    public function register() {
        $form = $this->createForm(UserType::class);

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
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

        return $this->redirectToRoute('security_login');
    }

    /**
     * @Route("/account", name="account")
     */
    public function account() {
        var_dump('login successful');
        exit;
    }

    /**
     * @Route("/fail", name="fail")
     */
    public function fail() {
        var_dump('fail');
        exit;
    }
}
