<?php

namespace model;

use DateTime;

class User
{
    private string $email;
    private string $password;
    private string $firstName;
    private string $lastName;
    private string $birthdate;
    private string $gender;
    private float $height;
    private float $weight;

    /**
     * Default constructor for User.
     */
    public function  __construct() { }

    /**
     * Initializes the user with given values.
     * @param string $em Email.
     * @param string $pa Password.
     * @param string $fn First name.
     * @param string $ln Last name.
     * @param string $bi Birthdate.
     * @param string $ge Gender.
     * @param float $he Height.
     * @param float $we Weight.
     * @return void
     */
    public function init($em, $pa, $fn, $ln, $bi, $ge, $he, $we): void
    {
        $this->email = $em;
        $this->password = $pa;
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->birthdate = $bi;
        $this->gender = $ge;
        $this->height = $he;
        $this->weight = $we;
    }

    /**
     * Returns the user's email.
     * @return string
     */
    public function getEmail(): string { return $this->email; }

    /**
     * Returns the user's password.
     * @return string
     */
    public function getPassword(): string { return $this->password; }

    /**
     * Returns the user's first name.
     * @return string
     */
    public function getFirstName(): string { return $this->firstName; }

    /**
     * Returns the user's last name.
     * @return string
     */
    public function getLastName(): string { return $this->lastName; }

    /**
     * Returns the user's birthdate.
     * @return string
     */
    public function getBirthdate(): string { return $this->birthdate; }

    /**
     * Returns the user's gender.
     * @return string
     */
    public function getGender(): string { return $this->gender; }

    /**
     * Returns the user's height.
     * @return float
     */
    public function getHeight(): float { return $this->height; }

    /**
     * Returns the user's weight.
     * @return float
     */
    public function getWeight(): float { return $this->weight; }

    /**
     * Returns a string representation of the user.
     * @return string
     */
    public function __toString(): string
    {
        return $this->email . " ". $this->firstName. " ". $this->lastName. " ". $this->birthdate. " ". $this->birthdate. " ". $this->gender. " ". $this->height. " ". $this->weight;
    }
}