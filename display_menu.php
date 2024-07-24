<?php
include 'includes/header.php';
include 'DatabaseConnection.php';
include 'Menu.php';

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

$menu = new Menu($conn);
$menuItems = $menu->getMenuItems(); // Fetch the menu items as an array

?>

<section id="menu" class="container">
    <div class="jumbotron">
        <h2 class="text-center">قائمة طعام</h2>
    </div>

    <div class="container jumbotron mt-5">
        <div class="row">
            <?php
            if (!empty($menuItems)) {
                foreach ($menuItems as $item) {
                    echo '<div class="col-sm-6 col-md-4 mb-4">';
                    echo '    <div class="card">';
                    echo '        <img src="' . htmlspecialchars($item["image"]) . '" class="card-img-top rounded-circle p-2" alt="' . htmlspecialchars($item["title"]) . '">';
                    echo '        <div class="card-body text-center">';
                    echo '            <h5 class="card-title">' . htmlspecialchars($item["title"]) . '</h5>';
                    echo '            <p class="card-text">' . htmlspecialchars($item["description"]) . '</p>';
                    echo '            <p class="card-text"><strong>' . htmlspecialchars($item["price"]) . ' ريال</strong></p>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }

            $dbConnection->closeConnection();
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
