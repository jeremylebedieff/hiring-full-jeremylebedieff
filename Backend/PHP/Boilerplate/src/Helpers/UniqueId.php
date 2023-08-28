<?php

declare(strict_types=1);

namespace Fulll\Helpers;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

final class UniqueId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function equals(self $other): bool
    {
        return $this->id === $other->id;
    }

    public function isValid(): bool
    {
        try {
            Uuid::fromString($this->id);
            return true;
        } catch (InvalidUuidStringException $e) {
            return false;
        }
    }

    public function __toString(): string
    {
        return $this->id;
    }


    public function getInteger(): int
    {
       $mut =  hexdec(str_replace('-', '', $this->id));
       // conversion to int
         return intval($mut);

    }



}
