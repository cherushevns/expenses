<?php

namespace App\RequestValidator\Auth;


use Core\BusinessRules\Auth\CheckIsUserExistsByLoginInterface;

class RegisterValidator
{
    public function __construct(
        private CheckIsUserExistsByLoginInterface $checkIsUserExistsByLogin
    ) {}

    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors[] = ['field' => 'name', 'error' => 'Заполните поле'];
        }
        if (empty($data['email'])) {
            $errors[] = ['field' => 'email', 'error' => 'Заполните поле'];
        }
        if (empty($data['login'])) {
            $errors[] = ['field' => 'login', 'error' => 'Заполните поле'];
        }
        if (empty($data['password'])) {
            $errors[] = ['field' => 'password', 'error' => 'Заполните поле'];
        }
        if (empty($data['password_confirm'])) {
            $errors[] = ['field' => 'password_confirm', 'error' => 'Заполните поле'];
        }

        if (! empty($errors)) {
            return $errors;
        }

        if ($data['password_confirm'] !== $data['password']) {
            $errors[] = ['field' => 'password_confirm', 'error' => 'Введите корректное подтверждение пароля'];
        }

        if (! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = ['field' => 'email', 'error' => 'Введите корректный email'];
        }

        if ($this->checkIsUserExistsByLogin->check($data['login'])) {
            $errors[] = ['field' => 'login', 'error' => 'Такой логин уже занят'];
        }

        return $errors;
    }
}