<?php

namespace App\Core\User\Application\Command\CreateUser;

use App\Core\User\Domain\Repository\UserRepositoryInterface;
use App\Core\User\Domain\User;
use PharIo\Manifest\InvalidEmailException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsMessageHandler]
class CreateUserHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ValidatorInterface $validator
    ) {}

    public function __invoke(CreateUserCommand $command): void
    {
        $user = new User($command->email);

        $violations = $this->validator->validate($user);

        if (count($violations) > 0) {
            $errorMessage = $violations[0]->getMessage();
            throw new InvalidEmailException($errorMessage);
        }

        $this->userRepository->save($user);
        $this->userRepository->flush();
    }
}
