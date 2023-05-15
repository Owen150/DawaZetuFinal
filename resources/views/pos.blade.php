<!--
Template Name: NobleUI - Laravel Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_laravel
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html>
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web">

  <title>NobleUI - Laravel Admin Dashboard Template</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/f34b8c32fc.js" crossorigin="anonymous"></script>
  <!-- End fonts -->
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- end plugin css -->

  

  <!-- common css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
 

  <script src="https://kit.fontawesome.com/1d1bb0c2f2.js" crossorigin="anonymous"></script>
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
  <style>
    body {
        background: #e5e7eb !important;
        overflow-x: hidden;
    }
    .product-catalogue {
        height: 70vh;
        overflow-y: scroll;
        overflow-x: hidden;
        padding: 10px;
    }
    .product-panel {
        border-radius: 0.25rem;
    }

 
    
    thead {
            background-color: rgb(147 51 234) !important;
            
            
        }
    thead tr th {
        color: black !important;
    }
    td {
        margin: 0 !important;
        padding: 2px !important;
    }
 
    #input  {
            outline: none !important;
            border: none !important;
            border: 1px solid #e5e7eb !important;
            height: 36px !important;
            
            
            border-radius: 0.25rem;
            padding-left: 10px !important;
            color: rgb(68, 68, 68);
        }
    .patient-input-div {
        display: grid;
        grid-template-columns: 75% 1fr;

    }
    .patient-input {
        border-radius: unset;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
        outline: none;
        border: 1px solid rgb(203 213 225);
        height: 37px;
        padding-left: 5px;
    }

    .icon-add-span {
        border-top-right-radius: 0.25rem; 
        border-bottom-right-radius: 0.25rem; 
        position: relative;
        top: 1.5px;
    }

    .icon-add-span:hover {
        cursor: pointer;
    }

    .icon-add {
        position: relative;
        top: 2px;
        color: #fff;
    }

    footer {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
  </style>
</head>
<body>



<div class="row" style="padding: 20px">
    
    <div class="col-md-4">

        <!-- top search bar -->
        <div class="search-bar mb-3">
            <div class="row">
                <div class="col-md-6">
                    <select name="product" class="js-example-basic-single form-select" data-width="100%">
                        <option value="">Select Medicine</option>
                </select>
                </div>
                <div class="col-md-6">
                    <input type="text" name="" id="" class="form-control" placeholder="Search...">
                </div>
            </div>
        </div>

        <!-- product catalogue -->
        <div class="product-catalogue">
            <div class="row">
                <!--- col for each product --->
                <div class="col-md-4 mb-2">
                    <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                        <div class="item-image position-relative overflow-hidden">
                            <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="panel-footer border-0 bg-white p-3">
                            <h6 class="item-details-title">Napa(500)</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-2">
                    <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                        <div class="item-image position-relative overflow-hidden">
                            <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="panel-footer border-0 bg-white p-3">
                            <h6 class="item-details-title">Napa(500)</h6>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 mb-2">
                    <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                        <div class="item-image position-relative overflow-hidden">
                            <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="panel-footer border-0 bg-white p-3">
                            <h6 class="item-details-title">Napa(500)</h6>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 mb-2">
                    <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                        <div class="item-image position-relative overflow-hidden">
                            <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="panel-footer border-0 bg-white p-3">
                            <h6 class="item-details-title">Napa(500)</h6>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 mb-2">
                    <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                        <div class="item-image position-relative overflow-hidden">
                            <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="panel-footer border-0 bg-white p-3">
                            <h6 class="item-details-title">Napa(500)</h6>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 mb-2">
                    <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                        <div class="item-image position-relative overflow-hidden">
                            <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="panel-footer border-0 bg-white p-3">
                            <h6 class="item-details-title">Napa(500)</h6>
                        </div>
                    </div>
                </div>


                <div class="col-md-4 mb-2">
                    <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                        <div class="item-image position-relative overflow-hidden">
                            <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="panel-footer border-0 bg-white p-3">
                            <h6 class="item-details-title">Napa(500)</h6>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>

    <div class="col-md-8" style="background: #fff;border-radius:0.25rem">
        <!-- patient input -->
        <div class="p-2 patient-input-div">
            <div></div>
            <div>
                <input data-bs-toggle="modal" data-bs-target="#exampleModalCenter" placeholder="Patient Name" class="patient-input" type="text" name="" id=""><span class="icon-add-span bg-success" style="width: 10px;padding:7.5px; font-size: 18px;"><ion-icon data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="icon-add" name="add-circle-outline"></ion-icon></span>
            </div>
        </div>
        <hr>
        <div class="container-fluid mt-2 d-flex justify-content-center w-100">
            <div class="table-responsive w-100">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th class="text-end">Batch</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Qty</th>
                        <th class="text-end">Total</th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody class="mb-3">
                    <tr class="">
                      <td class="text-start">1</td>
                      <td class="text-start">
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:150px">
                      </td>
                      <td >
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:100px">
                      </td>
                      <td>
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:80px">
                      </td>
                      <td>
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:80px">
                      </td>
                      <td>
                        <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:100px">
                      </td>
                      <td class="p-1">
                        <div  style="width: 20px;background: #fca5a5; border-radius:0.15rem; border: 0.7px solid #ef4444; " class="text-center"><i class="fa-solid fa-trash-can" style="color: #ef4444; font-size: 10px; "></i></div>
                      </td>
                    </tr>
                    
                    <tr class="">
                        <td class="text-start">1</td>
                        <td class="text-start">
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:150px">
                        </td>
                        <td >
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:100px">
                        </td>
                        <td>
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:80px">
                        </td>
                        <td>
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:80px">
                        </td>
                        <td>
                          <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" style="width:100px">
                        </td>
                        <td class="p-1">
                            <div  style="width: 20px;background: #fca5a5; border-radius:0.15rem; border: 0.7px solid #ef4444; " class="text-center"><i class="fa-solid fa-trash-can" style="color: #ef4444; font-size: 10px; "></i></div>
                          </td>
                      </tr>
                  </tbody>
                </table>
              </div>
          </div>
          <div class="container-fluid mt-5 w-100">
            <div class="row">
              <div class="col-md-6 ms-auto">
                  <div class="table-responsive">
                    <table class="table">
                        <tbody>
                         
                          <tr class="bg-white" style="border-radius: 0.25rem;">
                            <td class="text-bold-800">Total</td>
                            <td class="text-bold-800 text-end">$ 12,000.00</td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
    </div>
</div>
<footer class="bg-white text-center" style="position: fixed; bottom:0;width:100%; padding: 5px;">
    <div style="display: flex;">
        <p  style="position: relative; top: 8px; font-size: 18px; font-weight:500">Total:</p>
        <p style="position: relative; top: 8px; font-size: 18px; font-weight:800">10000000</p>
        
    </div>
    <div style="text-align: end">
        
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#mpesa">Mpesa</button>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cash">Cash</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bank">Bank</button>
        <button class="btn btn-danger">Exit <ion-icon style="position:relative;top: 2px; margin-left: 5px; font-size:16px" name="exit-outline"></ion-icon></button>
    </div>
</footer>


<!-- Modal patient records -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-md-12 mb-2">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" class="form-control" name="name" type="text" autocomplete="off" required placeholder="Patient name">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" name="email" type="email" autocomplete="off" required placeholder="patient@mail.com">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input id="phone_number" class="form-control" name="phone_number" type="text" autocomplete="off" required placeholder="+254700000000">
                </div>
                <div class="col-md-12 mb-2">
                    <label for="address" class="form-label">Address</label>
                    <input id="address" class="form-control" name="address" type="text" autocomplete="off" required placeholder="Enter Address">
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Patient</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Mpesa Payment -->
<div class="modal fade" id="mpesa" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Mpesa Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-md-12 mb-2">
                    <label for="mpesa_amount" class="form-label">Amount Paid</label>
                    <input id="mpesa_amount" class="form-control" name="mpesa_amount" type="text" autocomplete="off" required placeholder="0.00">
                </div>
                
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Save Payment</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Cash Payment -->
<div class="modal fade" id="cash" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Cash Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-md-12 mb-2">
                    <label for="cash_amount" class="form-label">Amount Paid</label>
                    <input id="cash_amount" class="form-control" name="cash_amount" type="text" autocomplete="off" required placeholder="0.00">
                </div>
                
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-warning">Save Payment</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal Bank Payment -->
<div class="modal fade" id="bank" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Bank Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-md-12 mb-2">
                    <label for="bank_amount" class="form-label">Amount Paid</label>
                    <input id="bank_amount" class="form-control" name="bank_amount" type="text" autocomplete="off" required placeholder="0.00">
                </div>
                
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Payment</button>
        </div>
      </div>
    </div>
</div>

  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
 

    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script defer>
        $(document).ready(function(){
            var body = $('body');
            
            $('.sidebar-header .sidebar-toggler').toggleClass('active not-active');
      if (window.matchMedia('(min-width: 992px)').matches) {
        
        body.toggleClass('sidebar-folded');
      } else if (window.matchMedia('(max-width: 991px)').matches) {
       
        body.toggleClass('sidebar-open');
      }
    });
    </script>
    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- end base js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
</body>