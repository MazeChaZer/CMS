<?php

    require 'head.php';

    function getSize($size){
        if($size / 1024 > 1)
        {
            if($size/1024/1024>1)
            {
                return round($size/1024/1024,2).' MB';
            }
            return round($size/1024,2).' kB';
        }
        return $size.' B';
    }
?>

<h2>Meine Dateien</h2>
<section>
    <section>
        <menu>
            <nav class="cms-navigation">
                <a>
                    <figure class="cms-table-cell fa fa-cloud-upload">
                        <figcaption class="cms-table-cell">Datei hochladen</figcaption>
                    </figure>
                </a>
                <a>
                    <figure class="cms-table-cell fa fa-edit">
                        <figcaption>Datei umbenennen</figcaption>
                    </figure>
                <a>
                    <figure class="cms-table-cell fa fa-eraser">
                        <figcaption class="cms-table-cell">Ausgewählte Dateien Löschen</figcaption>
                    </figure>
                </a>
            </nav>
        </menu>
    </section>
    <section>
        <form action="?page=filemanager" method="post" enctype="multipart/form-data" class="cms-important">
            <label for="">Datei auswählen:</label>
            <p>
                <input type="file" name="cmsdata#file" />
            </p>
            <p>
                <input type="submit" value="Hochladen" />
            </p>
        </form>
    </section>
    <section>
        <table class="cms-table-styled cms-full">
            <thead>
                <tr>
                    <th></th>
                    <th>Dateiname</th>
                    <th>Dateigröße</th>
                    <th>Hinzugefügt am</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($this->data as $f) {
                        print ( '<tr>' );
                            print ( '<td><input type="checkbox" name="checkbox#" /></td>' );
                            print ( '<td>' . $f[ 'name' ] . '</td>' );
                            print ( '<td>' . getSize($f[ 'size' ]) . '</td>' );
                            print ( '<td>' . date('d.m.Y - H:i:s', strtotime($f[ 'created' ])) . '</td>' );
                        print ( '</tr>'); 
                    }
                ?>
            </tbody>
        </table>
    </section>
</section>

<?php

    require 'footer.php';

?>