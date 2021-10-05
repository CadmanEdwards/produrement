@extends('layouts.admin')
@section('content')

<style>
    .form-control{
        background: #F9FAFF;
    }
    input[type="file"]{
        display: none;
    }
    .material-icons{

        font-size: 90px;
        color:  #01CC84;;
    }
    span.material-icons {
        border: solid;
        border-color: white;
        border-radius: 10px;
        box-shadow: 5px 5px 2.5px #f2f2f2;
    }
    #output_image
    {
        max-width:80px;
        border-radius: 12px;
        border: 1px solid #ccc;
        margin: 4px;
    }
    #map {
      height: 100%;
  }
  @media (min-width: 768px)
  {
    .col-md-6 {
        padding:11px;

    }
    .col-md-4{
        padding:11px;
    }
}
</style>
<div class="container" style="border:1px solid #ccc;   border-radius: 9px;">

   <div class="container" >
      <h4 style="padding: 14px;">Edit Sales Agent</h4>
  </div>
  <form action="{{route('seller/agent/edit/submit')}}" method="POST" enctype="multipart/form-data" enctype="multipart/form-data">
    @csrf
    <div class="row" >
        <div class="col-md-6">
            <label for="email">Agent Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
        </div>
        <div class="col-md-6">          
            <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
            @if($errors->has('email'))
            <em class="invalid-feedback">
                {{ $errors->first('email') }}
            </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.user.fields.email_helper') }}
            </p>
        </div>
    </div>   
    <div class="row">
         <div class="col-md-6">      
            <div >
                <input type="file" class="form-control"  name="image" id="file" accept="image/*"  onchange="show_image();" />
                <label for="file"> <span class="material-icons" style="font-size: 47px;">add_circle_outline</span></label>
                <span id="image_preview">
                  @if($user -> display_image != "")
                  <img id='output_image' src="{{url( 'profile_image/'.$user -> display_image)}}">
                  @endif
                </span>
            </div>
        </div>
        <div class="col-md-6">
          <label for="phone_number">Phone Number*</label>
          <input type="number" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', isset($user) ? $user->phone_number : '') }}" required>
          @if($errors->has('phone_number'))
            <em class="invalid-feedback">
                {{ $errors->first('phone_number') }}
            </em>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
          <label for="asign_area">Assign Area</label>
          <input type="hidden" name="user_id"  value="{{$user->id}}">
          <input type="hidden" name="agent_id"  value="{{$user->agent_id}}">
          <input type="hidden" name="lat" id="lat" value="{{$user->assign_area_lat}}">
          <input type="hidden" name="lng" id="lng" value="{{$user->assign_area_long}}">
          <input type="text" id="area_assign" value="{{$user->area_assign}}" name="area_assign" style="left:0px !important;" class="form-control" required>
          <div style="height: 199px" id="map"></div>            

           @if($errors->has('area_assign'))
               <em class="invalid-feedback">
                    {{ $errors->first('area_assign') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.user.fields.password_helper') }}
            </p>
        </div>
        <div class="col-md-6">
           <label for="asign_area">Allow Discount Percentage</label>
           <input type="text" id="discount_percentage" value="{{$user->discount_percentage}}" name="discount_percentage" class="form-control" required>
           @if($errors->has('discount_percentage'))
               <em class="invalid-feedback">
                {{ $errors->first('discount_percentage') }}
            </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.user.fields.password_helper') }}
            </p>
            <?php
              $company_data = DB::table('comapny')
              ->distinct()
              ->select('comapny.*')
              ->join('relation as r','r.buyer_company_id','=','comapny.id')
              ->where('seller_id' , auth()->user()->id)
              ->whereNotIn('buyer_company_id', function ($query) use ($agent) {
                $query->select('company_id')
                  ->where('agent_id','!=',$agent->agent_id)
                  ->from('agent_assign_company');
              })                
              ->where('user_id','!=', auth()->user()->id)
              ->get();
            ?>
            <div class=" col-md-12" style="border-radius: 8px; border: 1px solid lightgrey;">
              <label for="">Assign Companies</label>
                <div>
                    @foreach($company_data as $company)
                    <div class="form-check">
                        <input <?= ((in_array($company->id, $company_assign ) ) ? 'checked' : null ) ?> class="form-check-input" name="assign_company[]" type="checkbox" value="{{$company->id}}" >
                        <label class="form-check-label" for="defaultCheck1">
                             {{ ($company->company_name != "" ? ucfirst($company->company_name) : ucfirst($company->organization_name))}} ({{$company->registered_address}})
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <hr>
    <input type="checkbox" name="change_password" id="change_password" value="1" onclick="$('.field-p').toggle('.dis')"> 
    <label for="change_password"><b>Check it to change password</b></label>
     <div class="row field-p" style="display: none">        
        <div class="col-md-6">
           <label for="password">{{ trans('cruds.user.fields.password') }}</label>
           <input type="password" id="password" name="password" class=" form-control">
           @if($errors->has('password'))
           <em class="invalid-feedback">
                {{ $errors->first('password') }}
            </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.user.fields.password_helper') }}
            </p>
        </div>
        <div class="col-md-6">
           <label for="password">Confirm Pasword</label>
           <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
           @if($errors->has('password'))
               <em class="invalid-feedback">
                    {{ $errors->first('password_confirmation') }}
                </em>
            @endif
            <p class="helper-block">
                {{ trans('cruds.user.fields.password_helper') }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="container" style="padding: 17px;">
           <input class="btn btn-danger" style="background: #01cc84; border: none; float: right;" type="submit" value="{{ trans('global.update') }}">   
       </div>
    </div>
</form>
</div>
<script>
   function show_image() 
  {
   var total_file=document.getElementById("file").files.length;
   for(var i=0;i<total_file;i++)
   {
    $('#image_preview').html("<img id='output_image' src='"+URL.createObjectURL(event.target.files[i])+"' >");
   }
  }
  function initialize() {
    var latlng = new google.maps.LatLng({{(($user->assign_area_lat ) ? $user->assign_area_lat : 24.9025 )}},{{ (($user->assign_area_long ) ? $user->assign_area_long : 67.0729 ) }});
        var map = new google.maps.Map(document.getElementById('map'), {
            center: latlng,
            zoom: 13
        });

        var marker = new google.maps.Marker({
          map: map,
          position: latlng,
          draggable: true,
          anchorPoint: new google.maps.Point(0, -29)
        });
        
        var input = document.getElementById('area_assign');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var geocoder = new google.maps.Geocoder();
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();   
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(13);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);          

            bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
            //infowindow.setContent(place.formatted_address);
            //infowindow.open(map, marker);

        });
        // this function will work on marker move event into map 
        google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {        
                      bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
                      infowindow.setContent(results[0].formatted_address);
                      infowindow.open(map, marker);
                  }
              }
          });
        });
    }

    function bindDataToForm(address,lat,lng){  
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCV6CzdZOR6juZIO3ckcmWbrIuloUavUc4&callback=initialize&libraries=places&v=weekly"></script>
@endsection