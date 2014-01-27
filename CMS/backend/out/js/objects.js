/* Layer */
var Layer = function ( o )
{

    var fn = this;
    
    //vars
    this.options = o;
    
    //init
    this.init = function ( )
    {
        
        this.object = document.createElement ( 'div' );
          this.object.setAttribute ( 'style', 'position: absolute; left: 0; top: 0; width: 100%; height: 100%; z-index: 99999; ' );

        this.container = document.createElement ( 'div' );

        this.textObject = document.createElement ( 'section' );
          this.textObject.setAttribute ( 'class', 'text' );
          this.textObject.setAttribute ( 'style', 'position: relative; width: 100% ' );

        this.controlObject = document.createElement ( 'section' );
          this.controlObject.setAttribute ( 'class', 'control' );
          this.controlObject.setAttribute ( 'style', 'position: relative; width: 100% ' );

          if ( this.options.class !== null)
          {

              this.object.setAttribute ( 'class', this.options.class );

          }

        this.container.appendChild ( this.textObject );
        this.container.appendChild ( this.controlObject );

        this.object.appendChild ( this.container );

        this.options.parent.appendChild ( this.object );

        this.textObject.style.height = ( this.container.offsetHeight - 52 ) + 'px';
        this.controlObject.style.height = '52px';
        
        this.switchType.apply ( this, [ this.options.type ] );
        
        this.hide.apply ( this );
        
    };
    
    // fns
    this.show = function ( )
    {
                           
        this.object.style.display = 'block';
    
    };
    
    this.hide = function ( )
    {
    
        this.object.style.display = 'none';
    
    };
    
    this.html = function ( h, t )
    {
        
        this.textObject.innerHTML = '<h2>Warnung</h2>';
        
        if ( t )
        {
        
            this.textObject.innerHTML = '<h2>' + t + '</h2>';
            
        }
       
        this.textObject.innerHTML += h;
    
    };
    
    this.switchType = function ( t, text, ft )
    {
       
        this.clearButtons.apply ( this );
      
        switch ( t )
        {
    
            case 1:
        
                this.addButton.apply ( this, [ ( ( text && text[ 0 ] ) ? text[ 0 ] : 'Okay' ), ( ( ft ) ? ft : null ) ] );

                break;
                
            case 2:
              
                this.addButton.apply ( this, [ ( ( text && text[ 0 ] ) ? text[ 0 ] : 'Ja' ), ( ( ft && ft[ 0 ] ) ? ft[ 0 ] : null ) ] );
                this.addButton.apply ( this, [ ( ( text && text[ 1 ] ) ? text[ 1 ] : 'Nein' ), ( ( ft && ft[ 1 ] ) ? ft[ 1 ] : null ) ] );
                
                break;
        }
        
        this.object.focus ( );
        
    };
    
    this.clearButtons = function ( )
    {
      
        this.controlObject.innerHTML = '';
        
    };
    
    this.addButton = function ( t, fa )
    {
    
        var b = document.createElement ( 'button' );
            b.type = 'button';
            b.appendChild ( document.createTextNode ( t ) );
            
            if ( fa )
            {

                b.onclick = fa;

            }
            else
            {

                b.onclick = function ( ) {

                    fn.hide.apply ( fn );

                    return false;

                };
                
                document.body.addEventListener ( 'keydown', function ( e ) {
                    
                    if ( fn.object.style.display !== 'none' && ( e.keyCode === 13 || e.keyCode === 27 ) )
                    {
                        
                        fn.hide.apply ( fn );
                                
                        return false;
                        
                    };
                    
                }, false   );

            }
            
        this.controlObject.appendChild ( b );
    
    };
    
    //
    this.init.apply ( this );

};

