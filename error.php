<?php
$title = "Error ".$_SERVER["REDIRECT_STATUS"];
include "header.php"?>

<p class="error-header">Error
<?php
    echo $_SERVER["REDIRECT_STATUS"];
    echo str_repeat("!", substr($_SERVER["REDIRECT_STATUS"], 2));
?></h1>
<p class="error">Oh no! What have you done? You've triggered an error! That is bad! You should consider typing a valid address and then begging for my forgiveness.</p>

<?php include "footer.php"?>
