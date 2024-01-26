<?php

namespace App\Utils\Mailer;

use App\Utils\Mialer\Interface\AppMailerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Mailer implements AppMailerInterface
{

    private MailerInterface $mailer;
    private Email $email;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(): void
    {
        $this->mailer->send($this->email);
    }

    public function setRecepient(string $mail): void
    {
        $this->email->to($mail);
    }

    public function createMessage(?array $data): ?Email
    {
        $this->email = new Email();

        $this->email->from("example@mail.ru");
        $this->email->subject("Тайный санта");
        $this->email->text($this->getTemplate($data));

        return $this->email;
    }

    private function getTemplate(array $data): string
    {
        $string =  'Вы участвуете в тайном санте, вам нужно отправить подарок $userFullName, $userEmail';

        $string = str_replace('$userFullName',$data['full_name'],$string);
        $string = str_replace('$userEmail',$data['email'],$string);

        return $string;
    }
}