<?php
session_start();

// تدمير جميع بيانات الجلسة
session_unset();
session_destroy();

// إعادة توجيه المستخدم إلى صفحة login
header('Location: login.php');
exit();
?>
