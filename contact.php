<?php session_start(); ?>s
<?php include 'includes/header.php'; ?>

<section id="contact" class="container">
    <div class="jumbotron">
        <h2>تواصل معنا</h2>
    </div>
    <div class="container jumbotron mt-5">
        <?php
        if (isset($_SESSION['flash_message'])) {
            echo '<div class="alert alert-info">' . htmlspecialchars($_SESSION['flash_message']) . '</div>';
            unset($_SESSION['flash_message']);
        }
        ?>
        <form method="POST" action="submit_contact.php">
            <div class="form-group">
                <label for="name">الأسم</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="الأسم" required>
            </div>
            <div class="form-group">
                <label for="email">عنوان البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="عنوان البريد الإلكتروني" required>
            </div>
            <div class="form-group">
                <label for="message">رسالتك</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="رسالتك" required></textarea>
            </div>
            <button type="submit" class="btn btn-danger">إرسال</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>