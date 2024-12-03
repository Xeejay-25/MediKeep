@extends('Backend.Layout.app')
@section('breadcrumb', 'Order')
@section('title', 'Staff')
@section('main-content')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>    
</head>

<style>

    .no-highlight {
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
    }

    .no-interaction {
        pointer-events: none;
        user-select: none;
        caret-color: transparent;
        background-color: transparent;
        color: inherit;
    }

    .caret-block {
        caret-color: transparent;
        background-color: transparent;
        color: inherit;
    }

    .nav-tabs {
        border-bottom: 2px solid #e0e0e0;
    }

    .nav-tabs .nav-item .nav-link {
        border: none;
        margin-right: 3px;
        color: #fff;
        background-color: darkgray;
        transition: background-color 0.3s, color 0.3s;
        border-radius: 10px 10px 0 0;
    }

    .nav-tabs .nav-item:first-child .nav-link {
        border-radius: 10px 10px 0 0;
    }

    .nav-tabs .nav-item .nav-link.active {
        background-color: #007bff;
        color: #fff;
        border-radius: 10px 10px 0 0;
    }

    .nav-tabs .nav-item .nav-link:hover {
        background-color: gray;
        color: #fff;
        border-radius: 10px 10px 0 0;
    }

    .nav-tabs .nav-item .nav-link.active:hover {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 50px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        border-radius: 50px;
    }

    .btn-info {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 50px;
        color: white;
    }

    .btn-info:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        border-radius: 50px;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: none;
    }

    .nav-tabs .nav-item {
        position: relative;
    }

    .nav-tabs .nav-item .close-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: transparent;
        border: none;
        font-size: 14px;
        color: white;
        cursor: pointer;
        outline: none;
        z-index: 10;
        line-height: 1;
    }

    .nav-tabs .nav-item .close-btn:hover {
        color: #ff0000;
    }

    .nav-tabs .nav-item .nav-link {
        padding-right: 25px;
    }

    .modal-header {
        display: flex;
        align-items: center;
        background-color: #007bff;
        color: white;
    }

    .modal-logo {
        width: 50px;
        height: auto;
        margin-right: 15px;
    }

    .modal-title {
        font-weight: bold;
        color: white;
    }

    .modal-body {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .modal-body h5 {
        margin-top: 0;
        margin-bottom: 10px;
    }

    .modal-body ul {
        list-style-type: none;
        padding: 0;
    }

    .modal-body li {
        margin-bottom: 5px;
    }

    .modal-footer {
        display: flex;
        justify-content: space-between;
    }

    .notification-container {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 100%;
        padding: 10px 20px;
        background: linear-gradient(to right, rgba(40, 167, 69, 1) 0%, rgba(40, 167, 69, 1) 80%, rgba(255, 255, 255, 1) 100%);
        color: #fff;
        border-radius: 50px 0 0 50px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        opacity: 0;
        visibility: hidden;
        transition: all 0.5s ease;
        text-align: center;
        font-weight: bold;
    }

    .notification-container.show {
        opacity: 1;
        visibility: visible;
        transform: translateX(-10px) translateY(-50%); /* Slide in from the right */
    }

    .notification-container:after {
        content: '';
        display: inline-block;
        width: 35px; 
        background: transparent; 
    }

    .custom-success {
        background-color: #28a745;
        border-color: #28a745;
        border-radius: 50px;
        color: white;
        cursor: pointer;
    }

    .custom-success:hover {
        background-color: #218838;
        border-color: #218838;
        border-radius: 50px;
        color: #fff;
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center;
        pointer-events: all;
    }

    .dual-ring-spinner {
        display: inline-block;
        width: 64px;
        height: 64px;
    }

    .dual-ring-spinner:after {
        content: " ";
        display: block;
        width: 48px;
        height: 48px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #007bff;
        border-color: #007bff transparent #28a745 transparent;
        animation: dual-ring-spin 1.2s linear infinite;
    }

    @keyframes dual-ring-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    #printableArea {
        width: 80mm; /* adjust per paper size req */
        font-size: 12px;
        line-height: 1.4;
        margin: 0 auto;
    }

    #printableArea table {
        width: 100%;
        border-collapse: collapse;
    }

    #printableArea th, #printableArea td {
        text-align: left;
        padding: 5px;
    }

    #printableArea h3, #printableArea p {
        text-align: center;
        margin: 5px 0;
    }

