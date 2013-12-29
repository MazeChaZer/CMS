<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Admin Control Panel</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" media="handheld, projection, screen, tv" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300italic,300,400italic,500,900italic,900,700italic,700,500italic|Raleway:400,200" />
        <link rel="stylesheet" href="out/fontawesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="out/css/main.css" />
        <link rel="stylesheet" href="out/css/acp.css" />
    </head>
    <body>
        <div class="cms-acp">
            <header>
                <nav>
                    <a class="fa fa-home" tooltip tooltip-text="Frontend" tooltip-direction="bottom" href="<?= BASEURL ?>" target="_blank"></a>  
                    <a class="fa fa-sign-out" tooltip tooltip-text="Logout" tooltip-direction="bottom" href="?page=logout"></a> 
                </nav>
                <menu role="menu">
                    <nav role="navigation" role="presentation">
                        <a href="?templates">
                            <span class="fa fa-desktop"></span>
                            Menüpunkt1
                        </a>
                        <a href="?inhalte">
                            <span class="fa fa-file-text"></span>
                            Menüpunk2
                        </a>
                        <a href="?module">
                            <span class="fa fa-puzzle-piece"></span>
                            Menüpunk3
                        </a>
                        <a href="?dateien">
                            <span class="fa fa-cloud-upload"></span>
                            Menüpunk4
                        </a>
                        <a href="?einstellungen">
                            <span class="fa fa-cogs"></span>
                            Menüpunkt5
                        </a>
                    </nav>
                </menu>
            </header>
            <section role="main">
                <section>
                    Hier muss dann der Inhalt rein
                </section>
            </section>
            <footer>
                <span>&copy; 2013 WIR</span>
            </footer>
        </div>
    </body>
</html>