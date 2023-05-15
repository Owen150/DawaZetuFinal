@extends('layouts.app')

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-offset-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        {{ $prescription->patient_name }}
                                    </h5>
                                    <p class="title-description text-muted">Prescription Details</p>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table " id="myTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $number = 1; ?>
                                            @foreach ($prescription_details as $prescription_detail)
                                            <tr>
                                                <td>
                                                    {{ $number }}
                                                </td>
                                                <?php $number++; ?>
                                                <td>
                                                    @foreach ($products as $product)
                                                    @if ($prescription_detail->product == $product->id)
                                                    {{ $product->product_name }}
                
                                                    <p hidden>
                                                        {{ $product->strength }}
                                                    </p>
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ $prescription_detail->quantity }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8 col-offset-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ $prescription->patient_name }}
                    </h5>
                    <p class="title-description text-muted">Prescription Details</p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table " id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 1; ?>
                            @foreach ($prescription_details as $prescription_detail)
                            <tr>
                                <td>
                                    {{ $number }}
                                </td>
                                <?php $number++; ?>
                                <td>
                                    @foreach ($products as $product)
                                        @if ($prescription_detail->product == $product->id)
                                            {{ $product->product_name }}

                                        <p hidden>
                                            {{ $product->strength }}
                                        </p>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $prescription_detail->quantity }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
