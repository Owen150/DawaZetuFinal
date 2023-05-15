@extends('layouts.app')

@section('content')

<div class="container">
    <form action="" method="">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="card-body">
                    <div class="table-responsive">
                        
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number = 1; ?>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="media d-flex">
                                                        <div class="align-self-center">
                                                            <div class="img-box">
                                                                <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg"
                                                                    class="rounded float-left" alt="...">

                                                            </div>
                                                        </div>
                                                        <div class="media-body text-right m-4">
                                                            <p class="text-bold">
                                                                Acetaminophen
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row d-flex">
                            <div class="col-sm-4">
                                <input data-bs-toggle="modal" data-bs-target="#exampleModalCenter"
                                    placeholder="Patient Name" class="patient-input form-control" type="text" name="" id="">
                                {{-- <span class="icon-add-span bg-success"
                                    style="width: 10px;padding:7.5px; font-size: 18px;"> --}}
                                <ion-icon data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="icon-add"
                                    name="add-circle-outline"></ion-icon>
                            </div>
                            </span>
    
                            <div class="col-sm-6">
                                <a onClick="emptyCart()" id="btnEmpty" class="btn btn-sm btn-danger">Empty Cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                       
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            {{-- <div class="col-sm-6"> --}}
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-sm btn-success m-2" data-bs-toggle="modal"
                                    data-bs-target="#mpesa">Mpesa</button>
                                <button class="btn btn-sm btn-warning m-2" data-bs-toggle="modal"
                                    data-bs-target="#cash">Cash</button>
                                <button class="btn btn-sm btn-primary m-2" data-bs-toggle="modal"
                                    data-bs-target="#bank">Bank</button>
                                <button class="btn btn-sm btn-danger m-2">
                                    Exit
                                    <ion-icon style="" name="exit-outline"></ion-icon>
                                </button>
                            </div>
                            {{-- </div> --}}
                        </div>
                        <div class="col-sm-6 col align-self-end">
                            <div class="save-purchase">
                                <button class="btn btn-sm btn-success">
                                    Complete Sale
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODALS START HERE --}}
        {{-- MODALS START HERE --}}
        {{-- MODALS START HERE --}}

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Patient Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" class="form-control" name="name" type="text" autocomplete="off"
                                    required placeholder="Patient Name">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" class="form-control" name="email" type="email" autocomplete="off"
                                    required placeholder="patient@mail.com">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input id="phone_number" class="form-control" name="phone_number" type="text"
                                    autocomplete="off" required placeholder="+254700000000">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="address" class="form-label">Address</label>
                                <input id="address" class="form-control" name="address" type="text" autocomplete="off"
                                    required placeholder="Enter Address">
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
                                <input id="mpesa_amount" class="form-control" name="mpesa_amount" type="text"
                                    autocomplete="off" required placeholder="0.00">
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
                                <input id="cash_amount" class="form-control" name="cash_amount" type="text"
                                    autocomplete="off" required placeholder="0.00">
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
                                <input id="bank_amount" class="form-control" name="bank_amount" type="text"
                                    autocomplete="off" required placeholder="0.00">
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
    </form>
</div>

@endsection

@push('custom-scripts')

<script>
    $(document).ready(function() {
	var productItem = [{
			productName: "FinePix Pro2 3D Camera",
			price: "1800.00",
			photo: "camera.jpg"
		},
		{
			productName: "EXP Portable Hard Drive",
			price: "800.00",
			photo: "external-hard-drive.jpg"
		},
		{
			productName: "Luxury Ultra thin Wrist Watch",
			price: "500.00",
			photo: "laptop.jpg"
		},
		{
			productName: "XP 1155 Intel Core Laptop",
			price: "1000.00",
			photo: "watch.jpg"
		}];
	showProductGallery(productItem);
});

function showProductGallery(product) {
	//Iterate javascript shopping cart array
	var productHTML = "";
	product.forEach(function(item) {
        // productHTML += '<div class="align-self-center">'+
        //                     '<div class="img-box">'+
        //                         '<img src="product-images/' + item.photo + '" class="rounded float-left" alt="...">'+
        //                     '</div>'+
        //                 '</div>'+
        //                 '<div class="media-body text-right m-4">'+
        //                     '<p class="text-bold">'+ item.productName +'</p>'+
        //                     '<div class="cart-action">'+
        //                         '<input type="text" class="product-quantity" name="quantity" value="1" size="2" />'+
        //                         '<input type="submit" value="Add to Cart" class="add-to-cart" onClick="addToCart(this)" />'+
        //                     '</div>'+
        //                 '</div>'+

		productHTML += '<div class="product-item">'+
					'<img src="product-images/' + item.photo + '">'+
					'<div class="productname">' + item.productName + '</div>'+
                    '<div class="price">$<span>' + item.price + '</span></div>'+
					'<div class="cart-action">'+
						'<input type="text" class="product-quantity" name="quantity" value="1" size="2" />'+
						'<input type="submit" value="Add to Cart" class="add-to-cart" onClick="addToCart(this)" />'+
					'</div>'+
				'</div>';
				"<tr>";
		
	});
	$('#product-item-container').html(productHTML);
}

function addToCart(element) {
	var productParent = $(element).closest('div.media-body');

	var price = $(productParent).find('.text-bold').text();
	// var productName = $(productParent).find('.productname').text();
	// var quantity = $(productParent).find('.product-quantity').val();

	var cartItem = {
		// productName: productName,
		price: price,
		// quantity: quantity
	};
    
    console.log(cartItem);
	var cartItemJSON = JSON.stringify(cartItem);

	var cartArray = new Array();
	// If javascript shopping cart session is not empty
	if (sessionStorage.getItem('shopping-cart')) {
		cartArray = JSON.parse(sessionStorage.getItem('shopping-cart'));
	}
	cartArray.push(cartItemJSON);

	var cartJSON = JSON.stringify(cartArray);
	sessionStorage.setItem('shopping-cart', cartJSON);
	showCartTable();
}

function emptyCart() {
	if (sessionStorage.getItem('shopping-cart')) {
		// Clear JavaScript sessionStorage by index
		sessionStorage.removeItem('shopping-cart');
		showCartTable();
	}
}

function showCartTable() {
	var cartRowHTML = "";
	var itemCount = 0;
	var grandTotal = 0;

	var price = 0;
	var quantity = 0;
	var subTotal = 0;

	if (sessionStorage.getItem('shopping-cart')) {
		var shoppingCart = JSON.parse(sessionStorage.getItem('shopping-cart'));
		itemCount = shoppingCart.length;

		//Iterate javascript shopping cart array
		shoppingCart.forEach(function(item) {
			var cartItem = JSON.parse(item);
			price = parseFloat(cartItem.price);
			quantity = parseInt(cartItem.quantity);
			subTotal = price * quantity

			cartRowHTML += "<tr>" +
				"<td>" + cartItem.productName + "</td>" +
				"<td class='text-right'>$" + price.toFixed(2) + "</td>" +
				"<td class='text-right'>" + quantity + "</td>" +
				"<td class='text-right'>$" + subTotal.toFixed(2) + "</td>" +
				"</tr>";

			grandTotal += subTotal;
		});
	}

	$('#cartTableBody').html(cartRowHTML);
	$('#itemCount').text(itemCount);
	$('#totalAmount').text("$" + grandTotal.toFixed(2));
}

</script>
@endpush