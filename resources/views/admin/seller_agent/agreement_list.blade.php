@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
<div class="col-lg-10"></div>    
<div class="col-lg-2">
        <a class="btn btn-success btn-block" href="{{ route('sales/agent/agreement')}}" style="color:#fff; background: #01cc84;">
            Add New
        </a>
    </div>
</div>
<h3 style="margin-left: 5px;">Sales agreement list</h3>
<div class="row">

    <?php
        $agent = DB::table('saller_agent')->where('user_id' , auth()->user()->id)->first();
        $records  = DB:: table('agent_seller_agreement')
        ->select('c.company_name','c.organization_name' , 'agent_seller_agreement.*')
        ->join('comapny as c', 'c.id', '=', 'agent_seller_agreement.buyer_id')
        ->where('agent_seller_agreement.agent_id',$agent->agent_id)
        ->get();
    ?>
    @if(count($records) > 0)
        @foreach($records as $record)               
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body" style="padding: 5px;">
                        <h3>{{ ($record->company_name != "" ? ucfirst($record->company_name) : ucfirst($record->organization_name))}}</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p style="margin-bottom: 3px;"><b>Discount Applied on:</b> {{ ucfirst(str_replace('_'," ", $record->discount_applied_on))}}</p>
                                <p style="margin-bottom: 3px;"><b>Discount:</b> {{$record->discount}}%</p>
                                <p style="margin-bottom: 3px;"><b>Agreement Id:</b> {{$record->unique_id}}</p>
                            </div>

                            <div class="col-md-6">

                                <p style="margin-bottom: 3px;"><b>Products:</b>

                                <?php 
                                $products  = explode(',',$record->items);

                                foreach ($products as $key => $pro) {
                                    if($pro != "")
                                    {
                                        $product = DB::table('product')->where('id' , $pro)->first();
                                        echo $product -> name.', ';

                                    }
                                    
                                } ?>
                               </p>                              
                            </div>                                                         
                        </div>                        
                    </div>
                    <div class="card-header text-center">                      
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-md-6">
                <div class="alert alert-danger">No record(s) available</div> 
            </div>
        @endif            
</div>
@endsection
@section('scripts')
@parent

@endsection