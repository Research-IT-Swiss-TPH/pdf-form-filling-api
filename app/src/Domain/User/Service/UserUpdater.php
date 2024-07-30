<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use DomainException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Uid\Uuid;

final class UserUpdater
{
    private UserRepository $repository;

    private UserValidator $userValidator;

    private LoggerInterface $logger;

    public function __construct(
        UserRepository $repository,
        UserValidator $userValidator,
        LoggerInterface $logger
    ) {
        $this->repository = $repository;
        $this->userValidator = $userValidator;
        $this->logger = $logger;
    }

    public function updateUser(string $userUuid, array $data): void
    {
        // Input validation
        $this->validateUserUpdate($userUuid, $data);

        // // Map UUID to ID
        $userId = $this->repository->mapUuidToId($userUuid);

        // Attach existing UUID to $data
        $data['uuid'] = $userUuid;

        // Update the row
        $this->repository->updateUser($userId, $data);

        // Logging
        $this->logger->info(sprintf('User updated successfully: %s', $userUuid));
    }

    public function validateUserUpdate(string $userUuid, array $data): void
    {
        if( !Uuid::isValid($userUuid)) {
            throw new DomainException(sprintf('UUID not valid: %s', $userUuid));
        }
        
        $this->userValidator->validateUser($data);
    }
}