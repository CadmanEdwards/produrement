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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="font-family: system-ui;">
    <h3 style="text-align: center;
    border: 1px solid white;
    border-radius: 10px;
    background-color: #00E676;
    color: white;">E-Procurement Invoice</h3>
    <table    style= "border: 2px solid #b8b8b8; width:100%;     font-size: 12px !important;">
    <tr>
    <td>
    <table style="">
    <tr><th >{{ucfirst($seller_data->name)}} And Company(Seller)</th></tr>
    <tr><th style="float:left;">E-mail:</th><th style="float:left;"><small>{{$seller_data->email}}</small></tr>
    <tr><th style="float:left;">Phone Number:</th><td style="float:left;"><small>{{$seller_data->phone_number}}</small></tr>
    <tr><th style="float:left;">Field Of Interest:</th><td style="float:left;"><small>
    <?php 
        $intrest = explode(',', $seller_data->field_of_interest);
        $intrest_data = DB::table('company_type')
              ->wherein('id',$intrest)
              ->get();
            ?>
     @foreach($intrest_data as $int)
        <p>
        {{$int->name}}
        </p>
        @endforeach
    </small></tr>
    </table>
    </td>
    <td>
    <table style="">
    <tr><th >{{ucfirst($show_company_2->company_name)}}(Buyer)</th></tr>
    <tr><th style="float:left;">Company Type:</th><td style="float:left;"><small>{{$show_company_2->comapny_type}}</small></td></tr>
    <tr><th style="float:left;">Comapny Status:</th><td style="float:left;"><small>{{$show_company_2->comapny}}</small></tr>
    <tr><th style="float:left;">CNIC Number:</th><td style="float:left;"><small>{{$show_company_2->cnic_number}}</small></tr>
    <tr><th style="float:left;">Registered Address:</th><td style="float:left;"><small>{{$show_company_2->registered_address}}</small></tr>
    <tr><th style="float:left;">Delivery Address:</th><td style="float:left;"><small>{{$show_company_2->delivery_address}}</small></table>
    </td>
    </tr>
    </table>
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
    <table style= "width: 100%;
    border: 1px solid #DFE1E5;
    margin-top: 5px;
    border-radius: 12px;
    background-color: #DFE1E5;">
    <tr>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Unit Price</th>
    <th>Sales Tax</th>
    <th>Total</th>
    </tr>
    <tr>
    <th>{{$item->product_name}}</th>
    <th>{{$item->quantity}}</th>
    <th>{{$item->skucode}}</th>
    <th>10%</th>
    <th>{{$total_price}}</th>

    </tr>
    </table>
    @endforeach
    <table>
    <tr>
    <table style="   width: 100%;
    border: 1px solid #DFE1E5;
    margin-top: 5px;
    border-radius: 12px;
    background-color: #DFE1E5;
    ">
    <tr>
    <th  style="float:right;">Total</th><td>RS {{$payment->total_payment}}</td></tr>
   <tr> <th style="float:right;">Tax Detection</th> <td>{{$payment->tax_detection}} %</td></tr>
    <tr><th style="float:right;">Adjustement Amount</th><td>RS {{$payment->adjustement_amount}}</td></tr>
   <tr> <th style="float:right;">Paid Amount</th><td>RS {{$payment->cheque_amount}}</td></tr>
   <tr> <th style="float:right;">Bank</th><td>{{$payment->bank}}</td>
   <tr> <th style="float:right;">Paid Amount</th><td>{{$payment->final_amount}}</td>
    </tr>
    </table>
    </tr>
    </table>
    
</body>
</html>