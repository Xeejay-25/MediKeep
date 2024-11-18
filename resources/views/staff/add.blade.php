@extends('Backend.Layout.app')
@section('breadcrumb', 'Add Product')
@section('title', 'Staff')
@section('main-content')   
    
    <div class="container-fluid py-4">
        
        <div class="titles">
            <div class="tab-titles">
                <p class="tab-links {{ session('activeTab') == 'category' ? 'active-link' : '' }}" onclick="opentab('category')">Category <span></span></p>
                <p class="tab-links {{ session('activeTab') == 'subcategory' ? 'active-link' : '' }}" onclick="opentab('type')">Type <span></span></p>
                <p class="tab-links {{ session('activeTab') == 'add_product' ? 'active-link' : '' }}" onclick="opentab('add')">Add <span></span></p>                                     
            </div>
        </div>
        @include('message')
         
        {{-- Category Edit Modal --}}
        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" method="POST" action="{{ route('staff.update_category') }}">
                            @csrf
                            @method('PUT') <!-- Ensure to use the PUT method -->
                            <input type="hidden" id="editCategoryId" name="id">
                            <div class="mb-3">
                                <label for="editCategoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="editCategoryName" name="name" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="editCategoryForm">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Type Edit Modal --}}
        <div class="modal fade" id="editSubcategoryModal" tabindex="-1" aria-labelledby="editSubcategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSubcategoryModalLabel">Edit Subcategory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editSubcategoryForm" method="POST" action="{{ route('staff.update_subcategory') }}">
                            @csrf
                            @method('PUT') <!-- Ensure to use the PUT method -->
                            <input type="hidden" id="editSubcategoryId" name="id"> <!-- Corrected the ID -->
                            <div class="mb-3">
                                <label for="editSubcategoryName" class="form-label">Subcategory Name</label>
                                <input type="text" class="form-control" id="editSubcategoryName" name="name" required> <!-- Corrected the ID -->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="editSubcategoryForm">Save changes</button>
                    </div>
                </div>
            </div>
        </div>




        <!-- Medicine Category -->
        <div class="tab-contents {{ session('activeTab') == 'category' ? 'active-tab' : '' }}" id="category">
            <div class="card-body">

                <div class="row mt-3 " >
                    <div class="col-lg-4 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-2">
                                <div class="card-header mb-2 p-2"> 
                                    <h3 class="card-title">Medicine Category </h3>
                                </div>

                                <form action="{{ route('staff.add_category') }}" method="post">
                                    @csrf
                                    <div class="row g-3 px-4 mt-4">

                                        <div class="col-md-12 mb-5">
                                            <div class="input-group p-2">
                                                <span class="input-group-text bg-gray-200 p-2">Medicine Category</span>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-4 mb-4">
                                        <button type="submit"  class="btn btn-primary">
                                        Add 
                                        </button>
                                        <a href="{{ url ('staff/home')}}" class="btn btn-danger float-right"> Cancel</a>
                                    </div>

                                </form>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-2">
                                <div class="card-header mb-2 p-2"> 
                                    <h3 class="card-title">Medicine Category List </h3>
                                </div>

                                <div class="table-responsive p-3">
                                    <table id="datatablesSimpleOne" class="table table-bordered table-hover">
                                    <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $key => $category)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td> 
                                                    <td>{{ $category->name }}</td> 
                                                    <td> 
                                                        <button type="button" class="btn btn-primary" onclick="openEditCategoryModal('{{ $category->id }}', '{{ $category->name }}')">Edit</button>
                                                        <form action="{{ route('staff.delete_category', $category->id) }}" method="POST" style="display:inline;">
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
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->
         

        <!-- Medicine Type -->
        <div class="tab-contents {{ session('activeTab') == 'subcategory' ? 'active-tab' : '' }}" id="type">
            <div class="card-body">

                <div class="row mt-3 " >
                    <div class="col-lg-4 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-2">
                                <div class="card-header mb-2 p-2"> 
                                    <h3 class="card-title">Medicine Type </h3>
                                </div>

                                <form action="{{ route('staff.add_subcategory') }}" method="post" id="addTypeForm" onsubmit="addType(event)">
                                    @csrf
                                    <div class="row g-3 px-4 mt-4">

                                        <div class="col-md-12 mb-5">
                                            <div class="input-group p-2">
                                                <span class="input-group-text bg-gray-200 p-2">Medicine Type</span>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-4 mb-4">
                                        <button type="submit"  class="btn btn-primary">
                                        Add 
                                        </button>
                                        <a href="{{ url ('staff/home')}}" class="btn btn-danger float-right"> Cancel</a>
                                    </div>

                                </form>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-2">
                                <div class="card-header mb-2 p-2"> 
                                    <h3 class="card-title">Medicine Type List </h3>
                                </div>

                                <div class="table-responsive p-3">
                                    <table id="datatablesSimpleTwo" class="table table-bordered table-hover">
                                    <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subcategories as $key => $subcategory)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td> 
                                                    <td>{{ $subcategory->name }}</td> 
                                                        <td> 
                                                            <button type="button" class="btn btn-primary" onclick="openEditSubcategoryModal({{ $subcategory->id }}, '{{ $subcategory->name }}')">Edit</button>
                                                            <form action="{{ route('staff.delete_subcategory', $subcategory->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to DELETE?')">Delete</button>
                                                            </form>
                                                        </td>                                                    
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
        </div>
        <!-- end -->
        
        <!-- Add Medicine -->
        <div class="tab-contents {{ session('activeTab') == 'add_product' ? 'active-tab' : '' }}" id="add">
            <div class="card-body">

                <div class="row mt-3 " >
                    <div class="col-lg-12 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-2">
                                <div class="card-header mb-2 p-2"> 
                                    <h3 class="card-title">Add Medicine</h3>
                                </div>
                                

                                <form action="{{ route('staff.add_product') }}" method="post" >

                                    @csrf
                                    
                                    <div class="row g-3 px-4 mt-4">

                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-gray-200">Medicine Category</span>
                                                <select class="form-select form-control p-2" name="category">
                                                @foreach($categories as $category)
                                                     <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                 @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-gray-200">Medicine Type</span>
                                                <select class="form-select form-control p-2" name="subcategory">
                                                    @foreach($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->name }}">{{ $subcategory->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-gray-200 p-2">Product Name</span>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-gray-200 p-2">Dosage</span>
                                                <input type="text" class="form-control" name="measurement" required>
                                            </div>
                                        </div>

                                        

                                        <div class="col-md-8 mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-gray-200 p-2">Descripion</span>
                                                <textarea class="form-control "  rows="6" name="description" required></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-gray-200 p-2">Manufacturer</span>
                                                <input type="text" class="form-control" name="manufacturer" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-gray-200 p-2">Price</span>
                                                <input type="number" class="form-control" name="price" required>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-text bg-gray-200 p-2">Quantity</span>
                                                <input type="number" class="form-control" name="quantity" required>
                                            </div>
                                        </div>


                                      

                                        <div class="col-md-6 mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="requiresPrescription" name="prescription">
                                                <label class="form-check-label" for="requiresPrescription">
                                                    Requires Prescription
                                                </label>
                                            </div>
                                        </div>
                                        


                                    </div>

                                    <div class="px-4 mb-4">
                                        <button type="submit"  class="btn btn-primary">
                                        Add 
                                        </button>
                                        <a href="{{ url ('staff/home')}}" class="btn btn-danger float-right"> Cancel</a>
                                    </div>

                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end -->
        

        <!-- footer -->
        @include('components.footer')
    </div>

    

