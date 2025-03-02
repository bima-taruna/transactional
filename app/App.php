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

function processTheArray(array $arr, array &$expense, array &$income): array
{
    $processedTransaction = [];
    for ($i = 1; $i < count($arr); $i++) {
        array_push($processedTransaction, extractArray($arr[$i]));
    }
    return $processedTransaction;
}

function sumAndPrint(array $arr)
{
    return array_sum(array_map(fn($price) => floatval(str_replace([",", "$"], "", $price)), $arr));
}

function extractArray(array $transactionRow)
{
    [$date, $checkNumber, $description, $amount] = $transactionRow;

    $amount = (float) str_replace(['$', ','], '', $amount);

    return [
        'date'        => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount'      => $amount,
    ];
}

function printTransaction(array $transactionArr)
{
    foreach ($transactionArr as $transaction) {
        $amount = $transaction['amount'];
        $amountClass = $amount < 0 ? "expense" : "income";
        echo "<td>{$transaction['date']}</td>";
        echo "<td>{$transaction['checkNumber']}</td>";
        echo "<td>{$transaction['description']}</td>";
        echo "<td class='$amountClass'>{$transaction['amount']}</td>";
        echo "</tr>";
    }
}
