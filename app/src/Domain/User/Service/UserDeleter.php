<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\Uid\Uuid;
use DomainException;

final class UserDeleter
{
    private UserRepository $repository;
    private LoggerInterface $logger;

    public function __construct(
        UserRepository $repository,
        LoggerInterface $logger
    ) {
        $this->repository = $repository;
        $this->logger = $logger;
    }

    public function deleteUser(string $userUuid): void
    {
        $this->validateUserDelete($userUuid);

        $userId = $this->repository->mapUuidToId($userUuid);

        $this->repository->deleteUserById($userId);

        $this->logger->info(sprintf('User deleted successfully: %s', $userUuid));

    }

    public function validateUserDelete(string $userUuid): void 
    {
        if( !Uuid::isValid($userUuid)) {
            throw new DomainException(sprintf('UUID not valid: %s', $userUuid));
        }
    }
}