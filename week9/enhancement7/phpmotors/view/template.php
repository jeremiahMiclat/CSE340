<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>
        <?php 
        if (isset($page_title)) {
            echo $page_title . ' | Php Motors';
        }
        elseif (isset($page_heading)) {
            echo $page_heading . ' | Php Motors';
        }

        
        else {
            echo "PHP Motors";
        }
        
        ?>

        </title>
        <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
        <meta name="viewport" content="width=device=width, initial-scale=1.0">
    </head>
    <body>
        <div id="wrapper">
            <header>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
            </header>
            <nav id="navigation">
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; ?>
            </nav>
            <main>
                <h1>
                    <?php 
                    if (isset($page_heading)) {
                
                echo $page_heading;
                    }
                    else {
                        echo "Content Title Here";
                    }
                ?>
                </h1>
                <?php 
                    if (isset($page_content)) {
                
                echo $page_content;
                    }
                    else {
                        echo "";
                    }
                ?>
            </main>
            <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
            </footer>
            
        </div> 
    </body>
</html>