 <!-- START PAGE CONTENT-->
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 <div class="page-heading">
   <h1 class="page-title">Dashboard</h1>
   <ol class="breadcrumb">
     <li class="breadcrumb-item">
       <a href="index.html"><i class="la la-home font-20"></i></a>
     </li>
   </ol>
 </div>
 <div class="page-content fade-in-up">
   <div class="row">
     <div class="col-md-3 col-sm-6 col-12">
       <div class="info-box bg-info">
         <span class="info-box-icon"><i class="fa-solid fa-newspaper"></i></span>
         <div class="info-box-content">
           <span class="info-box-text">Articles</span>
           <span class="info-box-number">{{ $articleCount }}</span>
         </div>
       </div>
     </div>

     <div class="col-md-3 col-sm-6 col-12">
       <div class="info-box bg-primary">
         <span class="info-box-icon"><i class="fa fa-pencil"></i></span>
         <div class="info-box-content">
           <span class="info-box-text">Widgets</span>
           <span class="info-box-number">{{ $widgetCount }}</span>
         </div>
       </div>
     </div>



     <div class="col-md-3 col-sm-6 col-12">
       <div class="info-box bg-warning">
         <span class="info-box-icon"><i class="fa-solid fa-hashtag"></i></span>
         <div class="info-box-content">
           <span class="info-box-text">Issues</span>
           <span class="info-box-number">{{ $issueCount }}</span>
         </div>
       </div>
     </div>

     <div class="col-md-3 col-sm-6 col-12">
       <div class="info-box bg-danger">
         <span class="info-box-icon"><i class="fa-solid fa-phone-volume"></i>
         </span>
         <div class="info-box-content">
           <span class="info-box-text">Volumes</span>
           <span class="info-box-number">{{ $volumeCount }}</span>
         </div>
       </div>
     </div>

     <div class="col-md-3 col-sm-6 col-12">
       <div class="info-box bg-success">
         <span class="info-box-icon"><i class="fa-solid fa-eye"></i></span>
         <div class="info-box-content">
           <span class="info-box-text">Total Views</span>
           <span class="info-box-number">{{ $totalViews }}</span>
         </div>
       </div>
     </div>

     <div class="col-md-3 col-sm-6 col-12">
       <div class="info-box bg-danger">
         <span class="info-box-icon"><i class="fa-solid fa-download"></i></span>
         <div class="info-box-content">
           <span class="info-box-text">Total Download</span>
           <span class="info-box-number">{{ $totalDownloads }}</span>
         </div>
       </div>
     </div>

   </div>

   <div class="row">
     <div class="col-md-6 col-sm-12 col-12">
       <div class="card">
         <div class="card-header">
           <h5>Daily Articles Downloads</h5>
         </div>
         <div class="card-body">
           <canvas id="downloadChart" height="200" width="300"></canvas>
         </div>
       </div>

       <script>
         const downloadLabels = @json($labels); // e.g. ['Apr 19', 'Apr 20', ...]
         const downloadData = @json($downloadData); // e.g. [10, 5, 0, 3, ...]

         new Chart(document.getElementById('downloadChart'), {
           type: 'line',
           data: {
             labels: downloadLabels,
             datasets: [{
               label: 'Downloads',
               data: downloadData,
               borderColor: 'rgba(75, 192, 192, 1)',
               backgroundColor: 'rgba(75, 192, 192, 0.2)',
               fill: true,
               tension: 0.4,
             }]
           },
           options: {
             responsive: true,
             scales: {
               y: {
                 beginAtZero: true
               }
             }
           }
         });
       </script>
     </div>

     <div class="col-md-6 col-sm-12 col-12">
       <div class="card">
         <div class="card-header">
           <h5>Daily Articles View </h5>
         </div>
         <div class="card-body">
           <canvas id="viewsChart" height="200" width="300"></canvas>
         </div>
       </div>

       <script>
         const viewsLabels = @json($vlabels); // e.g. ['Apr 19', 'Apr 20', ...]
         const viewsData = @json($viewsData); // e.g. [10, 5, 0, 3, ...]

         new Chart(document.getElementById('viewsChart'), {
           type: 'line',
           data: {
             labels: viewsLabels,
             datasets: [{
               label: 'Views',
               data: viewsData,
               borderColor: 'rgb(192, 75, 114)',
               backgroundColor: 'rgba(192, 75, 134, 0.2)',
               fill: true,
               tension: 0.4,
             }]
           },
           options: {
             responsive: true,
             scales: {
               y: {
                 beginAtZero: true
               }
             }
           }
         });
       </script>
     </div>

   </div>

 <div class="clearfix "></div> <br>
   <div class="row">
    <div class="col-md-6">
     <div class="card">
       <div class="card-header bg-success text-white">Top 10 Locations by Downloads</div>
       <div class="card-body">
         <canvas id="LocationDownloadChart"></canvas>
       </div>
     </div>
    </div>
    <div class="col-md-6">
     <div class="card">
       <div class="card-header bg-primary text-white">Top 10 Locations by Views</div>
       <div class="card-body">
         <canvas id="locationViewChart"></canvas>
       </div>
     </div>
   </div>
   </div>

   <script>
    // Chart for Downloads
    const downloadCtx = document.getElementById('LocationDownloadChart').getContext('2d');
    new Chart(downloadCtx, {
        type: 'bar',
        data: {
            labels: @json($locationLabelsDownload),
            datasets: [{
                label: 'Downloads',
                data: @json($locationDownloadData),
                backgroundColor: 'rgba(40, 167, 69, 0.7)', // green
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Download Count'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Top 10 Locations by Downloads'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            }
        }
    });

    // Chart for Views
    const viewCtx = document.getElementById('locationViewChart').getContext('2d');
    new Chart(viewCtx, {
        type: 'bar',
        data: {
            labels: @json($locationLabelsView),
            datasets: [{
                label: 'Views',
                data: @json($locationViewData),
                backgroundColor: 'rgba(0, 123, 255, 0.7)', // blue
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'View Count'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Top 10 Locations by Views'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            }
        }
    });
   </script>

 </div>
 <!-- END PAGE CONTENT-->