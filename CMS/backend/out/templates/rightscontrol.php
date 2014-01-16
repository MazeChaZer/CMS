<h2>Rechteverwaltung</h2>
<?php
$user = array ( 'Alf', 'Karl', 'Lukas', 'Lukas2', 'Schalke', 'Jönas', 'DerKönig' );
$usergroups = array ( 'Administratoren', 'Superuser', 'Roots', 'Batman' );

if ( is_null ( filter_input ( INPUT_GET, 'id' ) ) )
{
?>    
<section class="cms-table cms-full">
    <section class="cms-table-cell cms-half cms-padding">
        <ul class="cms-list">
            <h3>Benutzer</h3>
            <?php
                foreach ( $user as $u )
                {

                    print ( '<li class="cms-list-point cms-text-center cms-margin">' );
                    print ( '<a href="?id=Jönas" class="cms-list-text">' . $u . '</a>' );
                    print ( '</li>' );

                }
            ?>
        </ul>
    </section>
    <section class="cms-table-cell cms-half cms-padding">
        <ul class="cms-list">
            <h3>Benutzergruppen</h3>
            <?php
                foreach ( $usergroups as $ug )
                {
                    print ( '<li class="cms-list-point cms-text-center cms-margin">' );
                    print ( '<a href="?id=Jönas" class="cms-list-text">' . $ug . '</a>' );
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
    $rights = array (
        array ( 
            'name' => 'createPages',
            'text' => 'Der Benutzer darf Seiten erstellen',
            'value' => true,
            'disabled' => false
        ),
        array ( 
            'name' => 'useDildo',
            'text' => 'Der Benutzer darf einen Dildo benutzen',
            'value' => false,
            'disabled' => true
        ),
        array ( 
            'name' => 'mustUseDildo',
            'text' => 'Der Benutzer muss einen Dildo benutzen',
            'value' => true,
            'disabled' => true
        ) 
    );
?>
<section class="cms-margin cms-padding">
    <span class="cms-small">
        <a href="index.php">Rechte verwalten</a>
    </span>
    <span class="cms-small">&raquo;</span>
    <span class="cms-small">Rechte des Benutzers 'Jönas'</span>
</section>
<table class="cms-table cms-full cms-table-styled">
    <tbody>
        <?php
            foreach ( $rights as $r )
            {
              
                print ( '<tr>' );
                    print ( '<td class="cms-quarter"> ');
                        print ( '<span class="cms-large">' . $r[ 'text' ] . '</span> ');
                    print ( '</td>' );
                    print ( '<td>' );
                        print ( '<input type="radio" id="' . $r[ 'name' ] . '" name="cms-rights#' . $r[ 'name' ] . '" value="on" required ' . ( ( $r[ 'value' ] ) ? 'checked ' : '' ) . ( ( $r[ 'disabled' ] ) ? 'disabled ' : '' ) . '/> ');
                        print ( '<label for="' . $r[ 'name' ] . '" class="radioInput firstInput">Ja</label> ');
                        print ( '<input type="radio" id="not-' . $r[ 'name' ] . '" name="cms-rights#' . $r[ 'name' ] . '" value="off" required ' . ( ( !$r[ 'value' ] ) ? 'checked ' : '' ) . ( ( $r[ 'disabled' ] ) ? 'disabled ' : '' ) . '/> ');
                        print ( '<label for="not-' . $r[ 'name' ] . '"  class="radioInput lastInput">Nein</label> ');
                    print ( '</td>' );
                    print ( '</tr>' );
                    
            }
        ?>
    </tbody>
</table>
<?php
}
?>