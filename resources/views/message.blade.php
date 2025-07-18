@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 z-index-1000" role="alert" 
         style="max-width: 90%; color: #fff; padding: 10px 40px 10px 20px; word-wrap: break-word; white-space: normal;">
        <span>{{ session('success') }}</span>
        <button type="button" data-dismiss="alert" aria-label="Close" 
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: none; color: #fff; font-size: 1.5rem;">
            &times;
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show translate-middle-x mt-3 z-index-1000" role="alert" 
         style="max-width: 90%; color: #fff; padding: 10px 40px 10px 20px; word-wrap: break-word; white-space: normal;">
        <span>{{ session('error') }}</span>
        <button type="button" data-dismiss="alert" aria-label="Close" 
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: none; color: #fff; font-size: 1.5rem;">
            &times;
        </button>
    </div>
@endif







