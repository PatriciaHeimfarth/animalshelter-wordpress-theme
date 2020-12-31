<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body> 
    <header class="header">
        <nav class="main-navigation-container">
            <a href="index.html"></a>

            <?php
            wp_nav_menu(   $arg = array(
                'menu_class' => 'main-navigation',
                'theme_location' => 'primary'
            ) )
            ?>

        </nav>

    </header>

 