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
        grid-template-columns: 1fr 35vw 1fr;
    }

    .action-grid {}



    .delete-hover:hover {
        cursor: pointer;
    }

</style>
@endpush

@section('content')

<nav class="page-breadcrumb rights-nav">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Allocated Prescription</a></li>
        <li class="breadcrumb-item active" aria-current="page">Prescriptions</li>
    </ol>

    <div class="flex-initial"></div>

    <div>
        <a href="{{route('prescriptions.create')}}"><button type="button" class="btn btn-primary mb-1 mb-md-0"
                style="width: 100%">Add Prescription</button></a>

    </div>
</nav>

@if (session('status'))
<div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill" /></svg>
    <p class="text-success">
        {{ session('status') }}
    </p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Prescription Table</h6>
                {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official
                        DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Pending</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Dispensed</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">Out-Patient</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="m-2">
                            <div class="table-responsive">

                                <table id="dataTableExample" class="table table-striped table-bordered"
                                    data-sorting="false">
                                    <thead style="">
                                        <tr>
                                            <th>#</th>
                                            <th>Patient Number</th>
                                            <th>Patient Name</th>
                                            <th>Prescription Date</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $number = 1; ?>
                                        @foreach ($prescriptions as $prescription)
                                        @if ($prescription->status === 'pending')
                                        <tr>
                                            <td>
                                                {{ $number }}
                                            </td>
                                            <?php $number++; ?>
                                            <td>{{ $prescription->patient_number }}</td>
                                            <td>{{ $prescription->patient_name }}</td>
                                            <td>{{ $prescription->prescription_date }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="d-flex">
                                                        <div style="padding-right:5px;">
                                                            <a href="{{ url('prescriptions/' .$prescription->id . '/edit') }}"
                                                                class="btn btn-sm btn-success mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-pen"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                                </svg>
                                                            </a>
                                                        </div>

                                                        {{-- DISABLE MANUFACTURER --}}

                                                        <div style="padding-right:5px;">
                                                            <div class="row">
                                                                <div class="d-flex">
                                                                    <a href="{{ url('prescriptions/' .$prescription->id ) }}"
                                                                        class="btn btn-sm btn-warning mr-3"
                                                                        style="margin-right:5px;">

                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16" fill="currentColor"
                                                                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                            <path
                                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                        </svg>
                                                                    </a>

                                                                    <div class="status-form">
                                                                        <a class="btn btn-sm btn-primary" href="{{ route('posTest' , $prescription->id) }}">Dispense</a>
                                                                    </div>

                                                                    {{-- <div class="status-form">
                                                                        <form
                                                                            action="{{ url('prescriptions/'.$prescription->id.'/dispense') }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <input type="text" hidden name="status"
                                                                                value="1">
                                                                            <button type="submit"
                                                                                class="btn btn-sm btn-primary openBtn">
                                                                                Pending
                                                                            </button>
                                                                        </form>
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- END DISABLE MANUFACTURER --}}

                                                        <form action="{{ url('prescriptions/'.$prescription->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                    <path fill-rule="evenodd"
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="m-2">
                            <div class="table-responsive">

                                <table id="dataTableExample" class="table table-striped table-bordered"
                                    data-sorting="false">
                                    <thead style="">
                                        <tr>
                                            <th>#</th>
                                            <th>Patient Number</th>
                                            <th>Patient Name</th>
                                            <th>Prescription Date</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $number = 1; ?>
                                        @foreach ($prescriptions as $prescription)
                                        @if ($prescription->status === 'inhouse')
                                        <tr>
                                            <td>
                                                {{ $number }}
                                            </td>
                                            <?php $number++; ?>
                                            <td>{{ $prescription->patient_number }}</td>
                                            <td>{{ $prescription->patient_name }}</td>
                                            <td>{{ $prescription->prescription_date }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="d-flex">
                                                        

                                                        {{-- DISABLE MANUFACTURER --}}

                                                        <div style="padding-right:5px;">
                                                            <div class="row">
                                                                <div class="d-flex">
                                                                    <a href="{{ url('prescriptions/' .$prescription->id ) }}"
                                                                        class="btn btn-sm btn-warning mr-3"
                                                                        style="margin-right:5px;">

                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16" fill="currentColor"
                                                                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                            <path
                                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                        </svg>
                                                                    </a>

                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- END DISABLE MANUFACTURER --}}

                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="m-2">
                            <div class="table-responsive">

                                <table id="dataTableExample" class="table table-striped table-bordered"
                                    data-sorting="false">
                                    <thead style="">
                                        <tr>
                                            <th>#</th>
                                            <th>Patient Number</th>
                                            <th>Patient Name</th>
                                            <th>Prescription Date</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $number = 1; ?>
                                        @foreach ($prescriptions as $prescription)
                                        @if ($prescription->status === 'buy outside')
                                        <tr>
                                            <td>
                                                {{ $number }}
                                            </td>
                                            <?php $number++; ?>
                                            <td>{{ $prescription->patient_number }}</td>
                                            <td>{{ $prescription->patient_name }}</td>
                                            <td>{{ $prescription->prescription_date }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="d-flex">
                                                        

                                                        {{-- DISABLE MANUFACTURER --}}

                                                        <div style="padding-right:5px;">
                                                            <div class="row">
                                                                <div class="d-flex">
                                                                    <a href="{{ url('prescriptions/' .$prescription->id ) }}"
                                                                        class="btn btn-sm btn-warning mr-3"
                                                                        style="margin-right:5px;">

                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16" fill="currentColor"
                                                                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                                            <path
                                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                                        </svg>
                                                                    </a>

                                                                   
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- END DISABLE MANUFACTURER --}}

                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
<script>
    $('.openBtn').on('click', function () {
        $('.modal-body').load('prescriptions/{id}/show', function () {
            $('#exampleModal').modal({
                show: true
            });
        });
    });

</script>
@endpush
