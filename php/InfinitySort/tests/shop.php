<?php

namespace InfinitySort\Tests;

require "../SortManager.php";
require "../SortObject.php";

use InfinitySort\SortManager;
use InfinitySort\sortObject;

$sortManager = new SortManager([
    new sortObject("Auta",  0, 1), // cars
    new sortObject("Závodní", 1, 2), // race
    new sortObject("Nákladní",  1, 3), // trucks
    new sortObject("Motorky",  0, 4), // motorcycles...
    new sortObject("Enduro",  4, 5),
    new sortObject("Babety",  4, 6),
    new sortObject("Letadla",  0, 7),
    new sortObject("Veřejná", 7, 8),
    new sortObject("Airbus",  8, 9),
    new sortObject("Boieng",  8, 10),
    new sortObject("707",  10, 11),
    new sortObject("SmartWings",  8, 12),
    new sortObject("Lodě",  0, 13)
]);
$hierarchy = $sortManager->getHierarchy();
$json = json_encode($hierarchy, JSON_PRETTY_PRINT);

echo($json);