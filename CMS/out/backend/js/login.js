var validateForm = new FormValidator ( document.querySelector ( 'form' ), {
    valid: function ( ) {
        
        document.querySelector ( '[type="submit"]' ) .disabled = false;
        document.querySelector ( '[type="submit"] figure' ) .setAttribute ( 'class', 'fa fa-unlock-alt' );
        document.querySelector ( '[type="submit"] figure>figcaption' ) .style.textDecoration = 'none';
        
    },
    invalid: function ( ) {
        
        document.querySelector ( '[type="submit"]' ) .disabled = true;
        document.querySelector ( '[type="submit"] figure' ) .setAttribute ( 'class', 'fa fa-lock' );
        document.querySelector ( '[type="submit"] figure>figcaption' ) .style.textDecoration = 'line-through';

    }
}   );

var formLayer, loginForm = new AjaxForm ( document.querySelector ( 'form' ), {
    init: function ( ) {

        formLayer = new Layer ( {
            parent: document.body,
            type: 0
        }   );
        
    },
    submit: function ( ) {
       
        formLayer.show.apply ( formLayer );
        
    },
    success: function ( e, r ) {
        
        formLayer.hide.apply ( formLayer );
        document.write ( e );
        
    },
    error: function ( e ) {
    
        formLayer.hide.apply ( formLayer );
        
    }
}   );