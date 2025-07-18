@extends('Backend.Layout.app')

@section('breadcrumb', 'Order Details')
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

        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $orders->id }}</td>
                </tr>
                <tr>
                    <th>Supplier</th>
                    <td>{{ $orders->supplier ? $orders->supplier->name : 'Unknown Supplier' }}</td>
                </tr>
                <tr>
                    <th>Staff Name</th>
                    <td>{{ $orders->staff_id }}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ \Carbon\Carbon::parse($orders->order_date)->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>{{ number_format($orders->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucwords($orders->status) }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $orders->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $orders->updated_at }}</td>
                </tr>
            </table>
            
            <h5>Order Items</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
               
                        @foreach($orders->items as $item)
                            <tr>
                                <td>{{ $item->product ? $item->product->name : 'Unknown Product' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->unit_price, 2) }}</td>
                                <td>{{ number_format($item->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                  
                 
                </tbody>
            </table>
        </div>
        


      </div>
    </div>


  </div>
    
  
  

  <!-- footer -->
  @include('components.footer')

@endsection

@push('custom-scripts')
<!-- Add Bootstrap JS for modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endpush
