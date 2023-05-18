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
    .delete-hover:hover {
      cursor: pointer;
    }
    .show-modal:hover {
      cursor: pointer;
    }
  </style>
@endpush

@section('content')
<nav class="page-breadcrumb rights-nav">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="{{route('facility.index')}}">Facilities Table</a></li>
  </ol>
  <div class="flex-initial"></div>
  <div>     
    <a href="{{route('facility.create')}}"><button type="button" class="btn btn-primary" style="width: 100%">Add New Facility <span><ion-icon style="position: relative; top:2px; left: 2px" name="add-circle-outline"></ion-icon></span></button></a>
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
          <table id="dataTableExample" class="table table-striped table-bordered" data-sorting="false">
            <thead style="">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Level</th>
                <th>Address</th>
                <th>Email</th>
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


<div id="models">

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
        url: "{{ route('facility_data') }}",
        processData: false,
        contentType: false,
        cache: false,
                
        error: function (err) {
            console.log(err)
        },
        success: function (response) {
            responses = [];

            responses = response;

         
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
                            <td>${element.name}</td>
                            <td>${element.type}</td>
                            <td>${element.address}</td>
                            <td>${element.email}</td>
                  
                            <td style="display: flex; gap: 10px">
                                
                                <a class="text-success" href="/facility/${element.id}/edit"><span>Edit</span></a>
                                <a class="text-warning show-modal" data-bs-toggle="modal" data-bs-target="#facility_${element.id}"><span>Show</span></a>
                                <span class="text-danger delete-hover"  onClick="deletes(${element.id})">Delete</span>
                            </td>
                        </tr>
                    `;
                    
                      var modals = `
                        <!-- Modal -->
                        <div class="modal fade" id="facility_${element.id}" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-success" id="exampleModalLongTitle">${element.name} Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="table-responsive">
                                  <p class="mb-1"><span class="text-muted">CONTACT: </span> ${element.contact_num}</p>
                                  <p class="mb-1"><span class="text-muted">SUB COUNTY: </span> ${element.sub_county}</p>
                                  <p class="mb-1"><span class="text-muted">WARD: </span> ${element.ward}</p>
                                  <p class="mb-1"><span class="text-muted">LOCATION: </span> ${element.location}</p>

                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      `;
                    
                    $('#rights-tbody').append(data);
                    $('#models').append(modals);

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
            url: `/facility/${id}`,
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