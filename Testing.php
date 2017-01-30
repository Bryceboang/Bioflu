<?php

// get MySQL service configuration from Bluemix
$services = getenv("VCAP_SERVICES");

$serviceOK = true;

if (empty($services)) {
    echo "<p>'VCAP_SERVICES' is not defined!</p>";
    $serviceOK = false;
} else {
    $services_json = json_decode($services, true);
    if (!array_key_exists("cleardb", $services_json)){
        echo "<p>'cleardb' is not defined!</p>";
        $serviceOK = false;
    } else {
        $cleardb_service = $services_json["cleardb"];
        if (!is_array($cleardb_service)) {
            echo "<p>'cleardb_service' is NOT an array!</p>";
            $serviceOK = false;
        } elseif (count($cleardb_service) <= 0) {
            echo "<p>'cleardb_service' is an empty array!</p>";
            $serviceOK = false;
        } else {
            $serviceDetails = $cleardb_service[0];
            if(array_key_exists("credentials", $serviceDetails)) {

                $db_config = $serviceDetails["credentials"];
                $uri = $db_config["uri"];
                $db = $db_config["name"];
                $host = $db_config["hostname"];
                $port = $db_config["port"];
                $username = $db_config["username"];
                $password = $db_config["password"];

                echo $db_config["name"];
                echo "              ";
                echo $db_config["hostname"];
                  echo "              ";
                echo $db_config["port"];
                  echo "              ";
                echo $db_config["username"];
                  echo "              ";
                echo $db_config["password"];

            } else {
                echo "<p>'credentials' is not defined!</p>";
                $serviceOK = false;
            }
        }
    }
}

if (!$serviceOK) {
    echo "<p>The ClearDB service is not defined!</p>";
} else {
    try {
        $dbh = new \PDO("mysql:host=$host;dbname=$db;port=$port",$username,$password);
        echo "<p>The PDO DB connection is OK!</p>";
    } catch (PDOException $e) {
        echo '<p>PDO Connection failed: ' . $e->getMessage(). '</p>';
    }

    $mysqli = new \mysqli($host, $username, $password, $db);
    /*
     * Use this instead of $connect_error if you need to ensure
     * compatibility with PHP versions prior to 5.2.9 and 5.3.0.
     */
    if (mysqli_connect_error()) {
        echo '<p>mysqli Connection failed: ' . mysqli_connect_error(). '</p>';
    } else {
        echo 'Success... ' . $mysqli->host_info . "\n";
        $mysqli->close();
    }
}

 ?>