/* FormValidator */
var FormValidator = function ( f, o )
{

    var fn = this;

    // vars
    this.object = null;
    this.options = null;

    this.valid = false;

    // init
    this.init = function ( f, o )
    {

        this.object = f;
        this.options = o;

        this.setEvents.apply ( this );
        this.validate.apply ( this );

        console.log ( 'FormValidator mit Zielobjekt ' + this.object + ' initialisiert.' );

    };

    // fns
    this.validate = function ( )
    {

        var i, _v = 0;

        this.children = this.object.querySelectorAll ( 'input:not([type="submit"]):not([type="reset"]):not([type="button"])' );

        for ( i = 0; i < this.children.length; i++ )
        {

            this.children[ i ].setAttribute ( 'valid', this.children[ i ].checkValidity ( ) );

        }

        if ( this.object.checkValidity ( ) )
        {

            this.object.setAttribute ( 'valid', true );
            this.isValid.apply ( this );

        }
        else
        {

            this.object.setAttribute ( 'valid', false );
            this.isInvalid.apply ( this );

        }

    };

    this.setEvents = function ( )
    {
                    
        this.object.addEventListener ( 'keydown', function ( ) {

            fn.validate.apply ( fn );

        }, false   );

        this.object.addEventListener ( 'keyup', function ( ) {

            fn.validate.apply ( fn );

        }, false   );

        this.object.addEventListener ( 'change', function ( ) {

            fn.validate.apply ( fn );

        }, false   );

        this.object.addEventListener ( 'submit', function ( ) {
            
            if ( fn.valid === false )
            {
                
                return false;
                
            }
            
        },false   );

    };

    this.isValid = function ( )
    {

        this.valid = true;

        if ( this.options.valid && this.options.valid !== null )
        {

            this.options.valid.apply ( this );

        }

    };

    this.isInvalid = function ( )
    {

        this.valid = false;

        if ( this.options.invalid && this.options.invalid !== null )
        {

            this.options.invalid.apply ( this );

        }

    };

    //
    this.init.apply ( this, [ f, o ] );

};

