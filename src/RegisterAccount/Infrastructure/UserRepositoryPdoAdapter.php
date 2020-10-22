<?php
declare(strict_types=1);

namespace RegisterAccount\Infrastructure;

use PDO;
use RegisterAccount\Domain\User;
use RegisterAccount\Domain\UserRepositoryInterface;

class UserRepositoryPdoAdapter implements UserRepositoryInterface
{
    private $pdo;

    public function __construct(pdo $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(User $user): void
    {
        $stmt = $this->pdo->prepare('insert into user_account(`name`, surname, login, password, sex)
        VALUES (:name, :surname, :login, :password, :sex) ');
        $stmt->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(':login', $user->getLogin(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':sex', $user->getSex(), PDO::PARAM_STR);

        $stmt->execute();
    }
}
