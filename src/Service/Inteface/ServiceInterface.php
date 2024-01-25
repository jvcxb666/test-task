<?php

namespace App\Service\Interface;

use App\Entity\Interface\EntityInterface;

interface ServiceInterface
{

    public function get(string $id): ?EntityInterface;
    public function getAll(): ?array;
    public function save(array $data): ?EntityInterface;
    public function delete(string $id): void;

}