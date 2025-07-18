@extends('Backend.Layout.app')

@section('breadcrumb', 'Edit Order')
@section('title', 'Staff')

@section('main-content')   

   
    <div class="container-fluid py-4">

        <div class="card card-info mt-4 mb-4 p-4">
            <div class="card-body">
                <div class="card-header mb-2 p-2 d-flex justify-content-between align-items-center"> 
                    <h3 class="card-title">Order</h3>
                    <a href="{{ route('order.orderlist') }}" class="btn btn-secondary">Back</a>
                </div>

                @include('message')

                <form action="{{ route('order.orderupdate', $orders->id) }}" method="POST">
                    @csrf
                    @method('PUT') 
                    <div class="row p-4">

                        <!-- Left Column: Order Information -->
                        <div class="col-md-6">

                            <div class="card-header mb-2 p-2"> 
                                <h3 class="card-title">Order Form </h3>
                            </div>

                            <!-- Order Information Section -->
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-control" name="supplier_id" required>
                                    @foreach($suppliers as $supplier) 
                                        <option value="{{ $supplier->id }}" {{ $supplier->id == $orders->supplier_id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label for="staff_id">Staff</label>
                                <input type="text" class="form-control"  name="staff_id" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            

                            <div class="form-group">
                                <label for="orderDate">Order Date</label>
                                <input type="date" class="form-control" id="orderDate" name="order_date" value="{{ \Carbon\Carbon::parse($orders->order_date)->format('Y-m-d') }}" required>
                            </div>
                            
                            
                            

                            <div class="form-group">
                                <label for="status">Order Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Pending" {{ $orders->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Completed" {{ $orders->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                            
                        </div>

                        <!-- Right Column: Order Items -->
                        <div class="col-md-6">
                            <div class="card-header mb-2 p-2"> 
                                <h3 class="card-title">Order Items</h3>
                            </div>

                            <div class="tab-content" id="orderItemsTabContent">
                                
                                    <div class="order-items">
                                    
                                        <div class="form-group">
                                            <label for="product">Product</label>
                                            <select class="form-control" id="product" name="product_id[]" required onchange="updatePrice(this)">
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ in_array($product->id, $orders->items->pluck('product_id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        @foreach($orders->items as $index => $item)
                                        <div class="form-group">
                                            <label for="quantity{{ $index + 1 }}">Quantity</label>
                                            <input type="number" class="form-control" id="quantity{{ $index + 1 }}" name="quantity[]" value="{{ $item->quantity }}" oninput="calculateTotalPrice({{ $index + 1 }})" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="unitPrice{{ $index + 1 }}">Unit Price</label>
                                            <input type="number" step="0.01" class="form-control" id="unitPrice{{ $index + 1 }}" name="unit_price[]" value="{{ $item->unit_price }}" oninput="calculateTotalPrice({{ $index + 1 }})" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="totalPrice{{ $index + 1 }}">Total Price</label>
                                            <input type="number" step="0.01" class="form-control" id="totalPrice{{ $index + 1 }}" name="total_price[]" value="{{ $item->total_amount }}" readonly>
                                        </div>
                                    @endforeach
                                    
                                    </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>

         
                    <div class="row">
                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary mt-4">Update Order</button>
                        </div>
                    </div>
                </form>



                

            </div>
        </div>


    </div>
    
  
  

  <!-- footer -->
  @include('components.footer')

@endsection

@push('custom-scripts')
<!-- Add Bootstrap JS for modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function calculateTotalPrice(index) {
        // Get the quantity and unit price by their IDs
        var quantity = document.getElementById('quantity' + index).value;
        var unitPrice = document.getElementById('unitPrice' + index).value;

        // Calculate total price if both quantity and unit price are provided
        if (quantity && unitPrice) {
            var totalPrice = quantity * unitPrice;
            document.getElementById('totalPrice' + index).value = totalPrice.toFixed(2);  // Set total price and round to 2 decimals
        } else {
            document.getElementById('totalPrice' + index).value = '';  // Clear total price if inputs are invalid
        }
    }
</script>
@endpush
