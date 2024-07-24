<?php
include 'DatabaseConnection.php';
include 'Menu.php';

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

$menu = new Menu($conn);

// Sample data
$data = [
    ["image" => "/assets/images/1.jpeg", "title" => "كرسبي أجنحة", "description" => "8 قطع . صوص . كاتشب . بطاطس", "price" => 15],
    ["image" => "/assets/images/2.jpeg", "title" => "روبيان جامبو", "description" => "8 قطع روبيان . ثوم . صوص . بطاطس", "price" => 34],
    ["image" => "/assets/images/3.jpeg", "title" => "ميني بروستد", "description" => "2 قطع دجاد . ثوم . بطاطس . خبز", "price" => 14],
    ["image" => "/assets/images/4.jpg", "title" => "بروستد دجاج", "description" => "4 قطع دجاد . ثوم . حمص . بطاطس . خبز", "price" => 21],
    ["image" => "/assets/images/5.jpg", "title" => "روبيان عادي", "description" => "10 قطع روبيان . ثوم او صوص . بطاطس . خبز", "price" => 24],
    ["image" => "/assets/images/6.jpg", "title" => "فيليه دجاج", "description" => "5 قطع دجاد . ثوم . حمص . بطاطس . خبز", "price" => 19],
    ["image" => "/assets/images/7.jpg", "title" => "فيليه سمك", "description" => "4 قطع سمك . ثوم . حمص . بطاطس . خبز", "price" => 24],
    ["image" => "/assets/images/16.jpeg", "title" => "مسحب", "description" => "10 قطع مسحب . ثوم او صوص . بطاطس . خبز", "price" => 17],
    ["image" => "/assets/images/9.jpeg", "title" => "وجبة برجر", "description" => "برجر دجاج . صوص . بطاطس", "price" => 15],
    ["image" => "/assets/images/11.jpeg", "title" => "ميني برجر", "description" => "برجر دجاج", "price" => 7],
    ["image" => "/assets/images/10.jpeg", "title" => "وجبة ناجيتس", "description" => "ناجيتس دجاج . صوص . بطاطس .مشروب", "price" => 15],
    ["image" => "/assets/images/12.jpeg", "title" => "كرسبي الكورنيش", "description" => "دجاج . صوص جبن", "price" => 15],
    ["image" => "/assets/images/8.jpeg", "title" => "بطاطس بالجبن", "description" => "بطاطس بصوص الجبن", "price" => 9],
    ["image" => "/assets/images/13.jpeg", "title" => "أرز", "description" => "طبق أرز بسمتي", "price" => 7],
    ["image" => "/assets/images/14.jpeg", "title" => "اصابع الجبن", "description" => "5 حبات", "price" => 12],
    ["image" => "/assets/images/15.jpeg", "title" => "ايس كريم", "description" => "ايس كريم كوب", "price" => 5]
];

foreach ($data as $item) {
    $menu->insertMenuItem($item['image'], $item['title'], $item['description'], $item['price']);
}

$dbConnection->closeConnection();

echo "Data inserted successfully.";
?>
