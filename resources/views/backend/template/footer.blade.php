 <footer class="footer">
     <div class="container-fluid">
         <nav class="pull-left">
             <ul class="nav">
                 <li class="nav-item">
                     <a class="nav-link" href="https://www.themekita.com">
                         ThemeKita
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">
                         Help
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">
                         Licenses
                     </a>
                 </li>
             </ul>
         </nav>
         <div class="copyright ml-auto">
             2018, made with <i class="fa fa-heart heart text-danger"></i> by <a
                 href="https://www.themekita.com">ThemeKita</a>
         </div>
     </div>
 </footer>
 </div>
 </div>

 <!--   Core JS Files   -->
 <script src="{{ asset('atlantis/assets/js/core/jquery.3.2.1.min.js') }}"></script>
 <script src="{{ asset('atlantis/assets/js/core/popper.min.js') }}"></script>
 <script src="{{ asset('atlantis/assets/js/core/bootstrap.min.js') }}"></script>

 <!-- jQuery UI -->
 <script src="{{ asset('atlantis/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
 <script src="{{ asset('atlantis/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

 <!-- jQuery Scrollbar -->
 <script src="{{ asset('atlantis/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

 <!-- Chart JS -->
 <script src="{{ asset('atlantis/assets/js/plugin/chart.js/chart.min.js') }}"></script>

 <!-- jQuery Sparkline -->
 <script src="{{ asset('atlantis/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

 <!-- Chart Circle -->
 <script src="{{ asset('atlantis/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

 <!-- Bootstrap Notify -->
 <script src="{{ asset('atlantis/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

 <!-- Sweet Alert -->
 <script src="{{ asset('atlantis/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

 <!-- Atlantis JS -->
 <script src="{{ asset('atlantis/assets/js/atlantis.min.js') }}"></script>

 <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>


 <script>
     Circles.create({
         id: 'circles-1',
         radius: 45,
         value: 60,
         maxValue: 100,
         width: 7,
         text: 5,
         colors: ['#f1f1f1', '#FF9E27'],
         duration: 400,
         wrpClass: 'circles-wrp',
         textClass: 'circles-text',
         styleWrapper: true,
         styleText: true
     })

     Circles.create({
         id: 'circles-2',
         radius: 45,
         value: 70,
         maxValue: 100,
         width: 7,
         text: 36,
         colors: ['#f1f1f1', '#2BB930'],
         duration: 400,
         wrpClass: 'circles-wrp',
         textClass: 'circles-text',
         styleWrapper: true,
         styleText: true
     })

     Circles.create({
         id: 'circles-3',
         radius: 45,
         value: 40,
         maxValue: 100,
         width: 7,
         text: 12,
         colors: ['#f1f1f1', '#F25961'],
         duration: 400,
         wrpClass: 'circles-wrp',
         textClass: 'circles-text',
         styleWrapper: true,
         styleText: true
     })

     var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

     var mytotalIncomeChart = new Chart(totalIncomeChart, {
         type: 'bar',
         data: {
             labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
             datasets: [{
                 label: "Total Income",
                 backgroundColor: '#ff9e27',
                 borderColor: 'rgb(23, 125, 255)',
                 data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
             }],
         },
         options: {
             responsive: true,
             maintainAspectRatio: false,
             legend: {
                 display: false,
             },
             scales: {
                 yAxes: [{
                     ticks: {
                         display: false //this will remove only the label
                     },
                     gridLines: {
                         drawBorder: false,
                         display: false
                     }
                 }],
                 xAxes: [{
                     gridLines: {
                         drawBorder: false,
                         display: false
                     }
                 }]
             },
         }
     });

     $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
         type: 'line',
         height: '70',
         width: '100%',
         lineWidth: '2',
         lineColor: '#ffa534',
         fillColor: 'rgba(255, 165, 52, .14)'
     });
 </script>


 </body>

 </html>
