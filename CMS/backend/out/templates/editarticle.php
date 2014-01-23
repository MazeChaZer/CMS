<?php
    require 'head.php';
?>
<h2>Artikelverwaltung</h2>
<?php
//     if(!isset($_GET['id']))
//     {
?>
<!--        <section>
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
        </section>-->
<?php
//     }
//     else
//     {
?>
        <section>
            <section>
            <form action="<?php echo BACKENDURL; ?>index.php?page=editarticle<?php if(!$this->data["new"]){ ?>&amp;id=<?php echo $this->data['articledata']['entryID']; ?><?php } ?>" method="POST">
                <p>
                    <label>Artikelname</label>
                    <input type="text" name="titel" class="cms-input-text" maxlength="32" value="<?php echo $this->data['articledata']['titel']; ?>" />
                </p>
                <p>
                    <label>Artikelinhalt</label>
                    <textarea name="artikel"><?php echo $this->data['articledata']['inhalt']; ?></textarea>
                </p>
                <p>
                    <button type="submit">Speichern</button>
                </p>
            </form>
            </section>
        </section>
        <script src="out/plugins/ckeditor/ckeditor.js"></script>
<?php
//     }
    require 'footer.php';