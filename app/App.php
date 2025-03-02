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

function processTheArray(array $arr): array
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

function printTransaction(array $transactionArr, &$expense, &$income)
{
    foreach ($transactionArr as $transaction) {
        $amount = $transaction['amount'];
        $amountClass = $amount < 0 ? 'expense' : 'income';
        $amount = number_format($amount, 2);
        if ($amount < 0) {
            array_push($expense, $amount);
        } else {
            array_push($income, $amount);
        }
        echo "<tr>
                <td>" . formatDate($transaction['date']) . "</td>
                <td>{$transaction['checkNumber']}</td>
                <td>{$transaction['description']}</td>
                <td class='$amountClass'>$" . $amount . "</td>
            </tr>";
    }
}

function formatDate(string $date): string
{
    return date('M j, Y', strtotime($date));
}
