@extends('Backend.Layout.app')

@section('breadcrumb', 'Medicine List')
@section('title', 'Staff')

@section('main-content')   

  <div class="container-fluid py-4">

    {{-- Product Edit Modal with Two Columns --}}
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editProductForm" method="POST" action="{{ route('staff.update_product') }}">
              @csrf
              @method('PUT') <!-- Ensure to use the PUT method for updating -->
              <input type="hidden" id="editProductId" name="id"> <!-- Hidden field for product ID -->
              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <!-- Product Name -->
                  <div class="mb-3">
                    <label for="editProductName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="editProductName" name="name" required>
                  </div>
                  <!-- Category -->
                  <div class="mb-3">
                    <label for="editProductCategory" class="form-label">Category</label>
                    <input type="text" class="form-control" id="editProductCategory" name="category" required>
                  </div>
                  <!-- Type (Subcategory) -->
                  <div class="mb-3">
                    <label for="editProductType" class="form-label">Type</label>
                    <input type="text" class="form-control" id="editProductType" name="subcategory" required>
                  </div>
                </div>
                <!-- Right Column -->
                <div class="col-md-6">
                  <!-- Description -->
                  <div class="mb-3">
                    <label for="editProductDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="editProductDescription" name="description" required></textarea>
                  </div>
                  <!-- Manufacturer -->
                  <div class="mb-3">
                    <label for="editProductManufacturer" class="form-label">Manufacturer</label>
                    <input type="text" class="form-control" id="editProductManufacturer" name="manufacturer" required>
                  </div>
                  <!-- Quantity -->
                  <div class="mb-3">
                    <label for="editProductQuantity" class="form-label">Quantity</label>
                    <input type="text" class="form-control" id="editProductQuantity" name="quantity" required>
                  </div>
                  <!-- Price -->
                  <div class="mb-3">
                    <label for="editProductPrice" class="form-label">Price</label>
                    <input type="text" class="form-control" id="editProductPrice" name="price" required>
                  </div>
                  
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="editProductForm">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Table List -->
    <div class="card card-info mt-4 mb-4 p-4">
      <div class="card-body">
        <div class="card-header mb-2 p-0"> 
          <h3 class="card-title">Products</h3>
        </div>

        @include('message')
        <div class="table-responsive">
          <table id="datatablesSimpleOne" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Product Info</th>
                <th>Type</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($products as $product)
              
                  <td>
                    Name: {{ $product->name }} <br>
                    Category: {{ $product->category }} <br>
                    Description: {{ $product->description }} <br>
                    Measurement: {{ $product->measurement }} <br>
                    Manufacturer: {{ $product->manufacturer }} <br>
                    Quantity:{{ $product->quantity }} <br>
                  </td>
                  <td class="text-center align-middle"> {{ $product->subcategory }}</td>
                  <td class="text-center align-middle"> ₱ - {{ $product->price }}</td>
                  <td class="text-center align-middle">
                    <button class="btn btn-primary editProductBtn" 
                      data-id="{{ $product->id }}" 
                      data-name="{{ $product->name }}" 
                      data-category="{{ $product->category }}" 
                      data-subcategory="{{ $product->subcategory }}" 
                      data-description="{{ $product->description }}" 
                      data-manufacturer="{{ $product->manufacturer }}" 
                      data-price="{{ $product->price }}"
                      data-quantity="{{ $product->quantity }}">Edit
                    </button>
                    <form action="{{ route('staff.delete_product', $product->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to DELETE?')">Delete</button>
                    </form>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- End -->

    <!-- Footer -->
    @include('components.footer')


  </div>

@endsection

@push('custom-scripts')
<!-- Add Bootstrap JS for modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function() {
    $('.editProductBtn').on('click', function() {
        // Get product data from button attributes
        var id = $(this).data('id');
        var name = $(this).data('name');
        var category = $(this).data('category');
        var subcategory = $(this).data('subcategory'); // Type field
        var description = $(this).data('description');
        var manufacturer = $(this).data('manufacturer');
        var price = $(this).data('price');
        var quantity = $(this).data('quantity');
        
        // Populate the modal with product data
        $('#editProductId').val(id);
        $('#editProductName').val(name);
        $('#editProductCategory').val(category);
        $('#editProductType').val(subcategory); // Populating the Type (subcategory)
        $('#editProductDescription').val(description);
        $('#editProductManufacturer').val(manufacturer);
        $('#editProductQuantity').val(quantity);
        $('#editProductPrice').val(price);
        
        
        // Show the modal
        $('#editProductModal').modal('show');
    });
  });
</script>
@endpush
