<?php


function abbreviateFirstName($fullName) {
    $nameParts = explode(' ', $fullName);
    $firstName = $nameParts[0];
    $lastName = end($nameParts);
    $abbreviatedFirstName = ucfirst(substr($firstName, 0, 1));
    $abbreviatedFullName = $abbreviatedFirstName . '. ' . $lastName;
    return $abbreviatedFullName;
}


