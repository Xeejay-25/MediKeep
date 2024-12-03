  <!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>


<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<script>
    window.addEventListener('load', function() {
      const preloader = document.querySelector('.preloader');
      if (preloader) {
        preloader.classList.add('hidden'); 
        setTimeout(() => preloader.style.display = 'none', 500);
      }
    });
  </script>

  <script>
    var months = @json($formattedData['months'] ?? []);
    var totalSales = @json($formattedData['total_sales'] ?? []);
    var totalOrders = @json($formattedData['total_orders'] ?? []);
      
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: months, 
          datasets: [
              {
                  label: 'Total Sales',
                  data: totalSales, 
                  backgroundColor: '#1E90FF',
                  borderColor: '#333',
                  borderWidth: 1,
                  yAxisID: 'y1', 
              },
              {
                  label: 'Total Orders',
                  data: totalOrders,
                  backgroundColor: 'rgba(0, 255, 0, 0.5)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1,
                  yAxisID: 'y2', 
              }
          ]
      },
      options: {
          responsive: true,
          scales: {
              y1: {
                  beginAtZero: true,
                  ticks: {
                      color: '#fff',
                      font: {
                          size: 14,
                          family: 'Arial',
                      }
                  },
                  grid: {
                      color: 'rgba(255, 255, 255, 0.2)',
                  }
              },
              y2: {
                  beginAtZero: true,
                  ticks: {
                      color: '#fff',
                      font: {
                          size: 14,
                          family: 'Arial',
                      }
                  },
                  grid: {
                      color: 'rgba(255, 255, 255, 0.2)',
                  }
              },
              x: {
                  ticks: {
                      color: '#fff',
                      font: {
                          size: 14,
                          family: 'Arial',
                      }
                  },
                  grid: {
                      color: 'rgba(255, 255, 255, 0.2)',
                  }
              }
          },
          plugins: {
              legend: {
                  labels: {
                      color: '#fff',
                      font: {
                          size: 16,
                          family: 'Arial',
                      }
                  }
              }
          }
      }
  });
  </script>



  
  <!-- Github buttons -->
  <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
   
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

  <!-- table CJ -->
  <script src="{{ asset('assets/js/jquery3.5.1.js') }}"></script>
  <script src="{{ asset('assets/js/simple-datatables.min.js') }}"></script>

  <script src="{{asset('backend_auth/datatables.js')}}"></script>

  <!-- table built -->
  <script src="{{asset('backend_auth/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend_auth/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Tab-links -->
  <script src="{{asset('backend_auth/tab.js')}}"></script>