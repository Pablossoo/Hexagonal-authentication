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

if (isset($_GET['action'])) {

    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    $passwordEncoder = new PasswordEncoder();
    $userViewRepository = new UserViewPdoAdapter($dbh);

    $userService = new UserLoginService(
        $userViewRepository,
        $passwordEncoder
    );

    if (($_GET['action']) === 'login') {
            try {
                $userService->login($login, $password);
            } catch (Throwable $exception) {
                echo $exception->getMessage();
            }
    } elseif (($_GET['action']) === 'register') {
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
}

if(($_GET['action']) === 'logout') {
    $userService->logout();;
    echo 'wylogowano';
}
if (isset($_SESSION)) {

    echo 'witaj po zalogowaniu Imie: ' . $_SESSION['login'] . PHP_EOL . ' NAZWISKO: ' . $_SESSION['surname'] . PHP_EOL . ' płec: ' . $_SESSION['sex'];
    echo "<a href=index.php?action=logout>Wyloguj się</a><br>";
}else {
    echo "<a href=../login_form.html>Zaloguj się</a><br>";
    echo "<a href=../register_acc.html>Zarejestruj się</a>";
}
