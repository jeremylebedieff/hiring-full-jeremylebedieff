<?php

namespace Fulll\Helpers;

class GeneratePlateNumber
{
    private $plateNumber;

    public function __construct()
    {
        $this->plateNumber = $this->generate();
    }

    public function generate(): string
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $plateNumber = '';
        for ($i = 0; $i < 2; $i++) {
            $plateNumber .= $letters[rand(0, strlen($letters) - 1)];
        }
        $plateNumber .= '-';
        for ($i = 0; $i < 3; $i++) {
            $plateNumber .= rand(0, 9);
        }
        $plateNumber .= '-';
        for ($i = 0; $i < 2; $i++) {
            $plateNumber .= $letters[rand(0, strlen($letters) - 1)];
        }
        return $plateNumber;
    }

    public function __toString(): string
    {
        return (string) $this->plateNumber;
    }

    public function equals(self $other): bool
    {
        return $this->plateNumber === $other->plateNumber;
    }

    public function isValid(): bool
    {
        return preg_match('/^[A-Z]{2}-[0-9]{3}-[A-Z]{2}$/', $this->plateNumber);
    }

}