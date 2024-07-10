<?php
include 'db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM produit WHERE 
        assets LIKE '%$search%' OR 
        description LIKE '%$search%' OR 
        `Inventory-method` LIKE '%$search%' OR 
        SN LIKE '%$search%' OR 
        location LIKE '%$search%' OR 
        user LIKE '%$search%' OR 
        `Purchase-Date` LIKE '%$search%' OR 
        Warranty LIKE '%$search%' OR `category` LIKE '%$search%'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Magazain Yazaki IT</title>
    <script type="text/javascript">
        function confirmDelete() {
            return confirm("Êtes-vous sûr de vouloir supprimer ce produit ?");
        }
    </script>
</head>
<body>
<style>.logo {
  height: 50px;
}</style>

<div class="container">

<div class="header">
        <img src="logo.png" alt="Logo" class="logo">
        <form method="GET" action="" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Search..."  value="<?php echo $search; ?>" required>
            <button type="submit" class="button-1 search-button">
            <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <h1>Products List</h1>
    <a href="create.php" class="button button-add">Ajouter un produit</a>

    <table>
        <tr>
            <th>Asset Number</th>
            <th>Description</th>
            <th>Inventory Method</th>
            <th>Serial Number</th>
            <th>Location</th>
            <th>User</th>
            <th>Purchase Date</th>
            <th>Warranty</th>
            <th>category</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["assets"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["Inventory-method"] . "</td>";
                echo "<td>" . $row["SN"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["user"] . "</td>";
                echo "<td>" . $row["Purchase-Date"] . "</td>";
                echo "<td>" . $row["Warranty"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>
                        <a href='update.php?id=" . $row["assets"] . "' class='button button-edit'>Edit</a> 
                        <a href='delete.php?id=" . $row["assets"] . "' class='button button-delete' onclick='return confirmDelete()'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Aucun produit trouvé</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
