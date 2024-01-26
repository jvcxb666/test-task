<?php

namespace App\Utils\Logic;

use App\Repository\Interface\RepositoryInterface;
use App\Utils\Mialer\Interface\AppMailerInterface;

class SecretSantaLogic
{

    private AppMailerInterface $mailer;

    public function __construct(AppMailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function execute(RepositoryInterface $repo): void
    {
        $this->sendMails($this->prepareData($repo));
    }

    private function prepareData(RepositoryInterface $repo): ?RepositoryInterface
    {
        $recievers = [];

        foreach($repo->findAll() as $person){
            $reciever = $this->findPerson($person->getId(),$recievers,$repo->findAll());
            $person->setReceiverId($reciever);

            $recieverObject = $repo->find($reciever);
            $recieverObject->setSantaId($person->getId());
            $repo->save($recieverObject);

            $recievers[] = $reciever;
        }

        return $repo;
    }

    private function findPerson(string $personId,array $taken,array $data): string
    {
        $key = random_int(0,count($data)-1);
        $id = $data[$key]->getId();

        if($id == $personId || in_array($id,$taken)) return $this->findPerson($personId, $taken, $data);

        return $id;
    }

    private function sendMails(RepositoryInterface $repo): void
    {
        foreach($repo->findAll() as $person){

            $reciever = $repo->find($person->getReceiverId());
            $this->mailer->createMessage(
                [
                    'full_name' => $reciever->getFullName(),
                    'email' => $reciever->getEmail()
                ]
            );

            $this->mailer->setRecepient($person->getEmail());
            $this->mailer->send();
        }
    }
}