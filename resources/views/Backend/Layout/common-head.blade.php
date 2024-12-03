<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
<link rel="icon" type="image/png" href="{{ asset('assets/img/Logo_1.png') }}">
<title>
  MediKeep
</title>
<!-- Fonts and icons -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<!-- Nucleo Icons -->
<link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
<!-- Font Awesome Icons -->

{{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

<!-- CSS Files -->
<link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
<!-- table -->
<link rel="stylesheet" href="{{ asset('backend_auth/dataTables.bootstrap4.min.css') }}">
<!-- Tab-links -->
<link rel="stylesheet" href="{{ asset('backend_auth/tab.css') }}">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .status-circle {
      display: inline-block;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: grey; /* Default color */
      margin-right: 10px;
  }
  .pending {
      background-color: red;
  }
  .intransit {
      background-color: yellow;
      border: 1px solid black; /* To make the yellow color stand out */
  }
  .delivered {
      background-color: green;
  }
</style>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2VC6FKHTT6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2VC6FKHTT6');
    </script>