<?php

require __DIR__ . '/vendor/autoload.php';
require 'models.php';

use Symfony\Component\Validator\Validation;

date_default_timezone_set('Russia/Moscow');
$validator = Validation::createValidator();

$testUserArr = [
    new User(1, "Matwey", "matwey@gmail.com", "123456"),
    new User(-1, "Admin", "admin@gmail.com", "admin123"),
    new User(1, "", "matwey@gmail.com", "123456"),
    new User(1, "Ann", "ann", "123456"),
    new User(1, "Ann", "ann@mail.ru", "1234"),
];

foreach ($testUserArr as $tempUser) {

    $abc= $tempUser->toStr();
    
    $tempValidResults = $tempUser->validateObject($validator);

    if (count($tempValidResults) !== 0) {
        $tempUserStrRepr = $tempUser->toStr();

        echo "Validation error in object: $tempUserStrRepr <br>";

        foreach ($tempValidResults as $tempError) {
            echo '***' . $tempError->getMessage() . '***<br><br>';
        }
    }
}

echo "Validation finished!";
