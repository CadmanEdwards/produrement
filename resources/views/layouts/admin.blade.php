<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/plugins/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('theme/css/style.min.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<style>
.sidebar {
    background: #01cc84 !important;
}
.sidebar .nav-link .nav-icon {
    color: #fff !important;
}
.count_class{
    color: #000;
    padding: 2px 6px;
    background: #fff;
    border-radius: 50%;
    font-weight: bold;
    position: absolute;
    right: 1px;
}
@media (min-width: 992px){

.sidebar-lg-show .app-header .navbar-brand {
    display: -ms-inline-flexbox;
    display: inline-flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 199px;
    height: 55px;
    padding: 0;
    margin-right: 0;
    background: #01cc84;
}
.app-header .navbar-brand    {display: none;}
}
.navbar {
    padding: 0;
}

.btn-primary{
 background: #01cc84;
 border: none;
}
.btn-default{
 background: #01cc84;
 border: none;
}
.btn-danger{
  background: #01cc84;
  border: none;
}
.btn-info{
  background: #01cc84 !important;
  border: none;
}
.badge-info {
    color: #fff;
    background-color: #01cc84;
}
.btn-danger:hover {
    background: green;
    border: none;
}
.label-info{
  background-color: #01cc84;
}
.btn-info:hover {
    color: #fff;
    background-color: green;
    border-color: #009efb;
}
.sidebar .nav-link:hover {
    color: #fff;
    background: #1a966a;
}
.panel_custome_design{
  margin-top: 5px; 
  width: 30%; 
  padding:10px; 
  border:1px solid #ccc; 
  border-radius: 10px; 
  position: absolute; 
  left: 239px; 
  top: 0; 
  background:#fff;
  z-index: 999999;
}

@media (max-width: 991.98px){
.panel_custome_design {
    margin-top: 5px;
    width: 37%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
    position: absolute;
    left: 36px;
    top: 0;
    z-index: 999999;
    background: #fff;
}
}
.card{
  box-shadow: none !important;
}
.full_width_background{
    width: 100%;
    height: 100%;
    background: #000000ad;
    position: fixed;
    display: none;
    z-index: 99999;
}
.modal-open .modal {
    z-index: 9999999 !important;
    background: #0000006b !important;
}
.nav-tabs .nav-item{
  margin-bottom: 10px !important;
}
</style>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
<?php 

      // dd(Session::get('company_id'));

       $company_data = DB::table('comapny')
            ->where('user_id',auth()->user()->id)
            ->get();
        if($company_data->count() > 0){

          $show_company = DB::table('comapny')
                  ->where('user_id',auth()->user()->id)
                  ->where('id',Session::get('company_id'))
                  ->first();
                  
                  ?>
        @can('company')
        
         <div class="panel-group panel_custome_design" id="accordion">
          
            <div class="panel panel-default">
              <div class="panel-heading">
              
                <h4 class="panel-title" style="margin: 0;">
                @if($show_company->comapny ?? '' == "registered")
                  <p style="font-size: 10px; margin:0px;"><a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="collapsed" aria-expanded="false" style="color: #000;">Company Name: {{$show_company->company_name}}<i class="fa fa-caret-down" aria-hidden="true" style="float: right; color: #01cc84;font-size: 19px;"></i></a></p>
                  <p style="font-size: 10px; margin:0px;">Company: {{$show_company->comapny}}</p>
                  <p style="font-size: 10px; margin:0px;">Company Type: {{$show_company->comapny_type}}</p>
                @else
                <p style="font-size: 10px; margin:0px;"><a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="collapsed" aria-expanded="false" style="color: #000;">Company Name: {{$show_company->organization_name ?? ''}}<i class="fa fa-caret-down" aria-hidden="true" style="float: right; color: #01cc84;font-size: 19px;"></i></a></p>
                  <p style="font-size: 10px; margin:0px;">Company: {{$show_company->comapny ?? ''}}</p>
                  <p style="font-size: 10px; margin:0px;">Company Type: {{$show_company->comapny_type ?? ''}}</p>
                
                @endif
                </h4>
              </div>
              <div id="collapse3" class="panel-collapse collapse" aria-expanded="false">
                <div class="panel-body">
                @foreach($company_data as $company)
                <hr/>
                <div class="row">
                
                <div class="col-md-8">
                @if($company->comapny == "registered")
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company name: <span style="color: #828282;">{{$company->company_name}}</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company type: <span style="color: #828282;">{{$company->comapny}}</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Cell Number: <span style="color: #828282;">{{$company->landline_number}}</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Delivery Address: <span style="color: #828282;">{{$company->delivery_address}}</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">{{$company->registered_address}}</span></p>
                @else
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company name: <span style="color: #828282;">{{$company->organization_name}}</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Company type: <span style="color: #828282;">{{$company->comapny}}</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Cell Number: <span style="color: #828282;">{{$company->landline_number}}</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Delivery Address: <span style="color: #828282;">{{$company->delivery_address}}</span></p>
                <p style="color: #000; font-size: 10px; margin:0px; font-weight: bold;">Registered Address: <span style="color: #828282;">{{$company->registered_address}}</span></p>
                
                @endif
                </div>
                
                <div class="col-md-2 text-center">
                @if($company->comapny == "registered")
                <i class="fas fa-shield-alt" aria-hidden="true" style="font-size: 21px;color: #01cc84;"></i>
                @else
                <i class="fas fa-shield-alt" aria-hidden="true" style="font-size: 21px;"></i>
                @endif 
                </div>
                <div class="col-md-2 text-center">
                @if(Session::get('company_id') == $company->id)
                <i class="fa fa-check" aria-hidden="true" style="font-size: 21px;color: #01cc84;"></i>
                @else
                <i class="fa fa-check" onClick='addcompanyToSession( "<?= $company->id ?>" )' aria-hidden="true" style="font-size: 21px;"></i>
                @endif
                </div>
                </div>
                <hr/>
                @endforeach
                
                </div>
              </div>
            </div>
          </div>
        
        @endcan

        <?php }  ?>

    <header class="app-header navbar" style="border-bottom:0px;">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <span class="navbar-brand-full" style="color: #fff; font-weight: bold; font-size: 21px;">E-Procurement</span>
            <span class="navbar-brand-minimized">E-Procurement</span>
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <ul class="nav navbar-nav ml-auto">
        @can('company')
        <li class="nav-item">
                    <a href="{{route('company/edit_view',Session::get('company_id'))}}" class="nav-link"style="color: #01cc84; font-size: 19px;">
                    <i class="fa fa-pencil-square-o"></i>      
                    </a>
        <li>
        @endcan
        <li class="nav-item">
                    <a class="nav-link"style="color: #01cc84; font-size: 19px;">
                    
                    <i class="fa fa-bell"></i>      
                  </a>
        <li>
        <li class="nav-item">
                    <a class="nav-link"style="color: #01cc84; font-size: 19px;">
                    
                    <i class="fa fa-cart-plus"></i>      
                  </a>
        <li>
        
        <li class="nav-item">
                    <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" style="color: #01cc84; font-size: 19px; margin-right: 24px;">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>      
                  </a>
        <li>
      

        </ul>
    </header>

    <div class="app-body">
        @include('partials.menu')
        <main class="main">
        

            <div style="padding-top: 20px" class="container-fluid">
                @if(session('success') || session('danger') )
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-{{(session('danger') ? 'danger' : 'success')}}" role="alert">
                            {{ (session('danger') ? session('danger') : session('success')) }}</div>
                        </div>
                    </div>
                @endif
              
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @yield('content')

            </div>

            <!-- Modal -->
        <div class="modal fade" id="field_of_interest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Field Of intrest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{ route('seller/intrest/submite') }}">
                                    @csrf 
                    

                    <?php $company_cat = DB::table('company_type')
                          ->get();?>
                   @foreach($company_cat as $cat)
                   <div class="form-check custom-control custom-checkbox" style="font-size: 13px; line-height: 1.8em;">
                        <input type="checkbox" class="custom-control-input form-check-input" id="select{{$cat->id}}" name="intreset_id[]" value="{{$cat->id}}">
                        <label class="form-check-label custom-control-label" for="select{{$cat->id}}">{{$cat->name}}</label>
                    </div>
                   @endforeach
                       

                       <div class="form-group mb-0">
                           
                               <button type="submit" class="btn btn-success btn-block" style="background-color: #e4e4e4;color: #9e9e9e; border: none; height: 39px; margin-top:10px;">
                                   {{ __('Register Company') }}
                               </button>
                           
                       </div>
                       </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="popupmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body" style="text-align: center; padding: 65px; font-size: 18px;">
                Congratulations! Company add successfully
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <div class="full_width_background"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
    
$(".open_modal").click(function() {
  $('#exampleModal').modal('show')
});
$(".open_modal_2").click(function() {
  $('#exampleModal_2').modal('show')
});

$(".select_all_verify").click(function(){
      //alert("assad");
            $('input:checkbox').not(this).prop('checked', this.checked);
            $('.btn_enable_all_select').prop('disabled', false);
        });
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
  };


  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'copy',
        className: 'btn-default',
        text: copyButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'colvis',
        className: 'btn-default',
        text: colvisButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      }
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

