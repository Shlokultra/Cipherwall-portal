<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top px-4">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <div class="cyber">🛡️ CipherWall </div>
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon"
        viewBox="0 0 16 16">
        <path
          d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm3.295 3.995V11H4.104V5.995h-1.7V5H7v.994H5.295zM8.692 7.01V11H7.633V5.001h1.209l1.71 3.894h.039l1.71-3.894H13.5V11h-1.072V7.01h-.057l-1.42 3.239h-.773L8.75 7.008h-.058z" />
      </svg>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#ab">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="Report.html">Report Incident</a></li>
        <li class="nav-item"><a class="nav-link" href="fetch_virustotal.php">Threat List</a></li>
        <li class="nav-item"><a class="nav-link" href="Learn.html">Learn</a></li>
        <li class="nav-item"><a class="nav-link" href="traking.php">Track report</a></li>
        <li class="nav-item"><a class="nav-link" href="Login.html">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="Resgister.html">Sign Up</a></li>
      </ul>
    </div>
  </nav>
</body>
</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberSecure Threat Intelligence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .form-control, .btn {
            border-radius: 8px;
        }
        h4 {
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="text-center mb-4">🔍 CipherWall Threat Intelligence</h2>
    <div class="row g-4">

        <!-- Threat IP Tracker -->
        <div class="col-lg-6">
            <div class="card p-4">
                <h4 class="mb-3">Threat IP Tracker</h4>
                <form method="post">
                    <div class="mb-3">
                        <input type="text" name="ip" class="form-control" placeholder="Enter IP address" required>
                    </div>
                    <button type="submit" name="ip1" class="btn btn-danger w-100">Check IP</button>
                </form>
                <div class="mt-3">
                    <?php
                    if (isset($_POST['ip1'])) { 
                        $ip = trim($_POST['ip']);
                        // 185.220.101.4
                        $api_key = '4f1badb5f574f8b45d1b2c9616749db3f5eae63640b89eaa91245fde220f667affaa93b6bf88cc27';

                        $mysqli = new mysqli('localhost', 'root', '', 'cybersecure_db');
                        if ($mysqli->connect_error) {
                            die('<div class="alert alert-danger">Database connection error.</div>');
                        }

                        $url = "https://api.abuseipdb.com/api/v2/check?ipAddress=$ip";

                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            "Key: $api_key",
                            "Accept: application/json"
                        ]);
                        $response = curl_exec($ch);
                        curl_close($ch);

                        $data = json_decode($response, true);

                        if (isset($data['data'])) {
                            $ip_address = $data['data']['ipAddress'];
                            $score = $data['data']['abuseConfidenceScore'];
                            $country = $data['data']['countryCode'];
                            $isp = $data['data']['isp'];

                            $stmt = $mysqli->prepare("INSERT INTO threats (ip_address, confidence_score, country_code, isp) VALUES (?, ?, ?, ?)");
                            $stmt->bind_param("siss", $ip_address, $score, $country, $isp);
                            $stmt->execute();
                            $stmt->close();

                            echo "<div class='alert alert-info'><strong>IP:</strong> $ip_address <br><strong>Score:</strong> $score <br><strong>Country:</strong> $country <br><strong>ISP:</strong> $isp</div>";

                            if ($score >= 40) {
                                echo "<div class='alert alert-danger'>⚠️ High-risk IP detected!</div>";
                            }
                        } else {
                            echo "<div class='alert alert-warning'>Error fetching data for IP: $ip</div>";
                        }
                        $mysqli->close();
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Fraud Website Checker -->
        <div class="col-lg-6">
            <div class="card p-4">
                <h4 class="mb-3">Fraud Website Checker</h4>
                <form method="post">
                    <div class="mb-3">
                        <input type="url" name="url" class="form-control" placeholder="Enter website URL" required>
                    </div>
                    <button type="submit" name="url_submit" class="btn btn-primary w-100">Check Website</button>
                </form>
                <div class="mt-3">
                    <?php
                    if (isset($_POST['url_submit'])) {
                        $url_to_check = trim($_POST['url']);
                        $api_key = 'AIzaSyBZvSUHwlQLAq3fzpmKmF6a4v8aa-ba_AU';

                        $endpoint = "https://safebrowsing.googleapis.com/v4/threatMatches:find?key=$api_key";

                        $payload = json_encode([
                            "client" => [
                                "clientId" => "CyberSecure",
                                "clientVersion" => "1.0"
                            ],
                            "threatInfo" => [
                                "threatTypes" => [
                                    "MALWARE",
                                    "SOCIAL_ENGINEERING",
                                    "UNWANTED_SOFTWARE",
                                    "POTENTIALLY_HARMFUL_APPLICATION"
                                ],
                                "platformTypes" => ["ANY_PLATFORM"],
                                "threatEntryTypes" => ["URL"],
                                "threatEntries" => [
                                    ["url" => $url_to_check]
                                ]
                            ]
                        ]);

                        $ch = curl_init($endpoint);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

                        $response = curl_exec($ch);
                        curl_close($ch);

                        $result = json_decode($response, true);

                        if (!empty($result['matches'])) {
                            echo "<div class='alert alert-danger'>⚠️ Dangerous website detected!</div>";
                            foreach ($result['matches'] as $match) {
                                echo "<div class='alert alert-warning'><strong>Threat Type:</strong> {$match['threatType']}</div>";
                            }
                        } else {
                            echo "<div class='alert alert-success'>✅ This website appears safe.</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Bootstrap JS (for navbar toggle) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
