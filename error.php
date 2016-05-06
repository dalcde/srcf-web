<?php
$title = "Error ".$_SERVER["REDIRECT_STATUS"];
include "header.php"?>

<p class="error-header">Error
<?php
    echo $_SERVER["REDIRECT_STATUS"];
?></p>
<p class="error">You have probably done something bad.</p>

<?php include "footer.php"?>
