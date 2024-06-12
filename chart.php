<body>
    <?php
    // Database connection (adjust with your own database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aiims";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to count submissions per country
    $sql = "SELECT residence_country AS country, COUNT(*) as count FROM abstracts GROUP BY residence_country";
    echo $sql;
    exit;
    $result = $conn->query($sql);

    $countryData = [];
    while ($row = $result->fetch_assoc()) {
        $countryData[] = $row;
    }

    // Sort the data by count in descending order
    usort($countryData, function ($a, $b) {
        return $b['count'] - $a['count'];
    });

    // Get top 6 countries and group the rest into "Others"
    $topCountries = array_slice($countryData, 0, 6);
    $otherCount = array_reduce(array_slice($countryData, 6), function ($carry, $item) {
        return $carry + $item['count'];
    }, 0);

    if ($otherCount > 0) {
        $topCountries[] = ['country' => 'Others', 'count' => $otherCount];
    }

    // Prepare data for Chart.js
    $countries = array_column($topCountries, 'country');
    $counts = array_column($topCountries, 'count');

    $conn->close();
    ?>

    <div class="container">
        <canvas id="countryChart" width="400" height="200"></canvas>
    </div>
    <script>
        const ctx = document.getElementById('countryChart').getContext('2d');
        const countryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($countries); ?>,
                datasets: [{
                    label: 'Number of Submissions',
                    data: <?php echo json_encode($counts); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>