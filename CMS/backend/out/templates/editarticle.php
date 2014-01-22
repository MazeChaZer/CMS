<?php
    require 'head.php';
?>
<h2>Artikelverwaltung</h2>
<?php
    if(!isset($_GET['id']))
    {
?>
        <section>
            <section>
                <table class="cms-table-styled cms-full" id="uploaderTable">
                    <thead>
                        <tr>
                            <th>Artikelname</th>
                            <th>Erstelldatum</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </section>
        </section>
<?php
    }
    else
    {
?>
        <section>
            <section>
                <p>
                    <label>Artikelname</label>
                    <input type="text" class="cms-input-text" maxlength="32" pattern="^[_.A-Za-z0-9]$"/>
                </p>
                <p>
                    <label>Artikelinhalt</label>
                    <textarea name="artikel"></textarea>
                </p>
            </section>
        </section>
        <script src="out/plugins/ckeditor/ckeditor.js"></script>
<?php
    }
    require 'footer.php';