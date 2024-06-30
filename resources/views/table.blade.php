<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detections Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Common styles */
        body {
            background-color: #ffffff;
            color: #0e0d0d;
            position: relative;
            overflow-x: hidden;
        }

        /* Background image with reduced blur */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/background1.png') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            opacity: 0.9;
            z-index: -1;
            filter: blur(2px);
        }

        .fuel-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .fuel-container h3 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #244B93;
        }

        th,
        td {
            border: 1px solid #244B93;
            padding: 4px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #3FA2F6;
            color: #ffffff;
        }

        td {
            background-color: #ffffff;
            color: #121314;
        }

        /* Navbar styles */
        .navbar-custom {
            background-color: #1089FF;
            color: #ffffff;
            padding: 10px 20px;
        }

        .navbar-custom .navbar-brand {
            color: #ffffff;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #ffffff;
        }

        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link:focus {
            color: #ffffff;
        }

        .action-button {
            background-color: #279EFF;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .action-button:hover {
            background-color: #009EFF;
        }

        /* Footer styles */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #96C9F4;
            color: #0e0d0d;
            padding: 10px 20px;
            text-align: center;
        }

        footer button {
            background-color: transparent;
            border: none;
            color: #0f0f0f;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        footer button:hover {
            text-decoration: underline;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">Information Truck</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <span class="welcome-message">Welcome, {{ Auth::user()->name }}!</span>
            </li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-link nav-link" style="font-weight: bold; color: white;">Logout</button>
            </form>
        </ul>
    </nav>
    <div class="fuel-container">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Jam Operasi</th>
                    <th>Fuel Level (%)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="data-table-body">
                @foreach($data as $fuel)
                <tr>
                    <td>{{ $fuel['nama'] }}</td>
                    <td>{{ $fuel['latitude'] }}</td>
                    <td>{{ $fuel['longitude'] }}</td>
                    <td>{{ $fuel['jam_operasi'] }}</td>
                    <td>{{ $fuel['persentase_bahan_bakar'] }} %</td>
                    <td><button class="btn" style="background-color: #009EFF; color: #ffffff;" onclick="goToDetectionPage('{{ $fuel['id'] }}')">Details</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <footer>
        <button onclick="goForward()">
            <i class="fas fa-arrow-right"></i>
        </button>
    </footer>
    <script>
        var existingTrucks = new Set();

        // Function to fetch and update fuel level data
        function fetchAndSetFuelLevel() {
            fetch('/api/fuel-level/latest')
                .then(response => response.json())
                .then(data => {
                    updateDataTable(data);
                })
                .catch(error => console.error('Error fetching fuel level data:', error));
        }

        // Function to fetch and update GPS data
        function fetchAndSetGPSData() {
            fetch('/api/gps/latest')
                .then(response => response.json())
                .then(data => {
                    updateGPSData(data);
                })
                .catch(error => console.error('Error fetching GPS data:', error));
        }

        // Function to update the table with new fuel level data
        function updateDataTable(data) {
            if (existingTrucks.has(data.nama)) {
                return;
            }
            existingTrucks.add(data.nama);

            var tableBody = document.getElementById('data-table-body');
            var newRow = `
                <tr>
                    <td>${data.nama}</td>
                    <td>${data.latitude}</td>
                    <td>${data.longitude}</td>
                    <td>${data.jam_operasi}</td>
                    <td>${data.persentase_bahan_bakar} %</td>
                    <td><button class="btn" style="background-color: #009EFF; color: #ffffff;" onclick="goToDetectionPage('${data.id}')">Details</button></td>
                </tr>
            `;
            tableBody.innerHTML = newRow + tableBody.innerHTML;
        }

        // Function to update the table with new GPS data
        function updateGPSData(data) {
            if (existingTrucks.has(data.nama)) {
                return;
            }
            existingTrucks.add(data.nama);

            var tableBody = document.getElementById('data-table-body');
            var newRow = `
                <tr>
                    <td>${data.nama}</td>
                    <td>${data.latitude}</td>
                    <td>${data.longitude}</td>
                    <td>${data.jam_operasi}</td>
                    <td>${data.persentase_bahan_bakar} %</td>
                    <td><button class="btn" style="background-color: #009EFF; color: #ffffff;" onclick="goToDetectionPage('${data.id}')">Details</button></td>
                </tr>
            `;
            tableBody.innerHTML = newRow + tableBody.innerHTML;
        }

        // Function to navigate to detections page
        function goToDetectionPage(id) {
            window.location.href = `/detections`; // Adjust the URL to include the id
        }

        // Set interval to update fuel level data every 5 seconds
        setInterval(fetchAndSetFuelLevel, 5000);
        // Set interval to update GPS data every 5 seconds
        setInterval(fetchAndSetGPSData, 5000);

        // Placeholder function for navigating forward
        function goForward() {
            // Implement your forward navigation logic here
        }
    </script>
</body>

</html>
