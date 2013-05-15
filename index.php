<!doctype html>
<?php 
    include('funk.php'); 
    include_once('markdown.php');
?>
<html>
    <head>
        <title>funk</title>
        <link rel="stylesheet" href="main.css">
        <meta charset="utf-8">
    </head>
    
    <body>
            <header>
                <h1>funk</h1>
            </header>
            
           <!-- <nav>
                <ul>
                    <li><a href="./">Home</a></li>
                    <li><a href="./readme.php">Readme</a></li>
                    <li><a href="./license.php">License</a></li>
                    <li><a href="./changelog.php">Changelog</a></li>
                    <li><a href="#">Download Latest Version</a></li>
                </ul>
            </nav> -->

            <section style="background-color: #f00; font-size: 8px;">
                <header>
                    DEBUG
                </header>
                <pre>
                <?php print($pl_enabled); ?>
                </pre>
            </section>
            
            <section>
                <?php echo GetAllPosts(); ?>           
            </section>
            
            <aside>
                <a href='#' onclick='ToggleAllPosts()'>Show all posts</a>
            </aside>
            
            <footer>
                <ul>
                    <li>Copyright &copy; YourNameGoesHerePal, 2016</li>
                    <li><a href="http://validator.w3.org/check?uri=referer">HTML</a> &bull; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></li>
                    <li><?php echo funkTag(); ?></li>
                </ul>
            </footer>
    </body>
</html>
