<?php

session_destroy();
echo "Çıkış yapılıyor...";
header("refresh:2;url=index.php");