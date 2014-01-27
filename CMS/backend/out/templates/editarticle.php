<?php
    require 'head.php';
?>
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
            <?php if(@$this->data['locked']) {?>
            <p>Dieser Artikel ist zuzeit gesperrt.</p>
            <p><a href="<?php echo BACKENDURL; ?>index.php?page=articlemanager">Zurück zur Artikelübersicht</a></p>
            <?php } else { ?>
            <?php
                if(isset($this->data['new']))
                {
                    print('<h2>Neuen Artikel erstellen</h2>');
                }
                else
                {
                    print('<h2>Artikel bearbeiten</h2>');
                }
            ?>
            <section>
            <form method="post" action="<?php echo BACKENDURL; ?>index.php?page=editarticle<?php if( !isset($this->data["new"])){ ?>&amp;id=<?php echo $this->data['articledata']['entryID']; ?><?php } ?>">
                <p>
                    <label>Artikelname</label>
                    <input type="text" name="titel" class="cms-input-text" value="<?php echo $this->data['articledata']['titel']; ?>" />
                </p>
                <p>
                    <label>URL</label>
                    <input type="text" name="url" class="cms-input-text" value="<?php echo $this->data['articledata']['url']; ?>" />
                </p>
                <p>
                    <label>Artikelinhalt</label>
                    <textarea name="artikel"><?php echo $this->data['articledata']['inhalt']; ?></textarea>
                </p>
                <p class="cms-important">
                    <span>Kategorie des Artikels</span>
                    <select name="category">
                        <option></option>
                        <?php foreach($this->data['categories'] as $category) { ?>
                            <option value="<?php echo $category['categoryID']; ?>"<?php if(isset($this->data['articledata']['category']) && $this->data['articledata']['category'] == $category['categoryID']){ ?> selected="selected"<?php } ?>><?php echo $category['bezeichnung']; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <p class="cms-important">
                    <span>Dateien mit diesem Artikel verknpüfen</span>
                    <select name="anhang">
                        <option></option>
                        <?php foreach($this->data['uploads'] as $upload) { ?>
                            <option value="<?php echo $upload['dataID']; ?>"<?php if(isset($this->data['articledata']['attachment']) && $this->data['articledata']['attachment'] == $upload['dataID']){ ?> selected="selected"<?php } ?>><?php echo $upload['name']; ?></option>
                        <?php } ?>
                    </select>
                </p>
                <p>
                    <button type="submit">Speichern</button>
                    <?php
                        if ( !isset($this->data['new']) ) { ?>

                        <?php if($this->userrights[6]) { ?><form method="post" action="<?php echo BACKENDURL; ?>index.php?page=editarticle&amp;id=<?php echo $this->data['articledata']['entryID']; ?>">
							<button name="delete" value="1" type="submit">Diesen Artikel löschen</button>
                        </form><?php } ?>

                       <?php } ?>
                </p>
            </form>
            </section>
            <?php } ?>
        </section>
        <script src="out/plugins/ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('artikel');
        </script>
            <?php
//     }
    require 'footer.php';
