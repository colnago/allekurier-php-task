<?php

namespace App\Core\User\Application\Query\GetEmailByInactiveUsers;

use App\Core\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetEmailByInactiveUsersHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function __invoke(GetEmailByInactiveUsersQuery $query): array
    {
        $inactiveUsers = $this->userRepository->getByInactiveUsers();

        return array_map(fn($user) => $user->getEmail(), $inactiveUsers);
    }
}
