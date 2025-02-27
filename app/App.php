<?php

declare(strict_types=1);

// Your Code

function getCsvContent(string $filepath): array
{
    $result = [];
    if (!file_exists($filepath)) {
        echo "file not found!";
        return [];
    }

    $file = fopen($filepath, "r");
    while (($line = fgetcsv($file)) !== false) {
        array_push($result, $line);
    }
    return $result;
}

function processTheArray(array $arr)
{
    for ($i = 1; $i < count($arr); $i++) {
        echo "<tr></tr>";
        foreach ($arr[$i] as $item) {
            echo "<td>$item</td>";
        }
    }
}
