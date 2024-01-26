<?php

namespace App\Utils\Mialer\Interface;

use Symfony\Component\Mime\Email;

interface AppMailerInterface
{

    public function send(): void;
    public function setRecepient(string $mail): void;
    public function createMessage(?array $data): ?Email;

}