/* Tooltip */
var Tooltip = function ( )
{

    var fn = this;

    //vars
    this.object = null;
    this.textContainer = null;
    this.textContent = null;

    this.visible = false;

    this.width = 0;
    this.height = 0;


    // user specific
    this.class = 'cms-tooltip';
    this.arrowClass = 'cms-tooltip-arrow';
    this.containerClass = 'cms-tooltip-container';
    
    this.position = 'top';
    this.margin = [ 6, 4 ];
    this.defaultDirection = 'bottom'; //top || right || bottom || left

    this.arrowWidth = 10;
    this.arrowStyle = 'rgb( 33, 33, 33 )';

    //init
    this.init = function ( )
    {

        this.object = document.createElement ( 'div' );
            this.object.setAttribute ( 'class', this.class );
            this.object.setAttribute ( 'style', 'position: absolute; left: 0; top: 0; z-index: 999 ' );

        this.arrow = document.createElement ( 'div' );
            this.arrow.setAttribute ( 'class', this.arrowClass );
            
        this.container = document.createElement ( 'div' );
            this.container.setAttribute ( 'class', this.containerClass );
        
        this.textContainer = document.createElement ( 'span' );

        this.fixed = false;

        this.hide.apply ( this );

        this.object.appendChild ( this.arrow );
        this.object.appendChild ( this.container );
        
        this.container.appendChild ( this.textContainer );

        document.body.appendChild ( this.object );

        console.log ( 'Tooltip mit Zielobjekt ' + this.object + ' erfolgreich initialisiert und in das DOM eingetragen.' );

    };

    //fns
    this.reposition = function ( x, y, w, h )
    {

        this.show.apply ( this );
            this.width = this.object.offsetWidth;
            this.height = this.object.offsetHeight;
        this.hide.apply ( this );

        var l = t = 0; // left, top
        
        this.object.innerHTML = '';
        
        switch ( this.position )
        {

            default: case 'top':

                l = x - ( ( w > this.width ) ? (-1) * ( w - this.width - ( w - this.width ) / 2 ) : this.width - w ) / 2;
                t = y - this.height - this.margin[ 1 ];
                
                this.arrow.style.borderWidth = this.arrowWidth + 'px ' + this.arrowWidth + 'px 0 ' + this.arrowWidth + 'px';
                this.arrow.style.float = 'none';
                this.arrow.style.top = 0;
                this.arrow.style.margin = '0 0 0 ' + ( ( this.width / 2 ) - this.arrowWidth ) + 'px';
                this.arrow.style.display = this.container.style.display = 'block';
                this.arrow.style.borderColor = this.arrowStyle + ' transparent transparent transparent';
                
                this.object.appendChild ( this.container );
                this.object.appendChild ( this.arrow );
                
                break;

            case 'bottom':

                l = x - ( ( w > this.width ) ? (-1) * ( w - this.width  - ( w - this.width ) / 2 ) : this.width - w ) / 2;
                t = y + h + this.margin[ 1 ];
                
                this.arrow.style.borderWidth = '0 ' + this.arrowWidth + 'px ' + this.arrowWidth + 'px ' + this.arrowWidth + 'px';
                this.arrow.style.float = 'none';
                this.arrow.style.top = 0;
                this.arrow.style.margin = '0 0 0 ' + ( ( this.width / 2 ) - this.arrowWidth ) + 'px';
                this.arrow.style.display = this.container.style.display = 'block';
                this.arrow.style.borderColor = 'transparent transparent ' + this.arrowStyle + ' transparent';

                this.object.appendChild ( this.arrow );
                this.object.appendChild ( this.container );

                break;

            case 'left':

                l = x - this.width - this.margin[ 0 ];
                t = y - ( ( h > this.height ) ? h - this.height : this.height - h );

                this.arrow.style.borderWidth = this.arrowWidth + 'px 0 ' + this.arrowWidth + 'px ' + this.arrowWidth + 'px';
                this.arrow.style.top = ( ( this.height / 2 ) - this.arrowWidth ) + 'px';
                this.arrow.style.margin = 0;
                this.arrow.style.float = 'right';
                this.arrow.style.borderColor = 'transparent transparent transparent ' + this.arrowStyle;
                
                this.container.style.marginRight = this.arrowWidth + 'px';
                
                this.object.appendChild ( this.arrow );
                this.object.appendChild ( this.container );

                break;

            case 'right':

                l = x + w + this.margin[ 0 ];
                t = y - ( ( h > this.height ) ? h - this.height : this.height - h );

                this.arrow.style.borderWidth = this.arrowWidth + 'px ' + this.arrowWidth + 'px ' + this.arrowWidth + 'px 0';
                this.arrow.style.top = ( ( this.height / 2 ) - this.arrowWidth ) + 'px';
                this.arrow.style.margin = 0;
                this.arrow.style.float = 'left';
                this.arrow.style.borderColor = 'transparent ' + this.arrowStyle + ' transparent transparent';

                this.container.style.marginLeft = this.arrowWidth + 'px';

                this.object.appendChild ( this.arrow );
                this.object.appendChild ( this.container );

                break;

        }

        this.object.style.left = l + 'px';
        this.object.style.top = ( t + document.body.scrollTop ) + 'px';

    };

    this.toggle = function ( )
    {

        if ( this.visible )
        {

            this.hide.apply ( this );

        }
        else
        {

            this.show.apply ( this );

        }

    };

    this.show = function ( )
    {

        this.visible = true;
        this.object.style.display = 'block';

    };

    this.hide = function ( )
    {
       
        if ( !this.fixed )
        {
           
            this.visible = false;
            this.object.style.display = 'none';

        }

    };

    this.setText = function ( t )
    {

        this.textContent = t;

        this.textContainer.innerHTML = this.textContent;

    };

    this.toElement = function ( e )
    {
        if ( !this.fixed )
        {
            
            var pos = e.getBoundingClientRect ( );
            
            this.setText.apply ( this, [ e.getAttribute ( 'tooltip-text' ) ] );
            this.reposition.apply ( this, [ pos.left, pos.top, e.offsetWidth, e.offsetHeight ] );
            this.show.apply ( this );

        }

    };

    this.setPosition = function ( p )
    {

        if ( p.match('^(top|bottom|left|right){1}$') !== null )
        {

            this.position = p;

        }
        else
        {

            console.log ( 'Falsche Positionsangabe. Erlaubt: top, right, bottom left' );

            return false;

        }

    };
    
    this.bindElement = function ( e, f )
    {
      
        e.addEventListener ( 'mouseover', function ( ) {

            if ( this.getAttribute ( 'tooltip-direction' ) )
            {

                fn.setPosition.apply ( fn, [ ( this.getAttribute ( 'tooltip-direction' ) || fn.defaultDirection ) ] );

            }

            fn.toElement.apply ( fn, [ this ] );

        }, false	);

        e.addEventListener ( 'mouseout', function ( ) {

            fn.hide.apply ( fn );

        }, false	);

        if ( f )
        {

            e.addEventListener ( 'focus', function ( ) {

                if ( this.getAttribute ( 'tooltip-direction' ) )
                {

                    fn.setPosition.apply ( fn, [ ( this.getAttribute ( 'tooltip-direction' ) || fn.defaultDirection ) ] );

                }

                fn.toElement.apply ( fn, [ this ] );
                fn.fixed = true;

            }, false    );

            e.addEventListener ( 'blur', function ( ) {

                fn.fixed = false;
                fn.hide.apply ( fn );

            }, false    );

        }
        
    };

    //
    this.init.apply ( this );

};

