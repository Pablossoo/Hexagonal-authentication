<?php
declare(strict_types=1);

use RegisterAccount\Domain\Validator\LoginValidator;
use RegisterAccount\Domain\Validator\PasswordEncoder;
use RegisterAccount\Domain\Validator\PasswordValidator;
use RegisterAccount\Domain\Validator\ValidatorContext;
use RegisterAccount\Infrastructure\UserRepositoryPdoAdapter;
use RegisterAccount\Infrastructure\UserViewPdoAdapter;
use RegisterAccount\Service\UserLoginService;
use RegisterAccount\Service\UserRegisterService;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/pdo.php';

$login = $_POST['login'];
$password = $_POST['password'];

$passwordEncoder = new PasswordEncoder();

if (($_GET['action']) === 'login') {
    $userViewRepository = new UserViewPdoAdapter($dbh);

    $userService = new UserLoginService(
        $userViewRepository,
        $passwordEncoder
    );

    $userService->login($login, $password);
} else {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $sex = $_POST['sex'];

    $validatorContext = new ValidatorContext(
        [
            new LoginValidator($login),
            new PasswordValidator($password),
        ]
    );

    $userViewRepository = new UserRepositoryPdoAdapter($dbh);

    $userService = new UserRegisterService(
        $userViewRepository, $passwordEncoder, $validatorContext
    );

    try {
        $userService->registerAccount(
            $name,
            $surname,
            $login,
            $password,
            $sex
        );
    } catch (Throwable $exception) {
        echo $exception->getMessage();
    }
}
