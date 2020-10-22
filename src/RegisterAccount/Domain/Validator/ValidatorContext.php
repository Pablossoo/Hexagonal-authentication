<?php
declare(strict_types=1);

namespace RegisterAccount\Domain\Validator;

final class ValidatorContext
{
    private $validator = [];

    private $errors = [];

    public function __construct(array $validator)
    {
        $this->validator = $validator;
    }

    public function isValid(): bool
    {
        if (empty($this->getValidationErrors())) {
            return true;
        }

        return false;
    }

    public function getErrorMessage()
    {
        if (!empty($this->errors)) {
            return $this->errors;
        }

        return [];
    }

    private function getValidationErrors(): array
    {
        /** @var ValidatorInterface $validator */
        foreach ($this->validator as $validator) {
            if (!$validator->validate()) {
                $this->errors[$validator->getType()] = $validator->getErrorMessage();
            }
        }

        return $this->errors;
    }
}
