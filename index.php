<?php
include('runtime.php');
session_start();
SH::reset();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>shell ?</title>
    <link rel="stylesheet" href="shell.css">
</head>
<body>
<div id="shell"></div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script type="text/javascript" src="shell.js"></script>
<script type="text/javascript">
    jQuery('document').ready(function ($) {
        shell.init($('#shell'), 'PHP CONSOLE');
        shell.execute('script.php');
    });
</script>
</body>
</html>
