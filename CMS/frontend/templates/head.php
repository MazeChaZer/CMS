<!Doctype html>
<html lang="de">
    <head>
        <base href="<?= URL ?>" />
        <link rel="stylesheet" href="frontend/css/demo.css" />
        <link href='http://fonts.googleapis.com/css?family=Great+Vibes|Roboto:400,100,300,700,500|Roboto+Condensed:400,300|Roboto+Slab' rel='stylesheet' type='text/css'>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>CMS Demo Page &bull; <?= $data['title'] ?></title>
    </head>
    <body>
        <header>
            <figure>
                <hgroup>
                    <h1>Demo CMS</h1>
                    <h2>Weil wirs können</h2>
                </hgroup>
            </figure>
        </header>
        <section role="main">
            <div class="articles">
                <div style="padding: 10px 10px 40px 10px">
                <?php
                    if(isset($data['category']) && isset($data['category']['categoryID']))
                    {
                        printf('<a href="category/%s">Alle Artikel der Kategorie "%s"</a>', $data['category']['categoryID'], $data['category']['bezeichnung']);
                    }
                ?>
                </div>
                <div>
                <h3>Neueste Artikel</h3>
                <ul>
                <?php
                    foreach($data['allarticles'] as $a)
                    {
                        printf ( '<li><a href="%s">%s</a></li>', $a[ 'URL' ], $a[ 'titel' ] );
                    }
                ?>
                </ul>
                </div>
            </div>
            <div class="main">