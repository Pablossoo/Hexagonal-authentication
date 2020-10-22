<?php
declare(strict_types=1);

namespace RegisterAccount\Infrastructure;

use PDO;
use RegisterAccount\Domain\Exception\NotFoundUserException;
use RegisterAccount\Domain\User;
use RegisterAccount\Domain\UserView;

class UserViewPdoAdapter implements UserView
{
    private $pdo;

    public function __construct(pdo $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserByUsername(string $login): User
    {
        $stmt = $this->pdo->prepare('select * from user_account where login=:login limit 1');
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            throw NotFoundUserException::from($login);
        }

        return new User($user['name'], $user['surname'], $user['login'], $user['password'], $user['sex']);
    }
}
