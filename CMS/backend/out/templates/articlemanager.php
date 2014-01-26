<?php
    require 'head.php';
?>
<h2>Artikelverwaltung</h2>
<section class="cms-padding">
    <a href="?page=editarticle">
        <button>
            <figure class="fa fa-file cms-text-center fa-2x">
                <figcaption class="cms-xsmall">Neuen Artikel erstellen</figcaption>
            </figure>
        </button>
    </a>
</section>
<?php
    if ( empty ( $this->data ) )
    {
        print ( '<p>Bislang existieren noch keine Artikel.</p>' );
    }
    else
    {
        var_dump ( $this->data );
?>
<table class="cms-full cms-table-styled">
    <thead>
        <tr>
            <th>Title</th>
            <th>Erstellt am</th>
            <th>Zuletzt Editiert am</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ( $this->data as $data )
            {
                print ( '<tr>' );
                    printf ( '<td>%s</td>', $data[ 'titel' ] );
                    printf ( '<td>%s</td>', $data[ 'dateCreated' ] );
                    printf ( '<td>%s</td>', $data[ 'dateEdited' ] );
                print ( '</tr>' );
            }
        ?>
    </tbody>
</table>
<?php
    }
    require 'footer.php';