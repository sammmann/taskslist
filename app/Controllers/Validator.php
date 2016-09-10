<?php
// Класс, отвечающий за валидацию
namespace App\Controllers;

class Validator
{
    public static function validate($name, $desc)
    {
        // Проверка обязательности ввода значений
        if (strlen($name) == 0 or strlen($desc) == 0) {
            echo "Введите название и описание задания";
            return false;
        }

        // Проверка длины значений
        if (strlen($name) > 50 or strlen($desc) > 255) {
            echo "Введенные значения привышают максимальную длину";
            return false;
        }

        return true;
    }
}
