@extends('Backend.Layout.app')

@section('breadcrumb', 'Order List')
@section('title', 'Staff')

@section('main-content')   

   
  <div class="container-fluid py-4">

    <div class="card card-info mt-4 mb-4 p-4">
      <div class="card-body">
        <div class="card-header mb-2 p-0"> 
          <h3 class="card-title">Orders</h3>
        </div>

        @include('message')
        <div class="table-responsive">
          <table id="datatablesSimpleOne" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Grand Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if($orders->count() > 0)
                @foreach($orders as $order)
                  @foreach($order->items as $item)
                    <tr>
                      <td>{{ $item->product ? $item->product->name : 'Unknown Product' }}</td>
                      <td>{{ $item->quantity }}</td>
                      <td>{{ $item->total_amount }}</td>
                      <td class="align-middle">

                        <div class="btn-group " role="group" aria-label="Basic example">
                        
                          <a href="{{ route('order.ordershow', $order->id) }}" type="button" class="btn btn-secondary">
                              <i class="fas fa-info-circle"></i>
                          </a>
                          
                         
                          <a href="{{ route('order.orderedit', $order->id) }}" type="button" class="btn btn-warning">
                              <i class="fas fa-edit"></i>
                          </a>
                          
                          
                          <button type="button" class="btn btn-danger" onclick="confirmAction({{ $order->id }}, 'Are you sure you want to archive this order?')">
                              <i class="fas fa-archive"></i>
                          </button>

                        </div>

                      </td>

                      
                    </tr>
                  @endforeach

                @endforeach

                @else
                <tr>
                  <td class="text-center" colspan="6">No users found</td>
                </tr>
              @endif
              
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
<script>
function confirmAction(id, message) {
    if (confirm(message)) {
        // Submit the delete form if confirmed
        var form = document.createElement('form');
        form.action = "{{ route('order.orderdelete', '') }}" + '/' + id; // Adjust the route here
        form.method = 'POST';
        var csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}'; // Add CSRF token
        form.appendChild(csrfInput);
        
        var methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit(); // Submit the form
    }
}
</script>

@endpush