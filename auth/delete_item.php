<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        .container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .section {s
            flex: 1;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .section h2 {
            margin-bottom: 10px;
        }
        .data-list {
            list-style-type: none;
            padding: 0;
        }
        .data-item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }
        button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Admin Panel</h1>

<div class="container">
    <div class="section" id="products-section">
        <h2>Products</h2>
        <ul class="data-list" id="product-list">
            <?php
            // Database credentials
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "database";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Display products
            $sql = "SELECT product_id, product_title FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li class='data-item'>";
                    echo "<strong>Product ID:</strong> " . $row["product_id"] . "<br>";
                    echo "<strong>Product Title:</strong> " . $row["product_title"] . "<br>";
                    echo "<button onclick='deleteItem(\"products\", " . $row["product_id"] . ")'>Delete</button>";
                    echo "</li>";
                }
            } else {
                echo "<li>No products found</li>";
            }

            $conn->close();
            ?>
        </ul>
    </div>

    <div class="section" id="farmers-section">
        <h2>Farmers</h2>
        <ul class="data-list" id="farmer-list">
            <?php
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Display farmers
            $sql = "SELECT farmer_id, farmer_name FROM farmerregistration";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li class='data-item'>";
                    echo "<strong>Farmer ID:</strong> " . $row["farmer_id"] . "<br>";
                    echo "<strong>Farmer Name:</strong> " . $row["farmer_name"] . "<br>";
                    echo "<button onclick='deleteItem(\"farmerregistration\", " . $row["farmer_id"] . ")'>Delete</button>";
                    echo "</li>";
                }
            } else {
                echo "<li>No farmers found</li>";
            }

            $conn->close();
            ?>
        </ul>
    </div>

    <div class="section" id="buyers-section">
        <h2>Buyers</h2>
        <ul class="data-list" id="buyer-list">
            <?php
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Display buyers
            $sql = "SELECT buyer_id, buyer_name FROM buyerregistration";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li class='data-item'>";
                    echo "<strong>Buyer ID:</strong> " . $row["buyer_id"] . "<br>";
                    echo "<strong>Buyer Name:</strong> " . $row["buyer_name"] . "<br>";
                    echo "<button onclick='deleteItem(\"buyerregistration\", " . $row["buyer_id"] . ")'>Delete</button>";
                    echo "</li>";
                }
            } else {
                echo "<li>No buyers found</li>";
            }

            $conn->close();
            ?>
        </ul>
    </div>
</div>

<script>
    // Function to delete item via AJAX
    function deleteItem(tableName, itemId) {
        if (confirm("Are you sure you want to delete this item?")) {
            // AJAX request to delete item
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'adminpanel.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status == 200) {
                    // Reload the page after deletion
                    location.reload();
                } else {
                    alert('Error deleting item');
                }
            };
            xhr.send(`action=delete&table=${tableName}&id=${itemId}`);
        }
    }
    
    // Check if delete action is triggered
    if (window.location.search.includes("action=delete")) {
        // Process delete request
        $table = $_POST['table'];
        $id = $_POST['id'];
        
        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "database";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect
