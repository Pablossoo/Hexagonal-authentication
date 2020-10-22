<?php
declare(strict_types=1);

namespace RegisterAccount\Service;

use RegisterAccount\Domain\User;
use RegisterAccount\Domain\UserRepositoryInterface;
use RegisterAccount\Domain\Validator\PasswordEncoder;
use RegisterAccount\Domain\Validator\ValidatorContext;

final class UserRegisterService
{
    private $userRepository;

    private $passwordEncoder;

    private $validatorContext;

    public function __construct(UserRepositoryInterface $userRepository, PasswordEncoder $passwordEncoder, ValidatorContext $validatorContext)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->validatorContext = $validatorContext;
    }

    public function registerAccount(string $name, string $surname, string $login, string $password, string $sex)
    {
        if ($this->validatorContext->isValid() === false) {
            throw new \Exception(implode(',', $this->validatorContext->getErrorMessage()));
        }
        $encodePassword = $this->passwordEncoder->encodePassword($password);

        $user = new User(
            $name,
            $surname,
            $login,
            $encodePassword,
            $sex
        );

        $this->userRepository->save($user);
    }
}
