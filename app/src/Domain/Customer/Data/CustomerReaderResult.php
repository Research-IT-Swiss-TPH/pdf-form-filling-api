<?php

namespace App\Domain\Customer\Data;

/**
 * DTO.
 */
final class CustomerReaderResult
{
    public ?int $id = null;

    public ?string $name = null;

    public ?string $email = null;

    public ?string $organisation = null;

    public ?int $maxProjects = null;

}