<?php

namespace InfinitySort;

require "SortManager.php";
require "SortObject.php";

$sortManager = new SortManager(
    new SortObject("Auta", 0, 0, 1), // cars
    new SortObject("Závodní", 1, 1, 2), // race
    new SortObject("Nákladní", 1, 1, 3), // trucks
    new SortObject("Motorky", 0, 0, 4), // motorcycles...
    new SortObject("Enduro", 1, 4, 5),
    new SortObject("Babety", 1, 4, 6),
    new SortObject("Letadla", 0, 0, 7),
    new SortObject("Veřejná", 1, 7, 8),
    new SortObject("Airbus", 2, 8, 9),
    new SortObject("Boieng", 2, 8, 10),
    new SortObject("707", 3, 10, 11),
    new SortObject("SmartWings", 2, 8, 12),
    new SortObject("Lodě", 0, 0, 13)
);
$hierarchy = $sortManager->getHierarchy();
$json = json_encode($hierarchy, JSON_PRETTY_PRINT);

echo($json);