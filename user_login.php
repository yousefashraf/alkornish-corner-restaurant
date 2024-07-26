<?php
require 'flash.php';
include 'includes/header.php';
?>

<section id="login" class="container">
    <div class="jumbotron">
        <h2>تسجيل الدخول</h2>
    </div>
    <div class="container jumbotron mt-5">
        <?php if ($message = get_flash_message('error')): ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>
        <form action="user_login_process.php" method="post">
            <div class="form-group">
                <label for="username">الأسم</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="الأسم" required>
            </div>
            <div class="form-group">
                <label for="password">كلمة السر</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="كلمة السر" required>
            </div>
            <button type="submit" class="btn btn-danger">تسجيل دخول</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
