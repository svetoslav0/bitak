<?php


namespace AppBundle\Service\User;


use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use AppBundle\Repository\RoleRepository;
use AppBundle\Repository\UserRepository;
use AppBundle\Service\Encryption\EncryptionServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(
            UserRepository $userRepository,
            RoleRepository $roleRepository,
            EncryptionServiceInterface $encryptionService
        )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->encryptionService = $encryptionService;
    }

    public function save(User $user): bool
    {
        return $this->userRepository->insert(
            $this->init($user)
        );
    }

    private function init(User $user): User
    {
        $passwordHash = $this->encryptionService->encrypt($user->getPassword());
        $user->setPassword($passwordHash);

        $userRole = $this->roleRepository->findOneBy(['name' => Role::ROLE_USER]);
        $user->addRole($userRole);

        return $user;
    }
}