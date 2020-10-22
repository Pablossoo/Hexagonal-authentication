<?php
declare(strict_types=1);

namespace RegisterAccount\Domain;

interface UserView
{
    public function getUserByUsername(string $login): User;
}
