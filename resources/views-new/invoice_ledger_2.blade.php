<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>invoice_ledger_1</title>

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
        width: 4%;
        font-size: 10px;
    }
    </style>
</head>

<body>
    <div class="section">
        <div class="inv_head">
            <h1>INVOICE STATEMENT</h1>
        </div>
        <div class="main_frm">
            <div class="frm">
                <form action="">
                    <div class="btn-group-toggle" data-toggle="buttons" style="margin:0 0 20px;">
                        <label>To Date : </label> <input type="date" name="" id="">
                        <label>To Date : </label> <input type="date" name="" id="">
                        <ul style="list-style:none;float:right;width:35%;margin-top:0;">
                            <li><label class="btn btn-primary">
                                    A to Z: </label> <input type="textbox" placeholder="P" style="text-align: center;">
                            </li>
                            <li>
                                <label class="btn btn-primary">
                                    Serial No: </label> <input type="textbox" style="text-align: center;">

                            </li>
                        </ul>
                        <div style="margin-top:20px;">
                            <label>From Chq Date: </label> <input type="date" name="" id="">
                            <label>To Chq Date: </label> <input type="date" name="" id="">
                        </div>
                        <div class="buy" style="margin-top:20px;"> <label>Buyer : </label> <input type="text"
                                placeholder="Company Name"></div>
                    </div>
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <label for="Search">Search : </label>
                        <textarea rows="6" id="Search"
                            placeholder='Cheque Number.&#13;Invoice Number.&#13;Department&#13;DC Number.&#13;PO Number.&#13;Ref Number'
                            name="title"></textarea>
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
                    <td width="40%"><button type="submit"
                            style="padding: 2px 100px;display:block;margin:auto;margin-right:0;">Search</button></td>
                    <td width="33%"><button type="submit"
                            style="padding: 2px 30px;display: block;margin: auto;">Download CSV</button></td>
                </tr>
            </table>
            <table class="ac_data" width="100%">
                <thead>
                    <th>Invoice No</th>
                    <th>Invoice Date</th>
                    <th>Company</th>
                    <th>Department</th>
                    <th>PO No</th>
                    <th>Gross Amount</th>
                    <th>GST Value</th>
                    <th>Net Amount</th>
                    <th>0%</th>
                    <th>Tax1</th>
                    <th>Tax2</th>
                    <th>Tax3</th>
                    <th>Cheque Value</th>
                    <th>Deposit Date</th>
                    <th>Cheque Amount</th>
                    <th>Cheque Number</th>
                    <th>Balance</th>
                    <th>GST Certificate</th>
                    <th>WTH Certificate</th>
                    <th>Extra Tax Certificate</th>
                </thead>
            </table>
        </div>

    </div>
</body>

</html>