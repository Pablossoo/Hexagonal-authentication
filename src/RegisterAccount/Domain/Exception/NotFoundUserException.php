<?php
declare(strict_types=1);

namespace RegisterAccount\Domain\Exception;

class NotFoundUserException extends \Exception
{
    public static function from(string $login)
    {
        return new self(sprintf('unknow user %s', $login));
    }
}
