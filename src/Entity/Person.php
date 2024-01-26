<?php

namespace App\Entity;

use App\Entity\Interface\EntityInterface;

class Person implements EntityInterface
{

    private string $id;
    private string $first_name;
    private string $last_name;
    private string $middle_name;
    private string $email;
    private ?string $santa_id;
    private ?string $receiver_id;

    public function __construct(string $name = null,string $last_name = null,string $middle_name = null,string $email = null)
    {
        $this->id = uniqid();
        if(!empty($name)) $this->first_name = $name;
        if(!empty($last_name)) $this->last_name = $last_name;
        if(!empty($middle_name)) $this->middle_name = $middle_name;
        if(!empty($email)) $this->email = $email;
        $this->santa_id = null;
        $this->receiver_id = null;
    }

    public function getFullName(): ?string
    {
        return implode(" ",[$this->last_name,$this->first_name,$this->middle_name ?? null]);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getMiddleName(): string
    {
        return $this->middle_name;
    }

    public function setMiddleName(string $middle_name): void
    {
        $this->middle_name = $middle_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getEmail() :string
    {
        return $this->email;
    }

    public function setEmail(string $email) :void
    {
        $this->email = $email;
    }

    public function getSantaId(): ?string
    {
        return $this->santa_id;
    }

    public function setSantaId(string $id): void
    {
        $this->santa_id = $id;
    }

    public function getReceiverId(): ?string
    {
        return $this->receiver_id;
    }

    public function setReceiverId(string $id): void
    {
        $this->receiver_id = $id;
    }
}