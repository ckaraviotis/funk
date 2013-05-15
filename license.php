<!doctype html>
<?php 
    include_once('funk.php'); 
    include_once('markdown.php');
?>
<html>
<head>
    <title>license - funk</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
<?php echo Markdown(file_get_contents('./LICENSE.txt')) ?>
</body>

</html>