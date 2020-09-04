<?php


namespace AppBundle\Service\User;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;

class UserService implements UserServiceInterface
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function save(User $user): bool
    {
        return $this->userRepository->insert($user);
    }
}