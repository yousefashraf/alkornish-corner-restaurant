<?php
ob_start(); // Start output buffering

require 'flash.php';
include 'includes/header.php';
include 'DatabaseConnection.php';
include 'Menu.php';

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

$menu = new Menu($conn);

// Get the item ID from the URL
$itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Retrieve the item details for editing
if ($itemId > 0) {
    $item = $menu->getMenuItemById($itemId);
}

// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && $itemId > 0) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle file upload if a new image is provided
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
            $menu->updateMenuItem($itemId, $imagePath, $title, $description, $price);
        } else {
            $_SESSION['flash_message'] = 'Failed to upload image.';
        }
    } else {
        $menu->updateMenuItem($itemId, $item['image'], $title, $description, $price);
    }

    // Redirect to the add item page with a success message
    $_SESSION['flash_message'] = 'Item updated successfully!';
    header('Location: user_dashboard.php');
    exit();
}

// Retrieve the updated menu items
$menuItems = $menu->getMenuItems();
?>

<section id="menu" class="container">
    <div class="jumbotron">
        <h2 class="text-center">تعديل عنصر القائمة</h2>
    </div>

    <!-- Edit form -->
    <div class="container jumbotron mt-5">
        <h3>تعديل عنصر</h3>
        <?php
        if (isset($_SESSION['flash_message'])) {
            echo '<div class="alert alert-info">' . htmlspecialchars($_SESSION['flash_message']) . '</div>';
            unset($_SESSION['flash_message']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">صورة (اختياري)</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="title">العنوان</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($item['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">الوصف</label>
                <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($item['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">السعر (ريال)</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($item['price']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<?php ob_end_flush(); // End output buffering ?>
