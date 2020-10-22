<?php
declare(strict_types=1);

namespace RegisterAccount\Domain\Validator;

class PasswordEncoder
{
    public function encodePassword(string $password, array $options = []): string
    {
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
}
