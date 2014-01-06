<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Admin Control Panel</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" media="handheld, projection, screen, tv" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300italic,300,400italic,500,900italic,900,700italic,700,500italic|Raleway:400,200" />
        <link rel="stylesheet" href="out/fontawesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="out/css/main.css" />
        <link rel="stylesheet" href="out/css/login.css" />
    </head>
    <body>
        <div class="cms-login">
            <header>
                <hgroup>
                    <h1>DAS CMS</h1>
                    <h2>Registrierung</h2>
                </hgroup>
                <footer>
                    <nav>
                        <a href="<?= URL; ?>" tooltip tooltip-text="Zurück zur Homepage" tooltip-direction="left">
                            <figure class="fa fa-home"></figure>
                        </a>
                        <a href="?page=login" tooltip tooltip-text="Login" tooltip-direction="right">
                            <figure class="fa fa-user"></figure>
                        </a>
                    </nav>
                </footer>
            </header>
                <section role="main">
                    <form action="<?= BACKENDURL; ?>index.php?page=register" method="post" autocomplete="off" accept-charset="UTF-8" target="_self">
                        <section>
                            <p>
                                <label for="cms-registerdata#username">gewünschter Benutzername&nbsp;</label>
                                <input tabindex="1" type="text" name="cms-registerdata#username" placeholder="Administrator" maxlength="32" required pattern="^[a-zA-Z0-9]{1,}[a-zA-Z0-9-._]{5,31}$" tooltip tooltip-direction="bottom" tooltip-text="Der Benutzername muss aus mindestens 6 Zeichen bestehen." />
                            </p>
                            <p>
                                <label for="cms-registerdata#password">gewünschtes Passwort&nbsp;</label>
                                <input tabindex="2" type="password" name="cms-registerdata#password" placeholder="*********" maxlength="32" required pattern="^[a-zA-Z0-9._*!?#+:,;-_]{6,32}" tooltip tooltip-direction="bottom" tooltip-text="Das Passwort muss aus mindestens 6 Zeichen bestehen." />
                            </p>
                            <p>
                                <label for="cms-registerdata#email">E-Mail Adresse:&nbsp;</label>
                                <input tabindex="3" type="email" name="cms-registerdata#email" placeholder="admin@cms.de" maxlength="64" required pattern="^[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" tooltip tooltip-direction="bottom" tooltip-text="Bitte eine gültige E-Mail Adresse eintragen." />
                            </p>
                            <p class="cms-text-right cms-full">
                                <button type="submit" tabindex="5" class="cms-full">
                                    <figure class="fa fa-key">
                                        <figcaption>Registrieren</figcaption>
                                    </figure>
                                </button>
                            </p>
                        </section>
                    </form>
                </section>
        </div>
        <footer>
                <span>&copy; 2013 Menschen</span>
        </footer>
        <script src="out/js/objects.js"></script>
        <script src="out/js/register.js"></script>
        <script src="out/js/default.js"></script>
    </body>
</html>