<?php
declare(strict_types=1);

namespace RegisterAccount\Domain;

interface UserRepositoryInterface
{
    public function save(User $user): void;
}
