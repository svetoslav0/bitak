<?php


namespace AppBundle\Service\Encryption;


interface EncryptionServiceInterface
{
    public function encrypt(string $password): string;
}