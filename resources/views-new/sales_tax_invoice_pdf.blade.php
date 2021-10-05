<!DOCTYPE html>
<?php
$invoice_data = DB::table('invoice')
      ->where('id',$payment->invoice_id)
      ->first();

     $order_item = DB::table('invoice_item')
        ->select('invoice_item.*','product.name as product_name','product.skucode','product.discount_price as price','product.acutal_price as acutal_price','product.images','product.discription')
        ->where('invoice_id',$payment->invoice_id)
        ->join('product','invoice_item.item_id','=','product.id')
        ->get();
     $seller_data = DB::table('users')
          ->where('id',$invoice_data->seller_id)
          ->get()
          ->first();
     $show_company_2 = DB::table('comapny')
        ->where('user_id',auth()->user()->id)
        ->where('id',Session::get('company_id'))
        ->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Tax Invoice</title>

    <style>
    .logo {
        padding: 30px 0;
    }

    .logo th {
        border-bottom: 2px solid;

    }


    .buyer_seller thead {
        background-color: #595959;
    }

    .buyer_seller .b_s th {
        color: #fff;
        border: 1px solid #000;
        margin: 0;
    }

    .buyer_seller .det {
        background-color: #fff;
    }

    td.det {
        border: 1px solid;
    }

    table.dec th,
    table.dec td {
        border: 1px solid;
        text-align: center;
    }

    table.dec th {
        padding: 6px;
    }

    table.dec,
    table.apr {
        background: #fff;
    }

    table.apr td {
        border: 2px solid;
        padding: 0 25px;
    }
    </style>
</head>

<body>
    <div class="section">
        <div>
            <table class="logo" width="100%" cellspacing=0>
                <thead>
                    <tr>
                        <th style="text-align:start;padding-left: 50px;">
                            <a class="navbar-brand" href="#" style="text-decoration: none;">
                                <span class="navbar-brand-full"
                                    style="color: #000; font-weight: bold; font-size: 41px;">E-Procurement</span>
                            </a>
                        </th>
                        <th>
                            <span class="navbar-brand-full"
                                style="font-weight: bold; font-size: 41px;">{{ucfirst($seller_data->name)}} And
                                Company(Seller)</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2"
                            style="font-weight: bold; font-size: 31px;text-align: center;border-bottom: 2px solid;">
                            Sales Tax Invoice
                        </td>
                    </tr>
                    <tr style="font-weight: 700; font-size:18px;">
                        <td style="padding: 3px 10px;border-bottom: 2px solid;">Page # 1</td>
                        <td style="text-align: right;padding: 3px 50px;border-bottom: 2px solid;">Invoice Date: <span
                                style="padding-left: 20px;">-------</span></td>
                    </tr>
                    <tr style="font-weight: 700; font-size:18px;">
                        <td colspan="2" style="text-align: right;padding: 3px 50px;">Invoice Number: <span
                                style="padding-left: 20px;">--------</span></td>
                    </tr>
                </tbody>
            </table>

            <table width="100%" class="table table-bordered buyer_seller" cellspacing=0>
                <thead>
                    <tr class="b_s">
                        <th>Buyer Details</th>
                        <th>Seller Details</th>
                    </tr>
                    <tr>

                        <td class="det" width="50%">
                            <table width="100%">
                                <tr>
                                    <th width="35%" align="start">Companay Code: </th>
                                    <td>------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Company Name:</th>
                                    <td>{{ucfirst($show_company_2->company_name)}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Adress: </th>
                                    <td>Adress example</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">S.Tex Reg no: </th>
                                    <td>-------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">NTN No: </th>
                                    <td>-------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Po/Ref Number: </th>
                                    <td>-------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Ship to Part: </th>
                                    <td>{{$show_company_2->comapny}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Delivery Adress: </th>
                                    <td>{{$show_company_2->delivery_address}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Contact Person: </th>
                                    <td>------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Contact No: </th>
                                    <td>--------</td>
                                </tr>
                            </table>
                        </td>

                        <td class="det" width="50%">
                            <table width="100%">
                                <tr>
                                    <th width="35%" align="start">Challan: </th>
                                    <td>------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Company</th>
                                    <td>{{ucfirst($seller_data->name)}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Adress: </th>
                                    <td>{{$show_company_2->registered_address}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">S.Tex Reg no: </th>
                                    <td>-------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">NTN No: </th>
                                    <td>-------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Sales Order: </th>
                                    <td>------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Sales: </th>
                                    <td>----- , Karachi, South</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Mobile No: </th>
                                    <td>{{$seller_data->phone_number}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Cnic No: </th>
                                    <td>--------</td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php
    $total_sum_price = 0;
    $total_actual_sum_price = 0;
    ?>
                            @foreach($order_item as $item)
                            <?php
    $total_sum_price += $item->quantity*$item->price;
    $total_actual_sum_price += $item->quantity*$item->acutal_price;
    $total_price = $item->quantity*$item->price;
    ?>
                            <table class="dec" width="100%" cellspacing=0>
                                <tr>
                                    <th>S.No</th>
                                    <th>Challan No</th>
                                    <th>Product Details</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>Ammount Excl. Govt Taxes</th>
                                    <th>Rate Of Sale Tax</th>
                                    <th>Value Of Sale Tax</th>
                                    <th>TotalAmount</th>
                                </tr>
                                <tr>
                                    <td>----</td>
                                    <td>------</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>-----</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->skucode}}</td>
                                    <td>{{$payment->tax_detection}} %</td>
                                    <td>------</td>
                                    <td>----</td>
                                    <td>{{$total_price}}</td>
                                </tr>
                            </table>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="apr" width="100%" cellspacing=0>
                                <tr>
                                    <td colspan="2" align="left">Note:
                                        <ul>
                                            <li>The Company charges FED (Under Sales Tax mode). Therefore there will no
                                                sales tax withholding</li>
                                            <li>Exempt From Deduction of Tax U/S 153 Copy of Exemption Certificate
                                                Enclosed.</li>
                                            <li>Material Delivered Under Description "72-a" (Iron & Steel; Ferroalloys;
                                                Bars; Including Wires, Cables, Rolls / Sheet)</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <p style="font-size: 14px;">Gross Invoice Amount:</p>
                                        <p style="font-size: 14px;">Sales Tax Amount:</p>
                                        <p style="font-size: 14px;">Total Invoice Amount (Inc. Sales Tax):</p>
                                        <p style="font-size: 14px;">Add : Extra Tax:</p>
                                        <p style="font-size: 14px;">Transportation Charges:</p>
                                        <p style="font-size: 14px;">Count (PKR):</p>
                                    </td>
                                    <td>
                                        <p>-----</p>
                                        <p>-----</p>
                                        <p>-----</p>
                                        <p>-----</p>
                                        <p>-----</p>
                                        <p>-----</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</body>

</html>