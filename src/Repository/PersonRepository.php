<?php

namespace App\Repository;

use App\Entity\Interface\EntityInterface;
use App\Repository\Interface\RepositoryInterface;

class PersonRepository implements RepositoryInterface
{

    private array $models;

    public function __construct()
    {
        $this->models = [];
    }

    public function findAll(): ?array
    {
        return $this->models;
    }

    public function find(string $id): ?EntityInterface
    {
        foreach($this->models as $model)
        {
            if($model->getId() == $id){
                return $model;
            }
        }

        return null;
    }

    public function save(EntityInterface $entity): void
    {
        if($this->find($entity->getId()) != null) $this->remove($entity->getId());
        $this->models[] = $entity;
        $this->models = [...$this->models];
    }

    public function remove(string $id): void
    {
        foreach($this->models as $key => $model)
        {
            if($model->getId() == $id){
                unset($this->models[$key]);
            }
        }
    }
}