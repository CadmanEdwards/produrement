<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Challan</title>

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

    table.apr th {
        border: 2px solid;
        padding: 10px 0 40px;
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
                                style="font-weight: bold; font-size: 41px;">{{ucfirst($order->sellerUser->name)}} And Company(Seller)</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2"
                            style="font-weight: bold; font-size: 31px;text-align: center;border-bottom: 2px solid;">
                            Delevery Challan
                        </td>
                    </tr>
                    <tr style="font-weight: 700; font-size:18px;">
                        <td style="padding: 3px 10px;border-bottom: 2px solid;">Page # 1/2</td>
                        <td style="text-align: right;padding: 3px 50px;border-bottom: 2px solid;">Challan Date: <span
                                style="padding-left: 20px;">-------</span></td>
                    </tr>
                    <tr style="font-weight: 700; font-size:18px;">
                        <td colspan="2" style="text-align: right;padding: 3px 50px;">Challan Number: <span
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
                                    <td>{{ucfirst($order->show_company_2->company_name)}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Adress: </th>
                                    <td>{{$order->show_company_2->registered_address}}</td>
                                </tr>

                                @if($order->show_company_2->strn_number)
                                <tr> 
                                        <th width="35%" align="start">S.Tax Reg No :  </th>
                                        <td>{{$order->show_company_2->strn_number}}</td>
                                    
                                        <th align="{{$order->show_company_2->strn_number ? 'end' : 'start'}}">NTN No: </th>
                                        <td>{{$order->show_company_2->ntn_number}}</td>
                                </tr>

                                @endif

                                @if(!$order->show_company_2->strn_number && $order->show_company_2->ntn_number)
                                <tr> 
                                        <th width="35%" align="start">NTN No:</th>
                                        <td>{{$order->show_company_2->ntn_number}}</td>                                      
                                </tr>

                                @endif


                                @if(!$order->show_company_2->strn_number && !$order->show_company_2->ntn_number)
                                <tr>
                                    <th width="35%" align="start">CNIC Number : </th>
                                    <td>{{$order->show_company_2->cnic_number}}</td>
                                </tr>
                                @endif
    
                                <tr>
                                    <th width="35%" align="start">Po/Ref Number: </th>
                                    <td>-------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Ship to Part: </th>
                                    <td>-----</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Delivery Adress: </th>
                                    <td>{{$order->show_company_2->delivery_address}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Contact Person: </th>
                                    <td>{{$order->buyerUser->name}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Contact No: </th>
                                    <td>{{$order->buyerUser->phone_number}}</td>

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
                                    <td>{{ucfirst($order->show_company_1->company_name)}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Adress: </th>
                                    <td>{{$order->show_company_1->registered_address}}</td>
                                </tr>
                                @if($order->show_company_1->strn_number)
                                <tr> 
                                        <th width="35%" align="start">S.Tax Reg No :  </th>
                                        <td>{{$order->show_company_1->strn_number}}</td>
                                    
                                        <th align="{{$show_company_1->strn_number ? 'end' : 'start'}}">NTN No: </th>
                                        <td>{{$order->show_company_1->ntn_number}}</td>
                                </tr>

                                @endif

                                @if(!$order->show_company_1->strn_number && $order->show_company_1->ntn_number)
                                <tr> 
                                        <th width="35%" align="start">NTN No:</th>
                                        <td>{{$order->show_company_1->ntn_number}}</td>                                      
                                </tr>

                                @endif


                                @if(!$order->show_company_1->strn_number && !$order->show_company_1->ntn_number)
                                <tr>
                                    <th width="35%" align="start">CNIC Number : </th>
                                    <td>{{$order->show_company_1->cnic_number}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th width="35%" align="start">Sales Order: </th>
                                    <td>------</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Sales: </th>

                                    <td>{{$order->show_company_1->registered_address}} , Karachi, South</td>

                                </tr>
                                <tr>
                                    <th width="35%" align="start">Mobile No: </th>
                                    <td>{{$order->sellerUser->name}}</td>
                                </tr>
                                <tr>
                                    <th width="35%" align="start">Cnic No: </th>
                                    <td>{{$order->sellerUser->phone_number}}</td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2">
                       
                            <table class="dec" width="100%" cellspacing=0>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Item Description</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Remarks</th>
                                </tr>
                                @php $i = 0; @endphp
                                @foreach($order_item as $item)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->skucode}}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </table>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="apr" width="100%" cellspacing=0>
                                <tr>
                                    <th>Prepared By:</th>
                                    <th>Checked By:</th>
                                    <th>Approved By:</th>
                                    <th>Material Received By:</th>
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