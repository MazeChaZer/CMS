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

        if ( el[ i ].nodeName.toLowerCase ( ) === 'input' )
        {

            el[ i ].addEventListener ( 'focus', function ( ) {

            if ( this.getAttribute ( 'tooltip-direction' ) !== null )
            {

                tooltip.setPosition.apply ( tooltip, [ ( this.getAttribute ( 'tooltip-direction' ) || tooltip.defaultDirection ) ] );

            }

                tooltip.toElement.apply ( tooltip, [ this ] );
                tooltip.fixed = true;

            }, false    );

            el[ i ].addEventListener ( 'blur', function ( ) {

                tooltip.fixed = false;
                tooltip.hide.apply ( tooltip );

            }, false    );

        }

        if ( parseInt ( el[ i ].getAttribute ( 'tabindex') ) === 1 )
        {
            
            el[ i ].focus ( );
            
        }
        
    } 
    
};