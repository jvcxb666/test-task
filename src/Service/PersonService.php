<?php

namespace App\Service;

use App\Entity\Interface\EntityInterface;
use App\Entity\Person;
use App\Repository\Interface\RepositoryInterface;
use App\Repository\PersonRepository;
use App\Service\Interface\ServiceInterface;

class PersonService implements ServiceInterface
{

    private RepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = new PersonRepository();
    }

    public function get(string $id): ?EntityInterface
    {
        return $this->repository->find($id);
    }

    public function getAll(): ?array
    {
        return $this->repository->findAll();
    }

    public function save(array $data): ?EntityInterface
    {
        if(!$this->validate($data)) return null;

        $object = new Person($data['first_name'],$data['last_name'],$data['middle_name'] ?? null,$data['email']);
        $this->repository->save($object);

        return $object;
    }

    public function delete(string $id): void
    {
        if(!empty($id)) $this->repository->remove($id);
    }

    public function saveAll(array $persons): void
    {
        foreach($persons as $person){
            $this->save($person);
        }
    }

    private function validate($data): bool
    {
        if(!is_array($data) || empty($data)) return false;
        if(empty($data['first_name']) || empty($data['last_name']) || empty($data['email'])) return false;
        if(!$this->validateEmail($data['email'])) return false;

        return true;
    }

    private function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}