function get_count_buyer_request() {
    $(".count_class").hide();
    $.ajax({
				type:    'post',
				url:     '{{route('count_buyer_request')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:11,
				},success: function (data) {
          console.log(data);
          if (data > 0)
         $('.count_class').html(data).show();
         //$('#company_append_modal_3').modal('show');
        },
				error: function () {
                
                }
            });
  }
  // get_count_buyer_request()

    </script>
    <!--Wave Effects -->
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="{{ asset('theme/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('theme/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('theme/js/pages/dashboards/dashboard1.js') }}"></script>
    <script src="{{ asset('theme/js/jquery.mask.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>

        $(document).ready(function(){
            $('#accordion').on('show.bs.collapse', function () {
             $('.full_width_background').css('display','block');
             $('.full_width_background').css('z-index','99999');
            });
            $('#accordion').on('hide.bs.collapse', function () {
             $('.full_width_background').css('display','none');
            });
          });

    new Morris.Donut({
  element: 'myfirstchart',
  data: [
    {label: "Friends", value: 30},
    {label: "Allies", value: 15},
    {label: "Enemies", value: 45},
    {label: "Neutral", value: 10}
  ]
});



function preview_image() 
            {
             var total_file=document.getElementById("file").files.length;
             for(var i=0;i<total_file;i++)
             {
              $('#image_preview').append("<img id='output_image' src='"+URL.createObjectURL(event.target.files[i])+"' >");
             }
            }

