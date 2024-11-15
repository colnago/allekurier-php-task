<?php

namespace App\Core\User\Domain\Repository;

use App\Core\Invoice\Domain\Invoice;
use App\Core\User\Domain\Exception\UserNotFoundException;
use App\Core\User\Domain\User;

interface UserRepositoryInterface
{
    /**
     * @throws UserNotFoundException
     */
    public function getByEmail(string $email): User;

    public function getByInactiveUsers(): array;

    public function save(User $user): void;

    public function flush(): void;
}
