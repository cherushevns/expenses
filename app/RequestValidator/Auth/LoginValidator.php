<?php

namespace App\RequestValidator\Auth;


use Core\BusinessRules\Auth\CheckIsUserExistsByLoginInterface;
use Core\BusinessRules\Auth\ValidateUserPasswordInterface;

class LoginValidator
{
    public function __construct(
        private CheckIsUserExistsByLoginInterface $checkIsUserExistsByLogin,
        private ValidateUserPasswordInterface $validateUserPassword
    ) {}

    public function validate(array $data): array
    {
        $errors = [];
        if (empty($data['login'])) {
            $errors[] = ['field' => 'login', 'error' => 'Заполните поле'];
        }
        if (empty($data['password'])) {
            $errors[] = ['field' => 'password', 'error' => 'Заполните поле'];
        }

        if (! empty($errors)) {
            return $errors;
        }

        if (! $this->checkIsUserExistsByLogin->check($data['login'])) {
            $errors[] = ['field' => 'login', 'error' => 'Пользователь не существует'];
        }

        if (! empty($errors)) {
            return $errors;
        }

        if (! $this->validateUserPassword->validate($data['login'], $data['password'])) {
            $errors[] = ['field' => 'password', 'error' => 'Введите корректный пароль'];
        }

        return $errors;
    }
}