</style>

<div class="container-fluid py-4 caret-block no-highlight">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-lg-12 mb-lg-0 mb-4 mx-auto">
                <div class="card z-index-2">
                    <div class="card-body p-2">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div style="position: absolute; top: 30px; right: 30px; z-index: 10;">
                            <a href="{{ route('order.orderlist') }}" class="card-title" style="display: block; height: 100%; line-height: 1.5; padding: 10px; border-radius: 5px; text-align: right;">
                                <div id="notification-container" class="notification-container position-absolute" style="pointer-events: none;"></div>
                                <img src="https://i.ibb.co/zHVpKjb/toppng-com-shipping-png-512x512.png" alt="Order Items" style="height: 50px; width: auto;">
                            </a>
                        </div>

                        <!-- Order Form Starts Here -->
                        <form id="orderForm" method="POST">
                            @csrf

                            <div id="loadingOverlay" class="loading-overlay" style="display: none;">
                                <div class="dual-ring-spinner"></div>
                            </div>                            

                            <div class="row p-4">
                                <!-- Left Column: Order Information -->
                                <div class="col-md-6">
                                    <div class="card-header mb-2 p-2">
                                        <h3 class="card-title" >Order Form</h3>
                                    </div>
                                    <!-- Tabbing sys -->
                                    <ul class="nav nav-tabs" id="orderItemsTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item1" aria-selected="true" style="font-size: 12px; font-weight: bold">
                                                NEW ITEM
                                                <button type="button" class="close-btn" onclick="removeTab(1)">&times;</button>
                                            </a>
                                        </li>
                                    </ul>                                    
                                    <div class="tab-content" id="orderItemsTabContent">
                                        <div class="tab-pane fade show active order-items" id="item1" role="tabpanel" aria-labelledby="item1-tab">
                                            <div class="form-group" style="margin-bottom: 15px;">
                                                <select class="form-control product-select" name="product_id[]" required onchange="updatePrice(this)">
                                                    <option value="" disabled selected hidden style="color: lightgray;">Select Product</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                            {{ $product->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group" style="margin-bottom: 15px; caret-color: auto; background-color: auto; color: auto;">
                                                <input type="number" class="form-control quantity" id="quantity1" name="quantity[]" oninput="calculateTotalPrice(1); checkQuantity()" required min="1" placeholder="Quantity">
                                            </div>
                                            <div class="form-group no-interaction" style="margin-bottom: 15px;">
                                                <input type="number" step="0.01" class="form-control unit-price" id="unitPrice1" name="unit_price[]" oninput="calculateTotalPrice(1)" required readonly placeholder="Unit Price">
                                            </div>
                                            <div class="form-group no-interaction" style="margin-bottom: 15px;">
                                                <input type="number" step="0.01" class="form-control total-price" id="totalPrice1" name="total_price[]" readonly placeholder="Total Price">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- add more item btn -->
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary" style="border-radius: 50px" id="addMoreItemsBtn" onclick="addOrderItem()" disabled>Add More Items</button>
                                    </div>
                                </div>

                                <!-- Right Column: Order Items with Tabs -->
                                <div class="col-md-6">
                                    <div class="card-header mb-2 p-2">
                                        <h3 class="card-title no-interaction" style="visibility: hidden;">Order Form</h3>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 15px; margin-top: 44px;">
                                        <select class="form-control" name="supplier_id" id="supplierSelect" required onchange="checkQuantity()">
                                            <option value="" disabled selected hidden style="color: lightgray;">Select Supplier</option>
                                            @if($suppliers->isEmpty())
                                                <option value="" disabled>No suppliers available</option>
                                            @else
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group no-interaction" style="margin-bottom: 15px;">
                                        <input type="hidden" name="staff_id" value="{{ Auth::id() }}">
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly placeholder="Staff">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 15px;">
                                        <input type="date" class="form-control" id="orderDate" name="order_date" required>
                                    </div>
                                    <div class="form-group no-interaction" style="margin-bottom: 15px;">
                                        <input type="text" class="form-control" value="Pending" readonly placeholder="Status">
                                        <input type="hidden" name="status" value="Pending">
                                    </div>
                                    <!-- order summary & submir order btn -->
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-info" id="orderSummaryBtn" onclick="showOrderSummary()">Order Summary</button>
                                        <button type="submit" class="btn custom-success" onclick="return validateOrderItems()">Submit Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Order Form Ends Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="orderSummaryModal" tabindex="-1" role="dialog" aria-labelledby="orderSummaryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="width: 800px; height: 600px; overflow: hidden; position: relative;">
                <img src="https://i.ibb.co/zSNR7Bf/Picsart-24-10-25-20-14-54-279.png" alt="Logo" 
                    style="position: absolute; top: 10px; right: 10px; height: 100px; opacity: 1; transform: rotate(-15deg); z-index: 1;">
                <div class="modal-header d-flex justify-content-center align-items-center" 
                    style="background-color: #007bff; color: white; padding: 0.5rem 1rem;">
                    <h5 class="modal-title mx-auto" id="orderSummaryModalLabel" style="margin: 0; font-weight: bold; z-index: 2;">ORDER SUMMARY</h5>
                </div>
                <div class="modal-body d-flex flex-column px-5 no-interaction" id="orderSummaryContent" style="height: calc(100% - 4rem);">
                    <div class="mb-3 no-interaction">
                        <p>A new order will be placed by <strong>{{ Auth::user()->name }}</strong> to: </p><p><strong id="supplierName"></strong></p> 
                    </div>
                    <div class="table-responsive flex-grow-1 no-interaction" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-hover table-bordered table-striped mb-0">
                            <thead class="thead-dark no-interaction">
                                <tr>
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="orderItemsTableBody">
                                <!-- will be populated -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer p-0 no-interaction">
                    <table class="table mb-0 no-interaction">
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-center bg-light no-interaction">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span class="text-right mr-2">Total Amount:<span class="opacity-0">--</span></span>
                                        <span id="totalAmount" class="ml-2">₱0.00</span>
                                    </div>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>                
            </div>
        </div>
    </div>

    <div id="printableArea" style="display: none; width: 300px; margin: 0 auto; font-family: 'Courier New', Courier, monospace;">
        
        <h3 style="text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 10px;">ORDER RECEIPT</h3>
        <h3 style="text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 10px;">Medikeep Pharmacy</h3>
        <p style="text-align: center; font-size: 14px; margin: 5px 0;">Date: <span id="printOrderDate" style="font-weight: bold;"></span></p>
        <p style="text-align: center; font-size: 14px; margin: 5px 0;">Supplier: <span id="printSupplierName" style="font-weight: bold;"></span></p>
    
        <table style="width: 100%; border-top: 1px solid #000; border-bottom: 1px solid #000; margin: 10px 0;">
            <thead>
                <tr>
                    <th style="text-align: left; font-size: 14px; padding: 5px 0;">Item</th>
                    <th style="text-align: center; font-size: 14px; padding: 5px 0;">Qty</th>
                    <th style="text-align: right; font-size: 14px; padding: 5px 0;">Price</th>
                    <th style="text-align: right; font-size: 14px; padding: 5px 0;">Total</th>
                </tr>
            </thead>
            <tbody id="printOrderItems">
                <!-- js populate -->
            </tbody>
        </table>
    
        <p style="font-size: 16px; text-align: right; font-weight: bold; margin-top: 10px;">
            Total: <span id="printTotalAmount"></span>
        </p>
    
        <p style="text-align: center; font-size: 12px; margin-top: 20px; color: #777;">Thank you for walang sawang suporta!</p>
    </div>

    @include('components.footer')
</div>

@endsection

@push('custom-scripts')
<script>
    let itemCount = 1;

    document.getElementById('orderForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    $('#loadingOverlay').appendTo('body').css('display', 'flex');

    fetch("{{ route('staff.add_order') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('loadingOverlay').style.display = 'none';
        const notificationContainer = document.getElementById('notification-container');

        if (data.success) {
            // Show success notification
            notificationContainer.innerHTML = `<span>${data.message}</span>`;
            notificationContainer.classList.add('show');

            // Trigger the print dialog
            setTimeout(() => {
                printOrderDetails(); // Print receipt
            }, 500);

            setTimeout(() => {
                notificationContainer.classList.remove('show');
                location.reload(); // Reload after printing
            }, 3000);
        } else {
            throw new Error(data.message || "An unknown error occurred.");
        }
    })
    .catch(error => {
        document.getElementById('loadingOverlay').style.display = 'none';

        const notificationContainer = document.getElementById('notification-container');
        notificationContainer.innerHTML = `<span>An error occurred: ${error.message}</span>`;
        notificationContainer.classList.add('show');

        setTimeout(() => notificationContainer.classList.remove('show'), 5000);
    });
});

