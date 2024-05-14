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
        .section {
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
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            overflow: hidden; /* Ensure images fit within containers */
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
        img {
            max-width: 100%; /* Ensure images are responsive */
            height: auto;
            margin-top: 10px; /* Add margin above image */
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

            // Process product deletion if requested
            if (isset($_POST['delete_product'])) {
                $productTitle = $_POST['product_title'];

                // SQL to delete product
                $sql = "DELETE FROM products WHERE product_title = '$productTitle'";

                if ($conn->query($sql) === TRUE) {
                    echo "Product deleted successfully";
                } else {
                    echo "Error deleting product: " . $conn->error;
                }
            }

            // Display products with images
            $sql = "SELECT product_id, product_title, product_image FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li class='data-item'>";
                    echo "<strong>Product ID:</strong> " . $row["product_id"] . "<br>";
                    echo "<strong>Product Title:</strong> " . $row["product_title"] . "<br>";
                    
                    // Display product image if available
                    $imagePath = '../admin/product_images/' . $row["product_image"];
                    if (!empty($row["product_image"]) && file_exists($imagePath)) {
                        echo "<img src='$imagePath' alt='Product Image'>";
                    } else {
                        echo "<em>No image available</em>";
                    }
                    
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='product_title' value='" . $row["product_title"] . "'>";
                    echo "<button type='submit' name='delete_product'>Delete</button>";
                    echo "</form>";
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
            // Create connection (reuse $conn variable)
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Process farmer deletion if requested
            if (isset($_POST['delete_farmer'])) {
                $farmerName = $_POST['farmer_name'];

                // SQL to delete farmer
                $sql = "DELETE FROM farmerregistration WHERE farmer_name = '$farmerName'";

                if ($conn->query($sql) === TRUE) {
                    echo "Farmer deleted successfully";
                } else {
                    echo "Error deleting farmer: " . $conn->error;
                }
            }

            // Display farmers
            $sql = "SELECT farmer_id, farmer_name FROM farmerregistration";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li class='data-item'>";
                    echo "<strong>Farmer ID:</strong> " . $row["farmer_id"] . "<br>";
                    echo "<strong>Farmer Name:</strong> " . $row["farmer_name"] . "<br>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='farmer_name' value='" . $row["farmer_name"] . "'>";
                    echo "<button type='submit' name='delete_farmer'>Delete</button>";
                    echo "</form>";
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
            // Create connection (reuse $conn variable)
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Process buyer deletion if requested
            if (isset($_POST['delete_buyer'])) {
                $buyerName = $_POST['buyer_name'];

                // SQL to delete buyer
                $sql = "DELETE FROM buyerregistration WHERE buyer_name = '$buyerName'";

                if ($conn->query($sql) === TRUE) {
                    echo "Buyer deleted successfully";
                } else {
                    echo "Error deleting buyer: " . $conn->error;
                }
            }

            // Display buyers
            $sql = "SELECT buyer_id, buyer_name FROM buyerregistration";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li class='data-item'>";
                    echo "<strong>Buyer ID:</strong> " . $row["buyer_id"] . "<br>";
                    echo "<strong>Buyer Name:</strong> " . $row["buyer_name"] . "<br>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='buyer_name' value='" . $row["buyer_name"] . "'>";
                    echo "<button type='submit' name='delete_buyer'>Delete</button>";
                    echo "</form>";
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

</body>
</html>
