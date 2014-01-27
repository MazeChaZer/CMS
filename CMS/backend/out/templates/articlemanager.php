<?php
    require 'head.php';
?>
<h2>Artikelverwaltung</h2>
<section class="cms-padding">
    <?php if($this->userrights[4]) { ?><a href="?page=editarticle">
        <button>
            <figure class="fa fa-file cms-text-center fa-2x">
                <figcaption class="cms-xsmall">Neuen Artikel erstellen</figcaption>
            </figure>
        </button>
    </a><?php } ?>
</section>
<?php
    if ( empty ( $this->data ) )
    {
        print ( '<p>Bislang existieren noch keine Artikel.</p>' );
    }
    else
    {
?>
<table class="cms-full cms-table-styled">
    <thead>
        <tr>
            <th>Titel</th>
            <th>URL</th>
            <th>Erstellt am</th>
            <th>Zuletzt Editiert am</th>
            <?php if($this->userrights[5]) { ?><th></th><?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ( $this->data[ 'articles' ] as $data )
            {
                print ( '<tr>' );
                    printf ( '<td>%s</td>', $data[ 'titel' ] );
                    printf ( '<td>/%s</td>', $data[ 'URL' ] );
                    printf ( '<td>%s</td>', date ( 'd.m.Y - H:i:s', strtotime( $data[ 'dateCreated' ] ) ) );
                    if($data['dateEdited'] == NULL){
						$dateEdited = "Noch nie";
                    } else {
						$dateEdited = date ( 'd.m.Y - H:i:s', strtotime ( $data[ 'dateEdited' ] ) );
                    }
                    printf ( '<td>%s</td>', $dateEdited);
if($this->userrights[5]) {
                    if ( isset($data['locked']) && $data['lockedBy'] != $_SESSION['user'])
                    {
                        printf ( '<td><button class="fa fa-lock"></button></td>' );
                    }
                    elseif ( isset($data['locked']))
                    {
						printf ( '<td><a href="?page=editarticle&id=%s">Editieren (noch geöffnet)</a></td>', $data['entryID'] );
                    }
                    else
                    {
                        printf ( '<td><a href="?page=editarticle&id=%s">Editieren</a></td>', $data['entryID'] );
                    }
}
                print ( '</tr>' );
            }
        ?>
    </tbody>
</table>
<?php
    }
    require 'footer.php';