@extends('Backend.Layout.app')
@section('breadcrumb', 'Home')
@section('title', 'Staff')
@section('main-content')  
    
    <div class="container-fluid py-4">
        
        <!-- 4 cards header -->
        <div class="row">
            <div class="col-xl-6 col-sm-6 mb-xl-3 mb-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Products</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $totalProducts }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Low Stocks Card -->
            <div class="col-xl-6 col-sm-6 mb-xl-3 mb-4">
                <div class="card" onclick="showProductsModal('lowStock')" data-bs-toggle="modal" data-bs-target="#stockModal">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Low Stocks</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $lowStock }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Out of Stocks Card -->
            <div class="col-xl-6 col-sm-6 mb-xl-3 mb-2">
                <div class="card" onclick="showProductsModal('outOfStock')" data-bs-toggle="modal" data-bs-target="#stockModal">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Out of Stocks</p>
                                    <h5 class="font-weight-bolder mb-0">{{ $outOfStock }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Suppliers Card -->
            <div class="col-xl-6 col-sm-6 mb-2">
                <div class="card" onclick="showSuppliersModal()" data-bs-toggle="modal" data-bs-target="#stockModal">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Suppliers</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $totalSuppliers }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="stockModalLabel">Stock Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul id="productList" class="list-group">
                                <!-- Product list will be populated here -->
                            </ul>
                            <ul id="supplierList" class="list-group mt-4">
                                <!-- Supplier list will be populated here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showSuppliersModal() {
                    var suppliers = @json($suppliers);  
                    var supplierListElement = document.getElementById('supplierList');
                    
                    supplierListElement.innerHTML = ''; 
                    
                    suppliers.forEach(function(supplier) {
                        var li = document.createElement('li');
                        li.classList.add('list-group-item');
                        
                        li.innerHTML = `
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>${supplier.name}</strong><br>
                                    <small>Email: ${supplier.contact_info}</small>
                                </div>
                            </div>
                        `;
                        
                        supplierListElement.appendChild(li);
                    });
                }
            </script>

            <div class="card-body p-3">
                <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                    <div style="width: 90%; margin: auto;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- footer -->
            @include('components.footer')
        </div>
    </div>

    <script>
        
        function clearModalContent() {
            var productListElement = document.getElementById('productList');
            var supplierListElement = document.getElementById('supplierList');
      
            productListElement.innerHTML = '';
            supplierListElement.innerHTML = '';
        }
      
        function showProductsModal(type) {
            clearModalContent();
      
            if (type === 'lowStock') {
                var lowStockProducts = @json($lowStockProducts); 
                var productListElement = document.getElementById('productList');
                
                lowStockProducts.forEach(function(product) {
                    var li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.innerHTML = `${product.name} - Quantity: ${product.quantity}`;
                    productListElement.appendChild(li);
                });
            }
      
          
            if (type === 'outOfStock') {
                var outOfStockProducts = @json($outOfStockProducts);  
                var productListElement = document.getElementById('productList');
                
                outOfStockProducts.forEach(function(product) {
                    var li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.innerHTML = `${product.name} - Quantity: ${product.quantity}`;
                    productListElement.appendChild(li);
                });
            }
      
            if (type === 'suppliers') {
                var suppliers = @json($suppliers);  
                var supplierListElement = document.getElementById('supplierList');
                
                suppliers.forEach(function(supplier) {
                    var li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.innerHTML = `${supplier.name} - Email: ${supplier.contact_info}`;
                    supplierListElement.appendChild(li);
                });
            }
        }
            document.addEventListener('DOMContentLoaded', function() {
            var lowStockCard = document.querySelector('[onclick="showProductsModal(\'lowStock\')"]');
            var outOfStockCard = document.querySelector('[onclick="showProductsModal(\'outOfStock\')"]');
            var suppliersCard = document.querySelector('[onclick="showSuppliersModal()"]');
            
            lowStockCard.addEventListener('click', function() {
                showProductsModal('lowStock');
            });
            
            outOfStockCard.addEventListener('click', function() {
                showProductsModal('outOfStock');
            });
            
            suppliersCard.addEventListener('click', function() {
                showProductsModal('suppliers');
            });
        });
    </script>

@endsection
@push('custom-scripts')
@endpush

