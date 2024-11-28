@extends('Backend.Layout.app')
@section('breadcrumb', 'Supplier')
@section('title', 'Staff')
@section('main-content')   
    
    <div class="container-fluid py-4">

        <div class="card-body">

            <div class="row mt-3">
                <div class="col-lg-12 mb-lg-0 mb-4 mx-auto">
                    <div class="card z-index-2">
                        <div class="card-body p-4">
                            @include('message')

                            <form action="{{ route('staff.add_supplier') }}" method="POST">
                                @csrf <!-- Include CSRF token for form submission security -->
                    
                                <div class="form-group">
                                    <label for="name">Supplier Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                                <div class="form-group">
                                    <label for="contact_info">Contact Info</label>
                                    <input type="text" class="form-control @error('contact_info') is-invalid @enderror" id="contact_info" name="contact_info">
                                    @error('contact_info')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                                <button type="submit" class="btn btn-primary">Add Supplier</button>
                                {{-- <a href="" class="btn btn-secondary">Back to List</a> --}}
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    
    </div>
    <!-- footer -->
    @include('components.footer')


@endsection
@push('custom-scripts')
@endpush