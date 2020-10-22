<?php
declare(strict_types=1);

use RegisterAccount\Domain\Validator\LoginValidator;
use RegisterAccount\Domain\Validator\PasswordEncoder;
use RegisterAccount\Domain\Validator\PasswordValidator;
use RegisterAccount\Domain\Validator\ValidatorContext;
use RegisterAccount\Infrastructure\UserRepositoryPdoAdapter;
use RegisterAccount\Service\UserRegisterService;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/pdo.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$login = $_POST['login'];
$password = $_POST['password'];
$sex = $_POST['sex'];

$validatorContext = new ValidatorContext(
    [
        new LoginValidator($login),
        new PasswordValidator($password),
    ]
);

$userRepository = new UserRepositoryPdoAdapter($dbh);
$passwordEncoder = new PasswordEncoder();

$userService = new UserRegisterService(
    $userRepository, $passwordEncoder, $validatorContext
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
    print_r($exception);
}
