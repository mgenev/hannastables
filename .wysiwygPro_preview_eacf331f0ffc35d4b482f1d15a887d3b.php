<?php
if ($_GET['randomId'] != "bBVIaRrSQwX2pQenDzTMQZ2uVW4xIU3EVsPm3dVfBuzvWRWIQDH9AropTULJ2tdw") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
