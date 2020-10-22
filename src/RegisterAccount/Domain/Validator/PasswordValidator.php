<?php
declare(strict_types=1);

namespace RegisterAccount\Domain\Validator;

final class PasswordValidator implements ValidatorInterface
{
    private const MIN_LENGTH_PASSWORD = 8;

    private $message = 'password must  have least 8 charakters';

    private $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function validate(): bool
    {
        if (strlen($this->password) < self::MIN_LENGTH_PASSWORD) {
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return  $this->message;
    }

    public function getType(): string
    {
        return get_class($this);
    }
}
