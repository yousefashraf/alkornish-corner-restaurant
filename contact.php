<?php include 'includes/header.php'; ?>

<section id="contact" class="container">
    <div class="jumbotron">
        <h2>تواصل معنا</h2>
    </div>
    <div class="container jumbotron mt-5">
        <form class="">
            <div class="form-group">
                <label for="name">الأسم</label>
                <input type="text" class="form-control" id="name" placeholder="الأسم">
            </div>
            <div class="form-group">
                <label for="email">عنوان البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" placeholder="عنوان البريد الإلكتروني">
            </div>
            <div class="form-group">
                <label for="message">رسالتك</label>
                <textarea class="form-control" id="message" rows="5" placeholder="رسالتك"></textarea>
            </div>
            <button type="submit" class="btn btn-danger">إرسال</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
