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
                            <span class="navbar-brand-full" style="font-weight: bold; font-size: 41px;">{{$invoice->show_company_1->company_name}} And
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
                                style="padding-left: 20px;">24-06-2021</span></td>
                    </tr>
                    <tr style="font-weight: 700; font-size:18px;">
                        <td colspan="2" style="text-align: right;padding: 3px 50px;">Invoice Number: <span
                                style="padding-left: 20px;">{{$invoice->id}}</span></td>
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
                                    <td>{{$invoice->show_company_2->company_name}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Adress: </th>
                                    <td>{{$invoice->show_company_2->registered_address}}</td>
                                </tr>
                                
                                @if($invoice->show_company_2->strn_number)
                                <tr> 
                                        <th width="35%" align="start">S.Tax Reg No :  </th>
                                        <td>{{$invoice->show_company_2->strn_number}}</td>
                                    
                                        <th align="{{$invoice->show_company_2->strn_number ? 'end' : 'start'}}">NTN No: </th>
                                        <td>{{$invoice->show_company_2->ntn_number}}</td>
                                </tr>

                                @endif

                                @if(!$invoice->show_company_2->strn_number && $invoice->show_company_2->ntn_number)
                                <tr> 
                                        <th width="35%" align="start">NTN No:</th>
                                        <td>{{$invoice->show_company_2->ntn_number}}</td>                                      
                                </tr>

                                @endif


                                @if(!$invoice->show_company_2->strn_number && !$invoice->show_company_2->ntn_number)
                                <tr>
                                    <th width="35%" align="start">CNIC Number : </th>
                                    <td>{{$invoice->show_company_2->cnic_number}}</td>
                                </tr>
                                @endif

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
                                    <td>{{$invoice->show_company_2->delivery_address}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Contact Person: </th>
                                    <td>{{$invoice->buyerUser->name}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Contact No: </th>
                                    <td>{{$invoice->buyerUser->phone_number}}</td>
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
                                    <th width="35%" align="start">Company Name</th>
                                    <td>{{$invoice->show_company_1->company_name}}</td>

                                </tr>
                                <tr>
                                    <th width="35%" align="start">Adress: </th>
                                    <td>{{$invoice->show_company_1->registered_address}}</td>
                                </tr>

                                
                                @if($invoice->show_company_1->strn_number)
                                <tr> 
                                        <th width="35%" align="start">S.Tax Reg No :  </th>
                                        <td>{{$invoice->show_company_1->strn_number}}</td>
                                    
                                        <th align="{{$show_company_1->strn_number ? 'end' : 'start'}}">NTN No: </th>
                                        <td>{{$invoice->show_company_1->ntn_number}}</td>
                                </tr>

                                @endif

                                @if(!$invoice->show_company_1->strn_number && $invoice->show_company_1->ntn_number)
                                <tr> 
                                        <th width="35%" align="start">NTN No:</th>
                                        <td>{{$invoice->show_company_1->ntn_number}}</td>                                      
                                </tr>

                                @endif


                                @if(!$invoice->show_company_1->strn_number && !$invoice->show_company_1->ntn_number)
                                <tr>
                                    <th width="35%" align="start">CNIC Number : </th>
                                    <td>{{$invoice->show_company_1->cnic_number}}</td>
                                </tr>
                                @endif

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
                                    <td>{{$invoice->sellerUser->phone_number}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Cnic No: </th>
                                    <td>{{$invoice->show_company_1->cnic_number}}</td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                    <tr class="">
                        <td colspan="2">


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

                                @php 
                                    $i = 0; 
                                    $gross_invoice_amount = 0;
                                @endphp
                                @foreach($order_item as $item)

                                @php 
                                    $i = 0; 
                                    $gross_invoice_amount = 0;
                                @endphp

                                


                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>------</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->skucode_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>-------</td>
                                    <td>-------</td>
                                    <td>-------</td>
                                    <td>{{$item->acutal_price}}</td>

                                </tr>
                                @endforeach


                            </table>

                        </td>
                    </tr>

                </thead>
            </table>

         
            <table style="border: 1px solid;border-spacing: 0;">
                <tr>
                    <td style="width:60%;background:;padding:30px; border: 1px solid;">
                        <span style="display: block;">Note:</span>
                        <span style="display: block;padding: 15px;">The Company charges FED (Under Sales Tax mode).
                            Therefore
                            there will
                            no
                            sales tax withholding</span>
                        <span style="display: block;padding: 15px;">Exempt From Deduction of Tax U/S 153 Copy of
                            Exemption
                            Certificate
                            Enclosed.</span>
                        <span style="display: block;padding: 15px;">Exempt From Deduction of Tax U/S 153 Copy of
                            Exemption
                            Certificate
                            Enclosed.</span>
                    </td>

                   

                    <td>
                        <table style="font-size:12px">
                            <tr>
                                <td style="width:50%; text-align:right; padding:10px; border:1px solid;">Total Payment :</td>
                                <td style=" text-align:right; padding-right:10px; padding-left:10px; border:1px solid;">RS {{number_format($total_sum_price)}}</td>
                                
                            </tr>
                            <tr>
                                <td style="width:50%; text-align:right; padding:10px; border:1px solid;">Sales Tax :</td>
                                <td style="width:50%; text-align:right; padding-right:10px; padding-left:10px; border:1px solid;">10%</td>
                                
                            </tr>
                            <tr>
                                <td style="width:50%; text-align:right; padding:10px; border:1px solid;">Actual Price :</td>
                                <td style="width:50%; text-align:right; padding-right:10px; padding-left:10px; border:1px solid;">RS {{number_format($total_actual_sum_price)}}</td>
                                
                            </tr>

                            <tr>
                                <td style="width:50%; text-align:right; padding:10px; border:1px solid;">Discount Price : </td>
                                <td style="width:50%; text-align:right; padding-right:10px; padding-left:10px; border:1px solid;">RS {{number_format($total_sum_price)}}</td>
                                
                            </tr>
                            <tr>
                                <td style="width:50%; text-align:right; padding:10px; border:1px solid;">Discount</td>
                                <td style="width:50%; text-align:right; padding-right:10px; padding-left:10px; border:1px solid;">RS {{number_format($discount)}}</td>
                                
                            </tr>
                            <tr>
                                <td style="width:50%; text-align:right; padding:10px; border:1px solid;">Total Price With GST</td>
                                <td style="width:50%; text-align:right; padding-right:10px; padding-left:10px; border:1px solid;">RS {{number_format($total_sum_price)}}</td>
                                
                            </tr>
                        </table>
                    </td>

                   
                </tr>
            </table>

        </div>

    </div>
</body>

</html>