<?php

namespace ITC\CMS;

use ITC\CMS\Entity;

require '../core/init/settings.php';
require '../core/mvc/model.php';
require '../core/mvc/model/entities/Data.php';

$model = new Data ( );

$id = filter_input ( INPUT_GET, 'fileid' );

if ( $model->load ( $id )  !== 0 )
{

    exit();

}

header ( 'Content-Type: ' . $model->getType ( ) );

header ( 'Content-Disposition: attachment; filename="' . $model->getName ( ) . '"' );

readfile ( $model->getHash ( ) );