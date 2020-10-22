<?php
declare(strict_types=1);

namespace RegisterAccount\Domain\Validator;

interface ValidatorInterface
{
    public function validate(): bool;

    public function getErrorMessage(): string;

    public function getType(): string;
}
