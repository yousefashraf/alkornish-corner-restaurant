<?php
require 'flash.php';
include 'includes/header.php';
include 'DatabaseConnection.php';
include 'Menu.php';

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

$menu = new Menu($conn);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . $imageName;

        // Make sure the uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the uploaded file
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $menu->insertMenuItem($imagePath, $title, $description, $price);
            $_SESSION['flash_message'] = 'Item added successfully!';
        } else {
            $_SESSION['flash_message'] = 'Failed to upload image.';
        }
    } else {
        $_SESSION['flash_message'] = 'No image uploaded or upload error.';
    }
}

// Retrieve the menu items
$menuItems = $menu->getMenuItems();
?>

<section id="menu" class="container">
    <div class="jumbotron">
        <h2 class="text-center">قائمة طعام</h2>
    </div>

    <!-- Form to add new menu items -->
    <div class="container jumbotron mt-5">
        <h3>إضافة عنصر جديد إلى القائمة</h3>
        <?php
        if (isset($_SESSION['flash_message'])) {
            echo '<div class="alert alert-info">' . htmlspecialchars($_SESSION['flash_message']) . '</div>';
            unset($_SESSION['flash_message']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">صورة</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="title">العنوان</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="العنوان" required>
            </div>
            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control" id="description" name="description" placeholder="الوصف" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">السعر (ريال)</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="السعر" required>
            </div>
            <button type="submit" class="btn btn-primary">إضافة إلى القائمة</button>
        </form>
    </div>

    <!-- Display menu items -->
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