@endsection
@push('custom-scripts')
@endpush

<script>
    function openEditCategoryModal(id, name) {
        // Set the values in the modal form for categories
        document.getElementById('editCategoryId').value = id;
        document.getElementById('editCategoryName').value = name;

        // Show the modal
        var editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'), {});
        editModal.show();
    }

    function openEditSubcategoryModal(id, name) {
        // Set the values in the modal form for subcategories
        document.getElementById('editSubcategoryId').value = id;
        document.getElementById('editSubcategoryName').value = name;

        // Show the modal
        var editModal = new bootstrap.Modal(document.getElementById('editSubcategoryModal'), {});
        editModal.show();
    }

</script>

<script>
    function opentab(tabId) {
        // Remove 'active-link' from all tabs
        document.querySelectorAll('.tab-links').forEach(tab => tab.classList.remove('active-link'));
        document.querySelectorAll('.tab-contents').forEach(content => content.classList.remove('active-tab'));
    
        // Add 'active-link' to the clicked tab and 'active-tab' to the corresponding content
        document.querySelector(`.tab-links[onclick="opentab('${tabId}')"]`).classList.add('active-link');
        document.getElementById(tabId).classList.add('active-tab');
    
        // Update session data using AJAX to keep track of active tab on the server
        fetch(`/set-active-tab`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ activeTab: tabId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status !== 'success') {
                console.error('Error setting active tab:', data);
            }
        })
        .catch(error => console.error('Fetch error:', error));
    }
    </script>
    

    