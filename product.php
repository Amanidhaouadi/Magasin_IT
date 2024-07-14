
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yazaki Tech Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
        }
        .product-cell {
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            vertical-align: top;
        }
        .product-cell img {
            max-width: 150px;
            height: auto;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        .product-description {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Yazaki Tech Products</h1>
        <table class="product-table">
            <tr>
                <td class="product-cell">
                    <img src="image/hpcopac.jpg" alt="Product 1" >
                    <div class="product-name">Computer HP COMPAQ 3120 PRO</div>
                    <div class="product-description"></div>
                </td>
                <td class="product-cell">
                    <img src="path/to/image2.jpg" alt="Product 2">
                    <div class="product-name">Product 2</div>
                    <div class="product-description">Description for product 2</div>
                </td>
                <td class="product-cell">
                    <img src="path/to/image3.jpg" alt="Product 3">
                    <div class="product-name">Product 3</div>
                    <div class="product-description">Description for product 3</div>
                </td>
            </tr>
            <tr>
                <td class="product-cell">
                    <img src="path/to/image4.jpg" alt="Product 4">
                    <div class="product-name">Product 4</div>
                    <div class="product-description">Description for product 4</div>
                </td>
                <td class="product-cell">
                    <img src="path/to/image5.jpg" alt="Product 5">
                    <div class="product-name">Product 5</div>
                    <div class="product-description">Description for product 5</div>
                </td>
                <td class="product-cell">
                    <img src="path/to/image6.jpg" alt="Product 6">
                    <div class="product-name">Product 6</div>
                    <div class="product-description">Description for product 6</div>
                </td>
            </tr>
            <!-- Add more rows as needed -->
        </table>
    </div>
    
</body>
</html>