function printOrderDetails() {
    // Populate printable area
    const printOrderDate = document.getElementById('orderDate').value;
    const supplierSelect = document.getElementById('supplierSelect');
    const printSupplierName = supplierSelect.selectedOptions[0].text;

    document.getElementById('printOrderDate').innerText = printOrderDate;
    document.getElementById('printSupplierName').innerText = printSupplierName;

    // Populate items in the printable area
    const printOrderItems = document.getElementById('printOrderItems');
    printOrderItems.innerHTML = ''; // Clear existing rows

    const productSelects = document.querySelectorAll('.product-select');
    const quantityInputs = document.querySelectorAll('.quantity');

    let totalAmount = 0;

    productSelects.forEach((productSelect, index) => {
        if (productSelect.value && quantityInputs[index].value) {
            const itemName = productSelect.options[productSelect.selectedIndex].text;
            const quantity = quantityInputs[index].value;
            const unitPrice = parseFloat(document.querySelector(`#unitPrice${index + 1}`).value);
            const totalPrice = parseFloat(document.querySelector(`#totalPrice${index + 1}`).value);

            totalAmount += totalPrice;

            // Add row to the printable table
            const row = `
                <tr>
                    <td>${itemName}</td>
                    <td style="text-align: center;">${quantity}</td>
                    <td style="text-align: right;">₱${unitPrice.toFixed(2)}</td>
                    <td style="text-align: right;">₱${totalPrice.toFixed(2)}</td>
                </tr>
            `;
            printOrderItems.innerHTML += row;
        }
    });

    // Update total amount
    document.getElementById('printTotalAmount').innerText = `₱${totalAmount.toFixed(2)}`;

    // Trigger the print dialog
    const printableContent = document.getElementById('printableArea').innerHTML;

    const iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.width = '0';
    iframe.style.height = '0';
    iframe.style.border = 'none';

    document.body.appendChild(iframe);

    const iframeDoc = iframe.contentWindow.document;
    iframeDoc.open();
    iframeDoc.write(`
        <html>
            <head>
                <title>Order Receipt</title>
            </head>
            <body>${printableContent}</body>
        </html>
    `);
    iframeDoc.close();

    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    setTimeout(() => {
        document.body.removeChild(iframe);
    }, 1000);
}

    document.getElementById("orderSummaryBtn").addEventListener("click", function(event) {
        event.preventDefault();

        if (document.querySelector("form").checkValidity()) {
            showOrderSummary();
        } else {
            document.querySelector("form").reportValidity();
        }
    });

    const orderDateInput = document.getElementById("orderDate");
    orderDateInput.addEventListener("mousedown", (e) => {
        e.preventDefault();
    });
    orderDateInput.addEventListener("selectstart", (e) => {
        e.preventDefault();
    });

    document.addEventListener("DOMContentLoaded", function() {
        const productSelect = document.querySelectorAll('.product-select');
        productSelect.forEach(select => updatePrice(select));
        checkQuantity();
    });

    function updatePrice(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var price = selectedOption.getAttribute('data-price');
        var unitPriceInput = selectElement.closest('.order-items').querySelector('.unit-price');
        unitPriceInput.value = price;
        calculateTotalPrice(selectElement.closest('.order-items').querySelector('.quantity').id.split('quantity')[1]);
    }

    function calculateTotalPrice(index) {
        var quantity = document.getElementById('quantity' + index).value;
        var unitPrice = document.getElementById('unitPrice' + index).value;

        if (quantity && unitPrice) {
            var totalPrice = quantity * unitPrice;
            document.getElementById('totalPrice' + index).value = totalPrice.toFixed(2);
        } else {
            document.getElementById('totalPrice' + index).value = '';
        }
        checkQuantity();
    }

    function checkQuantity() {
        const quantityInputs = document.querySelectorAll('.quantity');
        const productSelects = document.querySelectorAll('.product-select');
        const supplierSelect = document.getElementById('supplierSelect');
        const addMoreItemsBtn = document.getElementById('addMoreItemsBtn');

        const allValidQuantities = Array.from(quantityInputs).every(input => input.value > 0);

        const allProductsSelected = Array.from(productSelects).every(select => select.value !== "");

        const supplierSelected = supplierSelect.value !== "";

        const isEnabled = allValidQuantities && allProductsSelected && supplierSelected;
        addMoreItemsBtn.disabled = !isEnabled;

        if (isEnabled) {
            addMoreItemsBtn.classList.remove('btn-secondary');
            addMoreItemsBtn.classList.add('btn-primary');
        } else {
            addMoreItemsBtn.classList.remove('btn-primary');
            addMoreItemsBtn.classList.add('btn-secondary');
        }
    }

    document.getElementById('orderItemsTabContent').addEventListener('change', function(event) {
        if (event.target.classList.contains('product-select')) {
            updateTabName(event.target);
        }
    });

    function addOrderItem() {
        itemCount++;

        var newItemTab = `
            <li class="nav-item">
                <a class="nav-link" id="item${itemCount}-tab" data-toggle="tab" href="#item${itemCount}" role="tab" aria-controls="item${itemCount}" aria-selected="false" style="font-size: 12px; font-weight: bold">
                    NEW ITEM
                    <button type="button" class="close-btn" onclick="removeTab(${itemCount})">&times;</button>
                </a>
            </li>
        `;

        var newItemContent = `
            <div class="tab-pane fade order-items" id="item${itemCount}" role="tabpanel" aria-labelledby="item${itemCount}-tab">
                <div class="form-group" style="margin-bottom: 15px;">
                    <select class="form-control product-select" name="product_id[]" required onchange="updatePrice(this)">
                        <option value="" disabled selected hidden style="color: lightgray;">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 15px; caret-color: auto; background-color: auto; color: auto;">
                    <input type="number" class="form-control quantity" id="quantity${itemCount}" name="quantity[]" oninput="calculateTotalPrice(${itemCount}); checkQuantity()" required min="1" placeholder="Quantity">
                </div>
                <div class="form-group no-interaction" style="margin-bottom: 15px;">
                    <input type="number" step="0.01" class="form-control unit-price" id="unitPrice${itemCount}" name="unit_price[]" oninput="calculateTotalPrice(${itemCount})" required readonly placeholder="Unit Price">
                </div>
                <div class="form-group no-interaction" style="margin-bottom: 15px;">
                    <input type="number" step="0.01" class="form-control total-price" id="totalPrice${itemCount}" name="total_price[]" readonly placeholder="Total Price">
                </div>
            </div>
        `;

        document.getElementById('orderItemsTabs').insertAdjacentHTML('beforeend', newItemTab);
        document.getElementById('orderItemsTabContent').insertAdjacentHTML('beforeend', newItemContent);

        $('#orderItemsTabs .nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');

        $(`#item${itemCount}-tab`).addClass('active');
        $(`#item${itemCount}`).addClass('show active');

        checkQuantity();
    }

    function updateTabName(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var productName = selectedOption.text.toUpperCase();
        var tabId = selectElement.closest('.tab-pane').id;

        document.querySelector(`a[href='#${tabId}']`).innerHTML = `
            ${productName}
            <button type="button" class="close-btn" onclick="removeTab(${itemCount})">&times;</button>
        `;
    }

    function removeTab(index) {
        
        const tabCount = document.querySelectorAll('#orderItemsTabs .nav-item').length;

        if (tabCount === 1) {
            alert("You cannot remove the last tab.");
            return;
        }

        $(`#item${index}-tab`).parent().remove();
        $(`#item${index}`).remove();

        const remainingTabs = $('#orderItemsTabs .nav-link');
        
        if (remainingTabs.length > 0) {
            const activeTab = remainingTabs.filter('.active');
            
            if (activeTab.length === 0) {
                $(remainingTabs[0]).addClass('active');
                const firstTabId = $(remainingTabs[0]).attr('href');
                $(firstTabId).addClass('show active');
            }
        }

        for (let i = tabIndex; i <= itemCount; i++) {
            const tab = document.querySelector(`#item${i}`);
            if (tab) {
                tab.id = `item${i - 1}`;
                const productSelect = tab.querySelector('.product-select');
                const quantityInput = tab.querySelector(`#quantity${i}`);
                const unitPriceInput = tab.querySelector(`#unitPrice${i}`);
                const totalPriceInput = tab.querySelector(`#totalPrice${i}`);

                productSelect.id = `productSelect${i - 1}`;
                quantityInput.id = `quantity${i - 1}`;
                unitPriceInput.id = `unitPrice${i - 1}`;
                totalPriceInput.id = `totalPrice${i - 1}`;
            }
        }
    }

    function showOrderSummary() {
        const supplierSelect = document.getElementById('supplierSelect');
        const orderDate = document.getElementById('orderDate');
        const productSelects = document.querySelectorAll('.product-select');
        const quantityInputs = document.querySelectorAll('.quantity');

        let isValid = true;
        if (!supplierSelect.value) {
            isValid = false;
            supplierSelect.reportValidity();
        } else if (!orderDate.value) {
            isValid = false;
            orderDate.reportValidity();
        } else {
            productSelects.forEach((productSelect, index) => {
                if (!productSelect.value) {
                    isValid = false;
                    productSelect.reportValidity();
                }
            });

            quantityInputs.forEach((quantityInput, index) => {
                if (!quantityInput.value || quantityInput.value <= 0) {
                    isValid = false;
                    quantityInput.reportValidity();
                }
            });
        }

        if (isValid) {

            const supplierName = supplierSelect.selectedOptions[0].text;
            document.getElementById('supplierName').innerText = supplierName;

            const orderItemsTableBody = document.getElementById('orderItemsTableBody');
            orderItemsTableBody.innerHTML = '';

            let totalAmount = 0;

            productSelects.forEach((productSelect, index) => {
                const quantityInput = quantityInputs[index];
                const unitPriceInput = document.querySelector(`#unitPrice${index + 1}`);
                const totalPriceInput = document.querySelector(`#totalPrice${index + 1}`);

                if (productSelect.value && quantityInput.value) {
                    const itemName = productSelect.options[productSelect.selectedIndex].text;
                    const quantity = quantityInput.value;
                    const unitPrice = parseFloat(unitPriceInput.value);
                    const totalPrice = parseFloat(totalPriceInput.value);

                    const calculatedTotalPrice = quantity * unitPrice;

                    const row = `<tr>
                        <td class="text-center">${itemName}</td>
                        <td class="text-center">${quantity}</td>
                        <td class="text-center">₱${unitPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                        <td class="text-center">₱${calculatedTotalPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    </tr>`;
                    
                    orderItemsTableBody.innerHTML += row;

                    totalAmount += calculatedTotalPrice;
                }
            });

            const formattedTotalAmount = totalAmount % 1 === 0
                ? `₱${totalAmount.toLocaleString(undefined, { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`
                : `₱${totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

            document.getElementById('totalAmount').innerText = formattedTotalAmount;
            $('#orderSummaryModal').modal('show');
        }
    }

</script>
@endpush
