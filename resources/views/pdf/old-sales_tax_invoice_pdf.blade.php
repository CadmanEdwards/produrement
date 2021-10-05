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
        padding: 0 15px;
    }
    </style>
    <style>
.page-break {
    page-break-after: always;
}
</style>
</head>

<body>

<?php //echo '<pre>'; print_r($buyer_company); die;?>

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
                                style="padding-left: 20px;">{{date('d-m-Y')}}</span></td>
                    </tr>
                    <tr style="font-weight: 700; font-size:18px;">
                        <td colspan="2" style="text-align: right;padding: 3px 50px;">Invoice Number: <span
                                style="padding-left: 20px;">{{$invoice_order->id}}</span></td>
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
                                    <th width="35%" align="start">Company Code: </th>
                                    <td>---------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Company Name:</th>
                                    <td>{{ucfirst($buyer_company->company_name)}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Adress: </th>
                                    <td>{{$buyer_company->registered_address}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">S.Tax Reg no: </th>
                                    <td>-------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">NTN No: </th>
                                    <td>{{$buyer_company->ntn_number}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Po/Ref Number: </th>
                                    <td>-------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Ship to Part: </th>
                                    <td>--------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Delivery Adress: </th>
                                    <td>{{$buyer_company->delivery_address}}</td>
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
                                    <td>{{ucfirst($seller_company->company_name)}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Adress: </th>
                                    <td>{{$seller_company->registered_address}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">S.Tax Reg no: </th>
                                    <td>-------</td>

                                </tr>
                                <tr>
                                    <th width="35%" align="start">NTN No: </th>
                                    <td>{{$seller_company->ntn_number}}</td>

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
                                    <td>{{$seller_company->cnic_number}}</td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                    <tr class="">
                        <td colspan="2">
                            <?php
                            $total_sum_price = 0;
                            $total_actual_sum_price = 0;
                            
                            ?>
                            

                            <table class="dec " width="100%" cellspacing=0>
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
                            
                                @foreach($order_item as $item)

                                <?php 
                                $image_data = explode(',',$item->images);
                                $total_price = $item->quantity*$item->price;
                                $total_sum_price += $item->quantity*$item->price;
                                $total_actual_sum_price += $item->quantity*$item->acutal_price;
                                $checked = ($item->is_received == 1) ? "checked" : "";
                                ?>


                                <tr>
                                    <td>----</td>
                                    <td>------</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>-----</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->skucode_name}}</td>
                                    <td>-------</td>
                                    <td>------</td>
                                    <td>----</td>
                                    <td>{{$total_price}}</td>
                                </tr>

                                @endforeach

                            </table>
                           
                        </td>
                    </tr>
                   
                </thead>
            </table>

            <table style="width:100%;" class="apr" cellspacing="0">
  <tr >
    <td  >Note:
        <ul >
            <li>The Company charges FED (Under Sales Tax mode). Therefore there will no
                                                sales tax withholding</li>
            <li>Exempt From Deduction of Tax U/S 153 Copy of Exemption Certificate
                                                Enclosed.</li>
            <li>Material Delivered Under Description "72-a" (Iron & Steel; Ferroalloys;
                                                Bars; Including Wires, Cables, Rolls / Sheet)</li>
        </ul>
    </td>
    <td>  <p style="font-size: 12px; width:50px;">Total Payment</p>
                                        <p style="font-size: 12px;">Sales Tax</p>
                                        <p style="font-size: 12px;">Actual Price</p>
                                        <p style="font-size: 12px;">Discount Price</p>
                                        <p style="font-size: 12px;">Discount</p>
                                        <p style="font-size: 12px;">Total Price With GST</p></td>
    <td>  <p style="font-size: 12px;">RS {{number_format($total_sum_price)}}</p>
                                        <p style="font-size: 12px;">10%</p>
                                        <p style="font-size: 12px;">RS {{number_format($total_actual_sum_price)}}</p>

                                        <p style="font-size: 12px;">RS {{number_format($total_sum_price)}}</p>
                                        <p style="font-size: 12px;">RS {{number_format($total_actual_sum_price - $total_sum_price)}}</p>
                                        <p style="font-size: 12px;">RS {{number_format($total_sum_price)}}</p></td>
  </tr>
 
</table>


        </div>

    </div>
</body>

</html>