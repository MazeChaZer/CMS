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
                    <h2>Login</h2>
                </hgroup>
                <footer>
                    <nav>
                        <a href="<?= URL; ?>" tooltip tooltip-text="Zurück zur Homepage" tooltip-direction="left">
                            <span class="fa fa-home"></span>
                        </a>
                    </nav>
                </footer>
            </header>
                <section role="main">
                    <form action="<?= BACKENDURL; ?>index.php?page=login" method="post" autocomplete="off" accept-charset="UTF-8" target="_self">
                        <section>
                            <p>
                                <label for="cms-logindata[username]">Benutzername&nbsp;</label>
                                <input tabindex="1" type="text" name="cms-logindata#username" placeholder="Administrator" maxlength="32" required pattern="^[a-zA-Z0-9]{1,}[a-zA-Z0-9-._]{5,31}$" tooltip tooltip-direction="bottom" tooltip-text="Der Benutzername muss aus mindestens 6 Zeichen bestehen." autofocus />
                            </p>
                            <p>
                                <label for="cms-logindata[password]">Passwort&nbsp;</label>
                                <input tabindex="2" type="password" name="cms-logindata#password" placeholder="*********" maxlength="32" required pattern="^[a-zA-Z0-9._*!?#+:,;-_]{6,32}" tooltip tooltip-direction="bottom" tooltip-text="Das Passwort muss aus mindestens 6 Zeichen bestehen." />
                            </p>
                            <p class="cms-table-cell">
                                <label for="cms-logindata[keepsession]">Sitzung speichern?&nbsp;</label>
                                <input tabindex="3" type="radio" id="save-session" name="cms-logindata#keepsession" value="on" required checked />
                                <label for=Admin"save-session" class="radioInput firstInput" tooltip tooltip-direction="bottom" tooltip-text="Die Sitzung wird gespeichert (Cookies werden gesetzt)">Speichern</label>
                                <input tabindex="4" type="radio" id="not-session" name="cms-logindata#keepsession" value="off" required />
                                <label for="not-session" class="radioInput lastInput" tooltip tooltip-direction="bottom" tooltip-text="Die Sitzung wird nicht gespeichert">Nicht speichern</label>
                            </p>
                            <p class="cms-table-cell">
                                <button type="submit" tabindex="5">
                                    <figure class="fa fa-lock">
                                        <figcaption>Anmelden</figcaption>
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
        <script src="out/js/login.js"></script>
        <script src="out/js/default.js"></script>
    </body>
</html>