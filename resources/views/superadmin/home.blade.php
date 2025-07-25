@extends('superadmin.Backend.Layout.app')
@section('breadcrumb', 'Home')
@section('title', 'SuperAdmin')
@section('main-content')  
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

@endsection
@push('custom-scripts')
@endpush

