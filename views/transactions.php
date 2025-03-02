<!DOCTYPE html>
<html>

<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }

        .expense {
            color: red;
        }

        .income {
            color: green;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once APP_PATH . "App.php";
            $result = getCsvContent(FILES_PATH . "sample_1.csv");
            $income = [];
            $expense = [];
            $transactionArr = processTheArray($result, $expense, $income);
            printTransaction($transactionArr);
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td>
                    <?php
                    $incomeSum = sumAndPrint($income);
                    echo "$" . number_format($incomeSum, 2) ?? 0;
                    ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td>
                    <?php
                    $expenseSum = sumAndPrint($expense);
                    echo "$" . number_format($expenseSum, 2) ?? 0;
                    ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td>
                    <?php
                    $total = $incomeSum - (-$expenseSum);
                    echo "$" . number_format($total, 2) ?? 0;
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>