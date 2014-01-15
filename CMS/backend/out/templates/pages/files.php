<?php

$files = array (
  array (
      'name' => 'datei.docx',
      'size' => '9000gb',
      'created' => '11.11.1111'
  ),
  array ( 
      'name' => 'dennis_dobslaf_nackt.jpg',
      'size' => '10kb',
      'created' => 'wann immer dennis es wollte'
  ),
  array ( 
      'name' => 'Jan_niklas_SCHALKE.mp3',
      'size' => '0b',
      'created' => 'im Suff'
  )
    
);

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
                    foreach($files as $f) {
                        print ( '<tr>' );
                            print ( '<td><input type="checkbox" name="checkbox#" /></td>' );
                            print ( '<td>' . $f[ 'name' ] . '</td>' );
                            print ( '<td>' . $f[ 'size' ] . '</td>' );
                            print ( '<td>' . $f[ 'created' ] . '</td>' );
                        print ( '</tr>'); 
                    }
                ?>
            </tbody>
        </table>
    </section>
</section>