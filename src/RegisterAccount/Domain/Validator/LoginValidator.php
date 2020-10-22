<?php
declare(strict_types=1);

namespace RegisterAccount\Domain\Validator;

final class LoginValidator implements ValidatorInterface
{
    private const MIN_LENGTH_LOGIN = 5;

    private $message = 'Login must have least 5 charakters';

    private $login;

    public function __construct(string $login)
    {
        $this->login = $login;
    }

    public function validate(): bool
    {
        if (strlen($this->login) < self::MIN_LENGTH_LOGIN) {
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return $this->message;
    }

    public function getType(): string
    {
        return get_class($this);
    }
}
