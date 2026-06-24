<?php
session_start();
<<<<<<< HEAD
session_unset();
session_destroy();
header("Location: ../../frontend/pages/login.php");
exit();
=======
session_destroy();
header("Location: ../../frontend/pages/login.php");
exit;
>>>>>>> 8885c56dd68b483b6724449d6273e7e3787a101e
?>
