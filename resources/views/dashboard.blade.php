<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #00a2ff;
            color: white;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
            padding: 20px;
            border: 5px solid #007bff;
            border-radius: 10px;
            background-color: #0f0470;
            width: 100%;
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
        }

        .camera-section {
            display: flex;
            align-items: center;
            flex: 1;
            padding: 20px;
        }

        .camera-section img {
            width: 60%;
            height: 60%;
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
            border: 10px solid #007bff;
            border-radius: 10px;
        }

        .nav-link {
            font-weight: bold;
            color: white;
            /* Ubah warna teks nav-link menjadi putih */
        }

        .navbar-brand {
            margin-right: 1rem;
            color: white !important;
            /* Ubah warna teks navbar-brand menjadi putih */
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }

        @media (max-width: 576px) {
            .navbar-brand {
                margin-right: 0.5rem;
            }
        }

        .text-section {
            margin-left: 20px;
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
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            padding: 20px;
        }

        .gps-section,
        .fuel-container {
            flex: 1;
            margin: 0 20px;
        }

        /* Navbar styles */
        .navbar-custom {
            background-color: #0f0470;
            /* Background color */
            color: white;
            /* Text color */
        }

        .navbar-custom .navbar-brand {
            color: white;
            /* Brand (logo) text color */
        }

        .navbar-custom .navbar-nav .nav-link {
            color: white;
            /* Nav links text color */
        }

        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link:focus {
            color: white;
            /* Nav links text color on hover or focus */
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom bg-primary">
        <a class="navbar-brand" href="#">Informasi Truck</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <span class="welcome-message">Welcome, {{ Auth::user()->name }}!</span>
            </li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-link nav-link" style="font-weight: bold;">Logout</button>
            </form>
        </ul>
    </nav>

    <div class="dashboard-container">
        <div class="row1">
            <div class="camera-section">
                <div>
                    <h3>Camera Dashboard</h3>
                    <img src="http://127.0.0.1:5000/video_feed" alt="Camera Feed" id="cameraFeed1">
                </div>
                <div class="text-section">
                    Some text beside the camera feed. This text can include any information you want to display next to
                    the camera feed.
                    Additional information can be added here, such as instructions, status messages, or other relevant
                    data.
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
                        <p>Persentase: <span id="fuel-level"
                                style="color: #f1c40f; font-weight: bold; font-size: 24px;">0</span>%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Google Maps API initialization
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -6.2088,
                    lng: 106.8456
                },
                zoom: 12
            });

            var marker;

            // Function to fetch and update GPS data
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
                            <p>Latitude: ${data.latitude}</p>
                            <p>Longitude: ${data.longitude}</p>
                            <p>Recorded at: ${data.recorded_at}</p>
                        `;
                    })
                    .catch(error => console.error('Error fetching GPS data:', error));
            }

            // Function to fetch and update fuel level data
            function fetchAndSetFuelLevel() {
                fetch('/api/fuel-level/latest')
                    .then(response => response.json())
                    .then(data => {
                        updateGauge(data.persentase_bahan_bakar);
                    })
                    .catch(error => console.error('Error fetching fuel level data:', error));
            }

            // Function to fetch and update camera feeds (assuming you have separate endpoints for each camera)
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

            // Initialize map and start fetching data
            fetchAndSetGPSData();
            fetchAndSetFuelLevel();
            fetchAndSetCameraFeed(1); // Example for camera 1
            fetchAndSetCameraFeed(2); // Example for camera 2
            fetchAndSetCameraFeed(3); // Example for camera 3

            // Set intervals for updating data
            setInterval(fetchAndSetGPSData, 5000); // Update GPS data every 5 seconds
            setInterval(fetchAndSetFuelLevel, 5000); // Update fuel level data every 5 seconds
            setInterval(() => fetchAndSetCameraFeed(1), 10000); // Update camera 1 feed every 10 seconds
            setInterval(() => fetchAndSetCameraFeed(2), 10000); // Update camera 2 feed every 10 seconds
            setInterval(() => fetchAndSetCameraFeed(3), 10000); // Update camera 3 feed every 10 seconds
        }

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

            // Function to fetch and update fuel level data
            function fetchAndSetFuelLevel() {
                fetch('/api/fuel-level/latest')
                    .then(response => response.json())
                    .then(data => {
                        updateGauge(data.persentase_bahan_bakar);
                    })
                    .catch(error => console.error('Error fetching fuel level data:', error));
            }

            // Function to update the gauge with the fuel level
            function updateGauge(fuelLevel) {
                data.setValue(0, 1, fuelLevel);
                chart.draw(data, options);
                document.getElementById('fuel-level').textContent = fuelLevel;
            }

            // Initial fetch of fuel level data
            fetchAndSetFuelLevel();

            // Set interval to update fuel level data every 5 seconds
            setInterval(fetchAndSetFuelLevel, 5000);
        }

        // Google Maps API initialization
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

            // Function to fetch and update GPS data
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
                            <p>Latitude: ${data.latitude}</p>
                            <p>Longitude: ${data.longitude}</p>
                            <p>Recorded at: ${data.recorded_at}</p>
                        `;
                    })
                    .catch(error => console.error('Error fetching GPS data:', error));
            }

            // Function to fetch and update camera feeds (assuming you have separate endpoints for each camera)
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

            // Initialize map and start fetching data
            fetchAndSetGPSData();
            fetchAndSetCameraFeed(1); // Example for camera 1
            fetchAndSetCameraFeed(2); // Example for camera 2
            fetchAndSetCameraFeed(3); // Example for camera 3

            // Set intervals for updating data
            setInterval(fetchAndSetGPSData, 5000); // Update GPS data every 5 seconds
            setInterval(fetchAndSetFuelLevel, 5000); // Update fuel level data every 5 seconds
            setInterval(() => fetchAndSetCameraFeed(1), 10000); // Update camera 1 feed every 10 seconds
            setInterval(() => fetchAndSetCameraFeed(2), 10000); // Update camera 2 feed every 10 seconds
            setInterval(() => fetchAndSetCameraFeed(3), 10000); // Update camera 3 feed every 10 seconds
        }

        // Ensure the initMap function is called when the Google Maps API is loaded
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFwDXXqNBAqduEnpJLfkvaGWysQA9ZZxM&callback=initMap" async defer></script>
</body>

</html>
