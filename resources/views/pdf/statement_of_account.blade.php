<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement Of Account</title>

    <style>
    .inv_head {
        text-align: center;
        border-bottom: 1px solid;
        width: 80%;
        margin: auto;
    }

    .main_frm {
        width: 80%;
        margin: 50px auto;
    }

    .frm {
        margin: auto;
        width: 70%;
        font-size: 14px;
    }

    .frm label {
        width: 100px;
        display: inline-block;
        text-align: right;
    }

    .frm label .buy {
        width: 200px;
    }

    .buy input[type="text"] {
        width: 45%;
    }

    textarea {
        vertical-align: middle;
        width: 45%;
    }

    .ac_data thead th {
        border: 1px solid;
        width: 7%;
        font-size: 11px;
    }
    </style>
</head>

<body>
    <div class="section">
        <div class="inv_head">
            <h1>STATEMENT OF ACCOUNTS</h1>
        </div>
        <div class="main_frm">
            <div class="frm">
                <form action="">
                    <label>To Date : </label> <input type="date" name="" id="">
                    <label>To Date : </label> <input type="date" name="" id="">
                    <p class="buy"> <label>Buyer : </label> <input type="text"></p>
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <label for="Search">Search : </label>
                        <textarea rows="5" id="Search" placeholder='DC Number.&#13;PO Number.' name="title"></textarea>
                        <ul style="list-style: none;float: right;width: 35%;">
                            <li><label class="btn btn-primary">
                                    Pending: </label> <input type="textbox" placeholder="P" style="text-align: center;">
                            </li>
                            <li>
                                <label class="btn btn-primary">
                                    Paid: </label> <input type="textbox" style="text-align: center;">

                            </li>
                            <li><label class="btn btn-primary">
                                    Cancelled: </label> <input type="textbox" style="text-align: center;">
                            </li>
                        </ul>


                    </div>
                </form>
            </div>
            <table width="100%" style="margin:25px 0;border-bottom: 1px solid;padding-bottom: 25px;">
                <tr>
                    <td width="33%"><button type="submit" style="padding: 2px 33px;">Receive Payment (Check P)</button>
                    </td>
                    <td width="33%"><button type="submit" style="padding: 2px 100px;">Search</button></td>
                    <td width="33%"><button type="submit" style="padding: 2px 100px;">Download CSV</button></td>
                </tr>
            </table>
            <table class="ac_data" width="100%">
                <thead>
                    <th>Company</th>
                    <th>Challan Number</th>
                    <th>Invoice Number</th>
                    <th>Sales Order Number</th>
                    <th>PO/Ref Number</th>
                    <th>Invoice Date</th>
                    <th>Gross Amount</th>
                    <th>Zero Percent</th>
                    <th>GST Amount</th>
                    <th>Other Tax</th>
                    <th>Transportation Charges</th>
                    <th>Net Invoice Amount</th>
                    <th>Select</th>
                </thead>
            </table>
        </div>

    </div>
</body>

</html>