window.onload = function ( )
{
    //default.js

    var i, l = document.activeElement;

    // Tooltip

    var tooltip = new Tooltip ( ),
        el = document.querySelectorAll ( '[tooltip]' );
        
    tooltip.fixed = false;
        
    for ( i = 0; i < el.length; i++ )
    {
 
        if ( el[ i ].nodeName.toLowerCase ( ) === 'input' )
        {

            tooltip.bindElement.apply ( tooltip, [ el[ i ], true ] );

        }
        else
        {
            
            tooltip.bindElement.apply ( tooltip, [ el[ i ], false ] );
            
        }

        if ( parseInt ( el[ i ].getAttribute ( 'tabindex') ) === 1 )
        {
            
            el[ i ].focus ( );
            
        }
        
    } 
    
};