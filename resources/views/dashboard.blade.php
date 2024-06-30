<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ffffff;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/background3.jpg') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            opacity: 0.3;
            z-index: -1;
            filter: blur(1px);
        }

        .dashboard-section {
            margin-bottom: 20px;
        }

        .dashboard-section h3 {
            margin-bottom: 30px;
            font-size: 28px;
            color: #f2f6fa;
            text-align: center;
            margin-top: 10px;
        }

        .dashboard-section img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 1px;
        }

        .row1 {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 20px;
            flex-wrap: wrap;
        }

        .camera-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            padding: 10px;
            text-align: center;
        }

        .camera-section img {
            width: 80%;
            height: auto;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .camera-section h3 {
            margin-right: 20px;
        }

        .dashboard-section p {
            font-size: 16px;
            color: #ccc;
            margin-bottom: 20px;
        }

        .gauge-container {
            width: 200px;
            height: 200px;
            margin: auto;
        }

        .fuel-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .fuel-container h3 {
            margin-bottom: 20px;
        }

        #map {
            height: 400px;
            width: 100%;
            margin-bottom: 20px;
            border: 10px solid #3FA2F6;
            border-radius: 10px;
        }

        .nav-link {
            font-weight: bold;
            color: white !important;
        }

        .navbar-brand {
            margin-right: 1rem;
            color: white !important;
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            color: white !important;
        }

        @media (max-width: 576px) {
            .navbar-brand {
                margin-right: 0.5rem;
            }
        }

        .text-section {
            margin-top: 20px;
            text-align: center;
            max-width: 400px;
        }

        .fuel-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #fuel-level-data {
            margin-top: 10px;
            font-size: 18px;
        }

        .row2 {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            padding: 20px;
            flex-wrap: wrap;
        }

        .gps-section,
        .fuel-container {
            flex: 1;
            margin: 20px 0;
            text-align: center;
        }

        .camera-section h3,
        .gps-section h3,
        .fuel-container h3 {
            color: #14279B;
            font-weight: bold;
        }

        .navbar-dark.bg-brown {
            background-color: #1089FF;
        }

        .navbar-dark.bg-brown .navbar-brand,
        .navbar-dark.bg-brown .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .navigation-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
            padding-left: 20px;
        }

        .navigation-buttons {
            text-align: center;
        }

        .navigation-buttons .btn {
            margin: 0 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3FA2F6;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .navigation-buttons .btn:hover {
            background-color: #3FA2F6;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #96C9F4;
            color: #ffffff;
            padding: 10px 20px;
            text-align: center;
        }

        footer button {
            background-color: transparent;
            border: none;
            color: #1b1818;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        footer button:hover {
            text-decoration: underline;
        }

        .undefined-value {
            color: #BE1C2Ded;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-brown">
        <a class="navbar-brand" href="#">Informasi Truck</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <span class="welcome-message" style="color: #ffffff">Welcome, {{ Auth::user()->name }}!</span>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link" style="font-weight: bold;">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    <div class="dashboard-container">
        <div class="row1">
            <div class="camera-section">
                <div>
                    <h3>Camera Dashboard</h3>
                    <img src="http://127.0.0.1:5000/video_feed" alt="Camera Feed" id="cameraFeed1">
                </div>
            </div>
        </div>

        <div class="row2">
            <div class="col-md-5 gps-section">
                <h3>GPS Data</h3>
                <div id="map"></div>
                <div id="gps-data">
                    <!-- GPS data will be populated here -->
                </div>
            </div>

            <div class="fuel-container">
                <h3>Bahan Bakar</h3>
                <div class="fuel-content">
                    <div id="gauge_chart" class="gauge-container"></div>
                    <div id="fuel-level-data">
                        <p style=" font-weight: bold;">Persentase: <span id="fuel-level"
                                style="color: #14279B; font-weight: bold; font-size: 24px;">0</span>%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <button onclick="goBack()">
            <i class="fas fa-arrow-left"></i>
            <span></span>
        </button>
    </footer>

    <script>
        // Google Charts API initialization
        google.charts.load('current', {
            'packages': ['gauge']
        });
        google.charts.setOnLoadCallback(initGauge);

        function initGauge() {
            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['Fuel Level', 0]
            ]);

            var options = {
                width: 200,
                height: 200,
                redFrom: 0,
                redTo: 20,
                yellowFrom: 20,
                yellowTo: 50,
                greenFrom: 50,
                greenTo: 100,
                minorTicks: 5
            };

            var chart = new google.visualization.Gauge(document.getElementById('gauge_chart'));

            chart.draw(data, options);

            function fetchAndSetFuelLevel() {
                fetch('/api/fuel-level/latest')
                    .then(response => response.json())
                    .then(data => {
                        updateGauge(data.persentase_bahan_bakar);
                    })
                    .catch(error => console.error('Error fetching fuel level data:', error));
            }

            function updateGauge(fuelLevel) {
                data.setValue(0, 1, fuelLevel);
                chart.draw(data, options);
                document.getElementById('fuel-level').textContent = fuelLevel;
            }

            fetchAndSetFuelLevel();
            setInterval(fetchAndSetFuelLevel, 5000);
        }

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -6.2088,
                    lng: 106.8456
                },
                zoom: 12,
                mapTypeId: 'roadmap',
                mapTypeControl: true,
                fullscreenControl: true,
                streetViewControl: true,
                zoomControl: true
            });
            var marker;

            function fetchAndSetGPSData() {
                fetch('/api/gps/latest')
                    .then(response => response.json())
                    .then(data => {
                        var position = {
                            lat: parseFloat(data.latitude),
                            lng: parseFloat(data.longitude)
                        };

                        if (!marker) {
                            marker = new google.maps.Marker({
                                position: position,
                                map: map,
                                title: 'Lokasi GPS'
                            });
                        } else {
                            marker.setPosition(position);
                        }

                        map.setCenter(position);

                        document.getElementById('gps-data').innerHTML = `
                            <p><strong>Latitude:</strong> ${data.latitude}</p>
                            <p><strong>Longitude:</strong> ${data.longitude}</p>
                            <p><strong>Recorded at:</strong> ${data.recorded_at}</p>
                        `;
                    })
                    .catch(error => console.error('Error fetching GPS data:', error));
            }

            fetchAndSetGPSData();
            setInterval(fetchAndSetGPSData, 5000);
        }

        function fetchAndSetCameraFeed(cameraId) {
            fetch(`http://localhost:8000/camera/${cameraId}`)
                .then(response => {
                    if (response.ok) {
                        return response.blob();
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(blob => {
                    const imgUrl = URL.createObjectURL(blob);
                    document.getElementById(`cameraFeed${cameraId}`).src = imgUrl;
                })
                .catch(error => console.error(`Error fetching camera ${cameraId} feed:`, error));
        }

        google.maps.event.addDomListener(window, 'load', initMap);

        function goForward() {
            // Add your forward navigation logic here
            // Example:
            // window.location.href = '/next-page';
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3eELrNG2INVdv3B0TYQIlPbjO-ERa6FA&callback=initMap" async
        defer></script>
</body>

</html>
