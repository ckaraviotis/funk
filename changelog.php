<!doctype html>
<?php 
    include_once('funk.php'); 
    include_once('markdown.php');
?>
<html>
<head>
    <title>changelog - funk</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
<?php echo Markdown(file_get_contents('./changelog.txt')) ?>
</body>

</html>