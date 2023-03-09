<?php

require_once 'models.php';

function getCommentsWithUsersAfterDate(array $commentsArray, DateTime $targetCreationDate): array
{
    $resultArray = [];

    foreach ($commentsArray as $tempComment) {
        if ($tempComment->getUser()->getCreationDate() >= $targetCreationDate) {
            $resultArray = array_merge($resultArray, [$tempComment]);
        }
    }

    return $resultArray;
}
