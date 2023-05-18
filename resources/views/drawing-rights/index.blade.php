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
    grid-template-columns: 1fr 1fr;
    }
    .cancel{
    display: flex;
    flex-direction: row-reverse;
   }
    .action-grid {
        
        
    }

    table i {
        background: red;
    }

    .delete-hover:hover {
      cursor: pointer;
    }

  </style>
@endpush

@section('content')
<nav class="page-breadcrumb rights-nav">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="#">Drawing Rights Table</a></li>   
  </ol>
  <div class="cancel">
    <div></div>    
      <a href="{{route('drawing-rights.create')}}" class="btn btn-primary mb-md-0">Add New Drawing Rights <span style="position: relative; top:2px; left: 2px"><ion-icon name="add-circle-outline"></ion-icon></span></a>
  </div>
</nav>

@if (Session::has('success'))
    <div class="alert alert-success" role="alert" >
        {{Session::get('success')}}
    </div> 
@endif

@if (Session::has('unsuccess'))
    <div class="alert alert-danger" role="alert" >
        {{Session::get('unsuccess')}}
    </div> 
@endif

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">        
        <div class="table-responsive">  
          <table id="dataTableExample" class="table table-striped table-bordered" data-sorting="false">
            <thead style="">
              <tr>
                <th>#</th>
                <th>Facility</th>
                <th>Financial Year</th>
                <th>Workload</th>
                <th>Period</th>
                <th>Allocated Amount</th>
                <th>Amt Used</th>
                <th>End Date</th>
                <th>Actions</th>
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
  
  <script >

    $('#success-al').hide();
    $('#danger').hide();

    var responses = [];

    function getData() {
      $.ajax({
        type: "GET",
        url: "{{ route('rights_data') }}",
        processData: false,
        contentType: false,
        cache: false,
                
        error: function (err) {
            console.log(err)
        },
        success: function (response) {
            responses = [];

            responses = response;

            console.log(responses);
            if (response) {
                var check =  document.getElementById("rights-tbody").childNodes.length;
                if (check > 0) {
                      const myNode = document.getElementById("rights-tbody");
                      myNode.innerHTML = '';
                }
                var count = 1;
                responses.forEach(element => {
                    var icon = "<i data-feather='repeat'></i>";
                    var data = `
                    
                        <tr>
                            <td>${count}</td>
                            <td>${element.facility_id}</td>
                            <td>${element.finacial_year_id}</td>
                            <td>${element.workload}</td>
                            <td>${element.period}</td>
                            <td>${element.amount}</td>
                            <td>${element.used_amount}</td>
                            <td>${element.end_date}</td>
                            <td style="display: flex; gap: 10px">
                                
                                <a class="text-success" href="/drawing-rights/${element.id}/edit"><span>Edit</span></a>
                                <span class="text-danger delete-hover"  onClick="deletes(${element.id})">Delete</span>
                            </td>
                        </tr>
                    `;
                    
                  
                    
                    $('#rights-tbody').append(data);

                    count++;
                });

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
      data.append('right', id)


      $.ajax({
            type: "POST",
            url: `/drawing-rights/${id}`,
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