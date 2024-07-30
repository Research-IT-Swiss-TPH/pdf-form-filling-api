<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Service\UserValidator;
use Psr\Log\LoggerInterface;
use Symfony\Component\Uid\Uuid;

final class UserCreator
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

    public function createUser(array $data): int
    {
        // Input validation
        $this->userValidator->validateUser($data);

        // Attach new UUID to $data
        $user["uuid"] = Uuid::v4();

        // Insert user and get new user ID
        $userUuid = $this->repository->insertUser($data);

        // // Logging
        $this->logger->info(sprintf('User created successfully: %s', $userUuid));

        return $userUuid;
    }

}