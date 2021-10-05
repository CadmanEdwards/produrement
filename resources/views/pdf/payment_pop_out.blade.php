<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Pop-Out</title>
</head>
<style>
.main {
    width: 80%;
    margin: auto;
}

.heading h2 {
    margin-bottom: 0;
    text-align: center;
    width: 70%;
}

.auto,
.manual {
    width: 50%;
}

.tbl:after {
    content: "";
    display: table;
    clear: both;
}

.auto {
    float: left;
}

.tbl {
    border-top: 1px solid;
}

.auto,
.manual {
    display: grid;
}

.auto h4,
.manual h4 {
    text-align: center;
    margin: 0;
    font-size: 14px;
}

.auto thead th,
.manual thead th {
    border: 1px solid;
    background-color: #80808082;
    font-size: 14px;
}
</style>

<body>
    <div class="main">
        <div class="heading">
            <h2 style="border-bottom:1px solid;">STATEMENT OF ACCOUNTS</h2>
            <h2 style="margin:0;">XYZ Company</h2>
        </div>
        <div class="tbl">
            <div class="auto">
                <h4 style="color:red;">Auto Calculation</h4>
                <table width="90%" cellspacing=0>
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Gross Amount</th>
                            <th>GST Value</th>
                            <th>Extra Tax</th>
                            <th>Transportation</th>
                            <th>Net Amount</th>
                            <th>Cheque Calculation</th>
                        </tr>
                    </thead>
                </table>
                <table width="75%" style="margin-top:50px;" cellspacing=0>
                    <tr>
                        <td style="width:14%;">Tax:1</td>
                        <td style="width:39%;">WHT on Gross Amount</td>
                        <td style="width:20%;text-align:right; border:1px solid;">1%</td>
                        <td style="text-align:right;border:1px solid;">26.00</td>
                    </tr>
                    <tr>
                        <td style="width:14%;">Tax:2</td>
                        <td style="width:39%;">WHT on GST Amount</td>
                        <td style="width:20%;text-align:right; border:1px solid;">20%</td>
                        <td style="text-align:right;border:1px solid;">26.00</td>
                    </tr>
                    <tr>
                        <td style="width:14%;">Tax:3</td>
                        <td style="width:39%;">WHT on Net Amount</td>
                        <td style="width:20%;text-align:right; border:1px solid;">5%</td>
                        <td style="text-align:right;border:1px solid;">26.00</td>
                    </tr>
                    <tr>
                        <td style="width:14%;">Tax:4</td>
                        <td style="width:39%;">WHT on Net Amount</td>
                        <td style="width:20%;text-align:right; border:1px solid;">5%</td>
                        <td style="text-align:right;border:1px solid;">26.00</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;padding:20px 0;">TOTAL PAYABLE TAXES</td>
                        <td colspan="2" style="text-align: right;padding: 20px 0;"><span
                                style="display:block;border: 1px solid;background-color: #bebebe;">787.33</span></td>
                    </tr>
                </table>
            </div>
            <div class="manual" style="margin:auto;margin-right:0;">
                <h4 style="color:dodgerblue;">Manual Entry</h4>
                <table width="100%" cellspacing=0>
                    <thead>
                        <tr>
                            <th>Cheque Number</th>
                            <th>Cheque Amount</th>
                            <th>Clearing Date</th>
                            <th>Bank</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>