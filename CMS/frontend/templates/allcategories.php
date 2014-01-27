<ul>
<?php
    foreach($data['categories'] as $d)
    {
        printf('<li><a href="category/%s">%s</a></li>', $d['categoryID'], $d['bezeichnung']);
    }
?>
</ul>