function addcompanyToSession(company_id){
 
  $.ajax({
				type:    'post',
				url:     '{{route('insert_session_id')}}',
        data:    {
        _token: "{{ csrf_token() }}",
        id:company_id,
				},success: function (data) {
          location.reload();
          alert("Your Company change Successfully"  + company_id)
          
        },
				error:function () {}
          });

          }

  function RequestSend(seller_id){
    //$('#company_request_pending').modal('show');
    $.ajax({
				type:    'post',
				url:     '{{route('show_modal_company')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:seller_id,
				},success: function (data) {
          $('.inner_data').append(data);
          $('#company_request_pending').modal('show');
        },
				error:   function () {
                
                }
            });
    $('#company_request_pending').on('hidden.bs.modal', function() {
      $('.inner_data').html("");
    });
  }

  function ShowCopmany(company_id){
       $.ajax({
				type:    'post',
				url:     '{{route('show_inner_modal_html_company')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:company_id,
				},success: function (data) {
          console.log(data);
         $('.inner_html_company_data').append(data);
         $('#company_append_modal').modal('show');
        },
				error: function () {
                
                }
            });

    $('#company_append_modal').on('hidden.bs.modal', function() {
        $('.inner_html_company_data').html("");
    });
    }

  function InsertRelationData(seller_id){
    $.ajax({
				type:    'post',
				url:     '{{route('insert_relation')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:seller_id,
				},success: function (data) {
        location.reload();
        alert("Your request send to seller")
        },
				error:   function () {
                
                }
            });
  }

  function ShowCopmanySeller(company_id){
       $.ajax({
				type:    'post',
				url:     '{{route('show_inner_modal_html_company_seller')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:company_id,
				},success: function (data) {
          console.log(data);
         $('.inner_html_company_data_2').append(data);
         $('#company_append_modal_2').modal('show');
        },
				error: function () {
                }
            });

      $('#company_append_modal_2').on('hidden.bs.modal', function() {
          $('.inner_html_company_data_2').html("");
      });
    }

    

    function ShowBuyerCompanyDetails(company_id){
      $.ajax({
				type:    'post',
				url:     '{{route('show_inner_modal_html_company_buyer')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:company_id,
				},success: function (data) {
          console.log(data);
         $('.inner_html_company_data_3').append(data);
         $('#company_append_modal_3').modal('show');
        },
				error: function () {
                
                }
            });

            $('#company_append_modal_3').on('hidden.bs.modal', function() {
            $('.inner_html_company_data_3').html("");
            });
    }

    
  

  function FieldOfInterest(){
    $('#field_of_interest').modal('show');
  }

  function BuyerRequestStatus(relation_id){
    $.ajax({
				type:    'post',
				url:     '{{route('status_update_realation')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:relation_id,
				},success: function (data) {
        location.reload();
        alert("Successfully accepted status")
        },
				error:   function () {
                
                }
            });
  }
  function BuyerRejectStatus(relation_id){
    $.ajax({
				type:    'post',
				url:     '{{route('status_reject_realation')}}',
				data:    {
					_token: "{{ csrf_token() }}",
                    id:relation_id,
				},success: function (data) {
        location.reload();
        alert("Successfully Rejected status")
        },
				error:   function () {
                
                }
            });
  }

  
  
    </script>

    
        @if(session('alert'))
            <script type="text/javascript">
                $(document).ready(function() {
                  $('#popupmodal').modal();
                });
                
            </script>
          @endif

    @yield('scripts')
</body>

</html>
