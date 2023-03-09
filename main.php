<?php

require __DIR__ . '/vendor/autoload.php';
require_once 'models.php';
require_once 'utils.php';

use Symfony\Component\Validator\Validation;

echo "Validation demonstration";

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

echo "Validation finished!<br><br>";

sleep(2);

echo "Comments task<br>";

$testUserArr = array_merge(
    $testUserArr,
    [
        new User(3, "New User", "New_user@mail.ru", "new_user"),
        new User(5, "New User2", "New_user2@mail.ru", "new_user2"),
    ]
);

$testCommentsArr = [];

foreach ($testUserArr as $tempUser) {
    $tempUserStrRepr= $tempUser->toStr();
    $testCommentsArr = array_merge($testCommentsArr, [new Comment($tempUser, "Hello $tempUserStrRepr")]);
}

// Test function on the 5th User creation date
$resultComments = getCommentsWithUsersAfterDate($testCommentsArr, $testUserArr[4]->getCreationDate());

echo "<br>Result comments:<br>";
foreach ($resultComments as $tempComment) {
    echo $tempComment->getMessage() . '<br>';
}
