//default.js

var i;


// Tooltip
var tooltip = new Tooltip ( ),
    el = document.querySelectorAll ( '[tooltip]' );
         
for ( i = 0; i < el.length; i++ )
{
    el[ i ].addEventListener ( 'mouseover', function ( ) {
        if ( this.getAttribute ( 'tooltip-direction' ) !== null )
        {
            tooltip.setPosition.apply ( tooltip, [ ( this.getAttribute ( 'tooltip-direction' ) || tooltip.defaultDirection ) ] );
        }
        tooltip.toElement.apply ( tooltip, [ this ] );
    }, false	);

    el[ i ].addEventListener ( 'mouseout', function ( ) {
        tooltip.hide.apply ( tooltip );
    }, false	);       
}