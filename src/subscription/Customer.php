<?php

declare(strict_types=1);

namespace Temporal\Samples\Subscription;

class Customer
{
    private string $firstName;
    private string $lastName;
    private string $id;
    private string $email;
    private Subscription $subscription;

    public function __construct(
        string $firstName,
        string $lastName,
        string $id, string $email,
        Subscription $subscription)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->id = $id;
        $this->email = $email;
        $this->subscription = $subscription;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSubscription() {
        return $this->subscription;
    }

    public function setFirstName(string $firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName) {
        $this->lastName = $lastName;
    }

    public function setId(string $id) {
        $this->id = $id;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setSubscription(Subscription $subscription) {
        $this->subscription = $subscription;
    }
}
