<?php
declare(strict_types=1);

namespace RegisterAccount\Service;

use RegisterAccount\Domain\Validator\PasswordEncoder;
use RegisterAccount\Infrastructure\UserViewPdoAdapter;

final class UserLoginService
{
    private $userRepository;

    private $passwordEncoder;

    public function __construct(UserViewPdoAdapter $userRepository, PasswordEncoder $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function login(string $login, string $password): void
    {
        $user = $this->userRepository->getUserByUsername($login);

        if ($this->passwordEncoder->decodePassword($password, $user->getPassword()) === true) {
            $_SESSION['login'] = $user->getName();
            $_SESSION['surname'] = $user->getSurname();
            $_SESSION['sex'] = $user->getSex();
        }
    }

    public function logout()
    {

    }
}
