@extends('layouts.admin')
@section('content')
<?php
$category = DB::table('category')
            ->where('created_by',auth()->user()->id)
            ->get();
$sku_code = DB::table('sku_code')
            ->where('created_by',auth()->user()->id)
            ->get();

            $company = DB::table('comapny')
   ->where('id',Session::get('company_id'))
   ->first();
?>

<div class="row">
    <div class="col-md-12">
<div class="card">
    <div class="card-header">
        Edit Inventory
    </div>

    <div class="card-body">
        <form action="{{ route("inventory_edit_submit") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="name">Edit a Tittle*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$product->name}}" style="height: 32px;" required>
                <input type="hidden" name="inventory_id" value="{{$product->id}}">
            </div>
            <label for="name">Category*</label>
            
            <div class="input-group">
                <select class="form-control" name="category" id="category" style="height: 32px;" required>
                <option>-Select-</option>
                @foreach($category as $c)
                <?php $selected = ($c->id == $product->category_id) ? 'selected' : ''; ?>
                <option value="{{$c->id}}" {{$selected}}>{{$c->name}}</option>
                @endforeach
                </select>
                <div class="input-group-append">
                   <span class="input-group-text open_modal" style="height: 32px; color:#01cc84;"><i class="fas fa-plus"></i></span>
                </div>
                </div>
                <br>
            <div class="form-group">
                <label for="image">Select Images*</label>
                <input type="file" class="form-control" name="image[]" id="image" style="height: 32px;" multiple="multiple">
              <br/>
             <?php
             $image = explode(',', $product->images);
             ?>
             @foreach($image as $images)
             <img src="{{url('product_images').'/'.$images}}" style="width: 100px;">
             @endforeach
            </div>
            @if($company->comapny == "registered")
            <div class="form-group">
                <label for="gst">GST Tax*</label>
                <input type="number" id="gst" name="gst" class="form-control" value="{{$product->gst}}" style="height: 32px;" required>
                <small>GST in Percentage</small>
            </div>
            @endif
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="price">Actual Price*</label>
                <input type="number" id="price" name="price" class="form-control" style="height: 32px;" value="{{$product->acutal_price}}" required>
                
            </div>
            <div class="form-group">
                <label for="discount_price">Discount Price*</label>
                <input type="number" class="form-control" name="discount_price" style="height: 32px;" value="{{$product->discount_price}}" id="discount_price" required>
            </div>
            <label for="name">SKU Code*</label>
            
            <div class="input-group">
                <select class="form-control" name="sku_code" id="sku_code" style="height: 32px;" required="required">
                <option value="">-Select-</option>
                @foreach($sku_code as $s)
                <?php $selected_2 = ($s->id == $product->skucode) ? 'selected' : ''; ?>
                <option value="{{$s->id}}" {{$selected_2}}>{{$s->name}}</option>
                @endforeach
                </select>
                <div class="input-group-append">
                   <span class="input-group-text open_modal_2" style="height: 32px; color:#01cc84;"><i class="fas fa-plus"></i></span>
                </div>
            </div>
            
            </div>
            <div class="col-md-12">
            <div class="form-group">
                <label for="discription">Product Discription</label>
                <textarea class="form-control" id="discription" name="discription" rows="2" placeholder="Product Discription">{{$product->discription}}</textarea>
            </div>
            </div>
            </div>
            
            
            
            <div>
                <input class="btn btn-danger" style="background: #01cc84; border: none; float: right;" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route("category_add") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Add Category Name*</label>
                <input type="text" id="name" name="name" class="form-control" style="height: 32px;" required>
                
            </div>
           
            
            
            
            <div>
            
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input class="btn btn-danger" style="background: #01cc84; border: none; float: right;" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add SKU</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route("sku_add") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Add SKU Name*</label>
                <input type="text" id="name" name="name" class="form-control" style="height: 32px;" required>
                
            </div>
           
            
            
            
            <div>
            
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input class="btn btn-danger" style="background: #01cc84; border: none; float: right;" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection