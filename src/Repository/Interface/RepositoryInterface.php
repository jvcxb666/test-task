<?php

namespace App\Repository\Interface;

use App\Entity\Interface\EntityInterface;

interface RepositoryInterface
{

    public function findAll(): ?array;
    public function find(string $id): ?EntityInterface;
    public function save(EntityInterface $entity): void;
    public function remove(string $id): void;

}