<?php

namespace Tecgdcs;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Capsule\Manager;
use Tecgdcs\Exceptions\ValidationRuleNotFoundException;

class Validator
{
    public static function required(string $field_name): bool
    {
        if (
            !array_key_exists($field_name, $_REQUEST)
            || trim($_REQUEST[$field_name]) === ''
        ) {
            $_SESSION['errors'][$field_name] =
                sprintf(MESSAGES['required'], $field_name);

            return false;
        }

        return true;
    }

    public static function email(string $field_name): bool
    {
        if (
            array_key_exists($field_name, $_REQUEST) &&
            trim($_REQUEST[$field_name]) !== '' &&
            !filter_var(trim($_REQUEST[$field_name]), FILTER_VALIDATE_EMAIL)
        ) {
            $_SESSION['errors'][$field_name] = sprintf(MESSAGES['email'], $field_name);

            return false;
        }

        return true;
    }

    public static function phone(string $field_name): bool
    {
        if (
            array_key_exists($field_name, $_REQUEST) &&
            trim($_REQUEST[$field_name]) !== '' &&
            (
                strlen($_REQUEST[$field_name]) < 9 ||
                !is_numeric(
                    str_replace(['+', '(', ')', ' '], '', $_REQUEST[$field_name])
                )
            )
        ) {
            $_SESSION['errors'][$field_name] = sprintf(MESSAGES['phone'], $field_name);

            return false;
        }

        return true;
    }

    public static function same(string $verification_field_name, string $original_field_name): bool
    {
        if (
            array_key_exists($verification_field_name, $_REQUEST) &&
            array_key_exists($original_field_name, $_REQUEST)
        ) {
            if (
                trim($_REQUEST[$verification_field_name]) !==
                trim($_REQUEST[$original_field_name])
            ) {
                $_SESSION['errors'][$verification_field_name] =
                    sprintf(MESSAGES['same'], $verification_field_name, $original_field_name);

                return false;
            }

            return true;
        }

        return false;
    }

    public static function exists(string $field_name, string $table, string $column): bool
    {
        $item = Manager::table($table)
            ->where($column, $_REQUEST[$field_name])
            ->first();
        if (!$item) {
            $_SESSION['errors'][$field_name] =
                sprintf(MESSAGES['in_collection'], $field_name, $table);

            return false;
        }

        return true;
    }

    private static function chip(string $field_name): bool
    {
        if (array_key_exists($field_name, $_REQUEST) &&
            trim($_REQUEST[$field_name]) !== '' &&
            (
                strlen($_REQUEST[$field_name]) < 15 ||
                !is_numeric($_REQUEST[$field_name]))
        ) {
            $_SESSION['errors'][$field_name] = sprintf(MESSAGES['chip'], $field_name);
            return false;
        }
        return true;
    }

    private static function gender(string $field_name): bool
    {
        if (array_key_exists($field_name, $_REQUEST) &&
            trim($_REQUEST[$field_name]) !== '' &&
            (($_REQUEST[$field_name] !== 'male') && ($_REQUEST[$field_name] !== 'female'))
        ) {
            $_SESSION['errors'][$field_name] = sprintf(MESSAGES['gender'], $field_name);
            return false;
        }
        return true;
    }

    public static function age(string $field_name): bool
    {
        if (array_key_exists($field_name, $_REQUEST) &&
            trim($_REQUEST[$field_name]) !== '' &&
            (
                $_REQUEST[$field_name] > 350 ||
                !is_numeric($_REQUEST[$field_name])
            )
        ) {
            $_SESSION['errors'][$field_name] = sprintf(MESSAGES['pet_age'], $field_name);
            return false;
        }
        return true;
    }

    public static function lang(string $key): bool
    {
        if (!array_key_exists($_REQUEST[$key], AVAILABLE_LANGUAGES)) {
            $_SESSION['errors'][$key] = 'Cette langue n\'est pas prise en charge par l\'application !';
            return false;
        }
        return true;
    }

    public static function check(array $constraints)
    {

        $data = array_filter($_REQUEST, fn($key) => $key !== '_csrf', ARRAY_FILTER_USE_KEY);

        try {
            self::parse_constraints($constraints);
        } catch (ValidationRuleNotFoundException $e) {
            exit($e->getMessage());
        }

        if (isset($_SESSION['errors'])) {
            $_SESSION['old'] = $_REQUEST;
            back();
        }

        return $data;
    }

    /**
     * @throws ValidationRuleNotFoundException
     */
    private static function parse_constraints(array $constraints): void
    {
        $method = $param1 = $param2 = '';
        foreach ($constraints as $field_name => $constraint) {
            $array_rules = explode('|', $constraint);
            foreach ($array_rules as $method) {
                if (str_contains($method, ':')) {
                    [$method, $param1] = explode(':', $method);
                }
                if (str_contains($param1, ',')) {
                    [$param1, $param2] = explode(',', $param1);
                }

                if (!method_exists(__CLASS__, $method)) {
                    throw new ValidationRuleNotFoundException($method);
                }
                self::$method($field_name, $param1, $param2);
            }
        }
    }
}
