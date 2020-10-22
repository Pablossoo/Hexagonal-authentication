<?php
declare(strict_types=1);

namespace RegisterAccount\Domain;

final class User
{
    private $name;

    private $surname;

    private $login;

    private $password;

    private $sex;

    public function __construct(string $name, string $surname, string $login, string $password, string $sex)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->login = $login;
        $this->password = $password;
        $this->sex = $sex;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSex(): string
    {
        return $this->sex;
    }
}
