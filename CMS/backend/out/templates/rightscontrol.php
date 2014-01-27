<?php
    require 'head.php';
?>

<h2>Rechteverwaltung</h2>
<?php
$user = array ( 'Alf', 'Karl', 'Lukas', 'Lukas2', 'Schalke', 'Jönas', 'DerKönig' );
$usergroups = array ( 'Administratoren', 'Superuser', 'Roots', 'Batman' );

if ( empty($this->data['user']) )
{
?>    
<section class="cms-table cms-full">
    <section class="cms-table-cell cms-half cms-padding">
        <ul class="cms-list">
            <h3>Benutzer</h3>
            <?php
          
                foreach ( $this->data['users'] as $u )
                {
          
                    print ( '<li class="cms-list-point cms-text-center cms-margin">' );
                    printf ( '<a href="?page=rightscontrol&username=%s" class="cms-list-text">%s</a>', $u[ 'username'], $u['username'] );
                    print ( '</li>' );

                }
            ?>
        </ul>
    </section>
</section>
<?php
}
else
{
?>
<section class="cms-margin cms-padding">
    <span class="cms-small">
        <a href="index.php?page=rightscontrol">Rechte verwalten</a>
    </span>
    <span class="cms-small">&raquo;</span>
    <span class="cms-small cms-bold">Rechte des Benutzers '<?= $this->data['user'] ?>'</span>
</section>
<form action="" method="post">
    <input type="hidden" name="cms-rights#name" value="<?= $this->data['user'] ?>" />
    <table class="cms-table cms-full cms-table-styled">
        <tbody>
            <?php
                for ( $c = 0; $c < count ( $this->data ) - 1; $c++ )
                {
                    $r = $this->data[ $c ];
                    $r['disabled']=false;
                    print ( '<tr>' );
                        print ( '<td class="cms-quarter"> ');
                            print ( '<span class="cms-large">' . $r[ 'bezeichnung' ] . '</span> ');
                        print ( '</td>' );
                        print ( '<td>' );
                            print ( '<input type="radio" id="' . $r[ 'id' ] . '" name="cms-rights[' . $r[ 'id' ] . ']" value="on" required ' . ( ( $r[ 'wert' ] ) ? 'checked ' : '' ) . ( ( $r[ 'disabled' ] ) ? 'disabled ' : '' ) . '/> ');
                            print ( '<label for="' . $r[ 'id' ] . '" class="radioInput firstInput">Ja</label> ');
                            print ( '<input type="radio" id="not-' . $r[ 'id' ] . '" name="cms-rights[' . $r[ 'id' ] . ']" value="off" required ' . ( ( !$r[ 'wert' ] ) ? 'checked ' : '' ) . ( ( $r[ 'disabled' ] ) ? 'disabled ' : '' ) . '/> ');
                            print ( '<label for="not-' . $r[ 'id' ] . '"  class="radioInput lastInput">Nein</label> ');
                        print ( '</td>' );
                        print ( '</tr>' );

                }
            ?>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Speichern" />
                    <input type="reset" value="Zurücksetzen" />
                </td>
            </tr>
        </tbody>
    </table>
</form>
<?php
}
?>
<?php
    require 'footer.php';
?>