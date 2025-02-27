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
            processTheArray($result, $expense, $income);
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td>
                    <?php
                    $incomeSum = array_sum(array_map(fn($price) => floatval(str_replace([",", "$"], "", $price)), $income));;
                    echo "$$incomeSum";
                    ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td>
                    <?php
                    $expenseSum = array_sum(array_map(fn($price) => floatval(str_replace(["-", ",", "$"], "", $price)), $expense));;
                    echo "-$$expenseSum";
                    ?>
                </td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td><!-- YOUR CODE --></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>