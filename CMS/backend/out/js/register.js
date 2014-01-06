var validateForm = new FormValidator ( document.querySelector ( 'form' ), {
    valid: function ( ) {
        
        document.querySelector ( '[type="submit"]' ) .disabled = false;
        document.querySelector ( '[type="submit"] figure>figcaption' ) .style.textDecoration = 'none';
        
    },
    invalid: function ( ) {
        
        document.querySelector ( '[type="submit"]' ) .disabled = true;
        document.querySelector ( '[type="submit"] figure>figcaption' ) .style.textDecoration = 'line-through';

    }
}   );