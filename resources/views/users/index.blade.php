@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <style>
    table {
        border-top-color: rgb(203 213 225);
        border-top-width: 2px;
        border-top-style: solid;

    }

    .rights-nav {
        display: grid;
        grid-template-columns: 1fr 55vw 1fr;
    }

    .action-grid {
        
        
    }

    .delete-hover:hover {
      cursor: pointer;
    }
  </style>
@endpush

@section('content')
<nav class="page-breadcrumb rights-nav">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Users Table</a></li>
  </ol>
  <div class="flex-initial"></div>
  <div>          
    <a href="{{route('users.create')}}"><button type="button" class="btn btn-primary" style="width: 100%">Add A New User <span style="position: relative; top:2px; left: 2px"><ion-icon name="add-circle-outline"></ion-icon></span></button></a>
  </div>
</nav>

<div class="alert alert-success" role="alert" id="success-al">
  Record was deleted
</div>

<div class="alert alert-danger" role="alert" id="danger">
  Sytem error: please try again
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">           
          <table id="dataTableExample" class="table table-striped table-bordered">
            <thead style="">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Employee No</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Facility</th>
                <th>Phone No</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="rights-tbody">
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  
  <script defer>

    $('#success-al').hide();

    $('#danger').hide();

    var responses = [];

    function getData() {

      $.ajax({
        type: "GET",

        url: "{{ route('user_data') }}",

        processData: false,

        contentType: false,

        cache: false,
                
        error: function (err) {

            console.log(err);

        },

        success: function (response) {

          console.log(response);

            responses = [];

            responses = response;

            console.log(responses.length);



            if (response) {

                var check =  document.getElementById("rights-tbody").childNodes.length;

                if (check > 0) {
                    const n = document.getElementById("rights-tbody");
                    n.innerHTML = '';
                }

                var count = 1;

                for (let i = 0; i < responses.length; i++) {
                    var icon = "<i data-feather='repeat'></i>";

                    var isFacilityNull = responses[i].facility_id;
                    
                    var facil = '';

                    if (isFacilityNull != null) {
                      facil = responses[i].facility_id;
                    }

                    var data = `
                        <tr>
                            <td>${count}</td>
                            <td>${responses[i].name}</td>
                            <td>${responses[i].employee_number}</td>
                            <td>${responses[i].designation}</td>
                            <td>${responses[i].role}</td>
                            <td>${facil}</td>
                            <td>${responses[i].phone_number}</td>
                            <td>${responses[i].email}</td>
                            <td style="display: flex; gap: 10px">                                
                                <a class="text-success" href="/users/${responses[i].id}/edit"><span>Edit</span></a>
                                <span class="text-danger delete-hover"  onClick="deletes(${responses[i].id})">Delete</span>
                            </td>
                        </tr>
                    `;
                    
                    $('#rights-tbody').append(data);

                    count++;
                  
                }

                

                $('#dataTableExample').DataTable({
                    "aLengthMenu": [
                        [10, 30, 50, -1],
                        [10, 30, 50, "All"]
                    ],
                    "iDisplayLength": 10,
                    "language": {
                        search: ""
                    }
                });

                $('#dataTableExample').each(function() {
                    var datatable = $(this);
                    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                    search_input.attr('placeholder', 'Search');
                    search_input.removeClass('form-control-sm');
                    // LENGTH - Inline-Form control
                    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                    length_sel.removeClass('form-control-sm');
                });
                
            }    
        }   
      });
    }

    getData();

    function deletes(id) {
     
      
          var data = new FormData;
          data.append('_token','{{ csrf_token() }}');
          data.append('_method','DELETE');
          data.append('user', id)


          $.ajax({
            type: "POST",
            url: `/users/${id}`,
            processData: false,
            contentType: false,
            cache: false,
            data: data,

            error: function (err) {

              $('#danger').show();

              console.log(err)
            },

            success: function (response) {

              console.log(response)
              
              if(response == 1) {

                $('#success-al').show();

                $('#dataTableExample').DataTable().destroy();

                getData();

                //setTimeout($('#success').hide(), 5500);

              } else {
                
                $('#danger').show();

                setTimeout($('#danger').hide(), 1500);

              }

            }

          });
       
    }
  </script>
@endpush