/* ObjectGlower */
var ObjectGlower = function ( obj )
{
 
    var fn = this;
    
    // vars
    this.object = obj;
    
    this.position = [ 0, -10 ];

    this.interval = null;
    

    // user specific
    this.direction = 0;
    
    this.minPositions = [ -8, -8 ];
    this.maxPositions = [ 8, 8 ];
    
    this.timer = 105;

    this.color = 'rgba( 0, 0, 0, .7 )';
    this.blur = 20;
    this.offset = 0;

    // init
    this.init = function ( )
    {

        console.log ( 'ObjectGlower mit Zielobjekt ' + this.object + ' initialisiert.' );

    };

    this.beginGlowing = function ( )
    {
 
        this.interval = window.setInterval ( function ( )
        {
            
            switch ( fn.direction )
            {
                
                case 0: default:
                        
                        fn.position[ 0 ]++;
                        fn.position[ 1 ]++;
                        
                        if ( fn.position[ 0 ] === fn.maxPositions[ 0 ] )
                        {
                            
                            fn.direction = 1;
                            
                        }
                        
                        break;
                        
                    case 1:
                        
                        fn.position[ 0 ]--;
                        fn.position[ 1 ]++;
                        
                        if ( fn.position[ 1 ] === fn.maxPositions[ 1 ] )
                        {
                            
                            fn.direction = 2;
                            
                        }
                        
                         break;
                         
                    case 2:
                        
                        fn.position[ 0 ]--;
                        fn.position[ 1 ]--;
                        
                        if ( fn.position[ 0 ] === fn.minPositions[ 0 ] )
                        {
                            
                            fn.direction = 3;
                            
                        }
                        
                        break;
                        
                    case 3:
                        
                        fn.position[ 0 ]++;
                        fn.position[ 1 ]--;
                        
                        if ( fn.position[ 1] === fn.minPositions[ 1 ] )
                        {
                            
                            fn.direction = 0;
                            
                        }
                        
                        break;
                
            }

            fn.object.style[ 'box-shadow' ] = fn.position[ 0 ] + 'px ' + fn.position[ 1 ] + 'px ' + fn.blur + 'px ' + fn.offset + 'px ' + fn.color + ', inset ' + ( -1 ) * fn.position[ 0 ] + 'px ' + ( -1 ) * fn.position[ 1 ] + 'px ' + Math.round ( fn.blur * 2 ) + 'px ' + Math.round ( fn.offset * 2 ) + 'px ' + fn.color;
 
        }, this.timer   );
        
    };

    this.stop = function ( )
    {

        window.clearInterval ( this.interval );

    };
    
    //
    this.init.apply ( this );
    
};

// AjaxRequest 
var AjaxRequest = function ( ) 
{ 
                             
    var fn = this; 
    
    //vars                         
    this.request = false; 
    this.status = null; 
    this.requestParams = { 
        dataType: 'text' 
    }; 
   
    if( typeof XMLHttpRequest != 'undefined' ) 
    {
  
      this.request = new XMLHttpRequest ( ); 
   
    }
   
    if( ! this.request ) 
    { 
  
        try 
        { 
    
            this.request = new ActiveXObject ( 'Msxml12.XMLHTTP' ); 
    
        } 
        catch ( e ) 
        { 
   
            try 
            { 
    
                this.request = new ActiveXObject ( 'Microsoft.XMLHTTP' ); 
    
            } 
            catch ( e ) 
            { 
    
                this.request = null; 
    
            } 
   
        } 
  
    } 

    //fns
    this.send = function ( params ) 
    { 
   
        this.requestParams.dataType = 'text'; 
    
        this.requestParams = params; 
         
        this.request.open( ( params.type || 'get' ) , ( params.url || '/' ), ( params.syncType || true ) );
        this.request.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' ); 
      
        this.request.send( ( params.data || null ) ); 
        this.request.onreadystatechange = this.readyStateChange; 
   
    }; 
  
    this.readyStateChange = function ( e ) 
    { 
        
      fn.readyState = this.readyState; 
  
        if ( this.readyState == 4 && fn.requestParams.complete ) 
        {
        
          var response = null; 
                    
          switch ( fn.requestParams.dataType.toLowerCase( ) ) 
          { 
    
              case 'text': default: 
              
                  response = this.responseText; 
              
                  break; 
     
              case 'xml': 
              
                  response = this.responseXML; 
     
                 break; 
     
              case 'json': 
              
                if ( this.responseText && this.responseText.length > 0 )  
                {          
            
                    try 
                    {
                    
                        response = eval ( '(' + this.responseText + ')' ); 
                  
                    }
                    catch ( e )
                    {
                    
                        console.log ( this.responseText );
                        
                        response = { success: false, errorMessage: 'Es trat ein Fehler bei der Übertragung auf. Bitte Überprüfen Sie das System.' };
                    
                    }
                  
                }
              
                break; 
    
            } 
    
            if ( fn.requestParams && fn.requestParams.complete )
            { 
                
                fn.requestParams.complete.apply ( this, [ response, this ] ); 
            }
            
        } 
   
    } 
   
};