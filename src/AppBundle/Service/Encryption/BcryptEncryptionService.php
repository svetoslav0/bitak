<?php


namespace AppBundle\Service\Encryption;


class BcryptEncryptionService implements EncryptionServiceInterface
{

    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}