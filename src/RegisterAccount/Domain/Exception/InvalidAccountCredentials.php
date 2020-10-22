<?php
declare(strict_types=1);

namespace RegisterAccount\Domain\Exception;

class InvalidAccountCredentials extends \Exception
{
    public function withIt(string $username)
    {
        return new self(sprintf('invalid credentials, userame: %s', $username));
    }
}
