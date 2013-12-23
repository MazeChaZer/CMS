/* List Wrapping */
var WrapList = function ( o )
{
    var fn = this;
    
    //vars
    this.object = o;
    this.parentNode = null;
    this.root = null;
    this.children = null;
    
    //init
    this.init = function ( )
    {
      
        this.parentNode = this.object.querySelector ( 'ul>li' );
        this.root = this.parentNode.querySelector ( '*.cms-root' );

        this.children = this.parentNode.querySelectorAll ( 'ul' );
        
        this.hideChildren.apply ( this );
        this.addEvents.apply ( this, [ this.root ] );
        
    };
    
    //fns
    this.hideChildren = function ( )
    {
   
        for ( var i = 0; i < this.children.length; i++ )
        {
    
            this.children[ i ].style.display = 'none';
            this.addEvents.apply ( this, [ this.children[ i ].querySelector ( 'li>a' ) ] );
            
        }
        
    };
    
    this.addEvents = function ( e )
    {
     
        var i, el;

        e.addEventListener ( 'mousedown', function ( )
        {
            
            el = this.parentNode.querySelectorAll ( 'ul' );
            
            if ( el.length !== 0 )
            {
                
                for ( i = 0; i < el.length; i++ )
                {
                    
                    if ( el[ i ].parentNode !== this.parentNode )
                    {
                        
                        continue;
                        
                    }
                    
                    if ( el[ i ].style.display === 'block' )
                    {
                    
                        el[ i ].style.display = 'none';
                        
                    }
                    else
                    {
                    
                        el[ i ].style.display = 'block';
                    
                    }
                    
                }
                
            }
            
        }, false   );
        
    };
    
    //
    this.init.apply ( this );
    
};

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
          this.object.setAttribute ( 'style', 'position: absolute; left: 0; top: 0; width: 100%; height: 100% ' );

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
        
        switch ( this.options.type )
        {
    
            case 1:
        
                this.addButton.apply ( this, [ 'Okay', 1 ] );

                break;
    
        }
        
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
    
    this.html = function ( h )
    {
        this.textObject.innerHTML = '<h2>Warnung</h2>';
        this.textObject.innerHTML += h;
    
    };
    
    this.addButton = function ( t, ty )
    {
    
        var b = document.createElement ( 'button' );
            b.type = 'button';
            b.innerText = t;
        
        switch ( ty )
        {
        
            case 1: default:
            
                b.onclick = function ( )
                {
                
                    fn.hide.apply ( fn );
                    
                    return false;
                
                } ;
            
                break;
        
        }
            
        this.controlObject.appendChild ( b );
    
    };
    
    //
    this.init.apply ( this );

};

/* AjaxForms */
var AjaxForm = function ( f, o )
{
    
    var fn = this;
    
    //vars
    this.object = f;
    this.options = o;
    
    this.request = null;
    
    this.class = 'cms-ajaxForm-layer';
    this.validatorClass = 'null';
    
    // init
    this.init = function ( )
    {
      
        this.object.setAttribute ( 'class', ( ( this.object.getAttribute ( 'class ' ) ) ? ( this.object.getAttribute ( 'class' ) + 'cms-ajaxForm' ) : 'cms-ajaxForm' ) );
      
        this.setEvents.apply ( this );
        this.request = new AjaxRequest ( );
        
        this.validator = new Layer ( { 
            parent: this.object,
            class: 'cms-ajaxForm-layer',
            type: 1
        }   );
        
        if ( this.options.init && this.options.init !== null )
        {
            
            this.options.init.apply ( this );
            
        }
        
        console.log ( 'AjaxForm mit Zielobjekt ' + this.object + ' initialisiert.' );
        
    };
    
    this.getInputs = function ( )
    {
        
        var i, _i = this.object.querySelectorAll ( 'input:not([type="submit"]):not([type="reset"]):not([type="button"])' );
        
        this.parameters = 'ajax&view=false';
        
        for ( i = 0; i < _i.length; i++ )
        {
            
            this.parameters += '&' + ( _i[ i ].getAttribute ( 'name' ) || _i[ i ].name );
            
            if ( _i[ i ].value !== null )
            {
                
                this.parameters += '=' + encodeURIComponent ( _i[ i ].value );
                
            }
            
        }
  
    };
    
    this.submit = function ( )
    {
        
        if ( this.options.submit && this.options.submit !== null )
        {
            
            this.options.submit.apply ( this );
            
        }
      
        this.request.send ( {
            url: this.object.action,
            type: this.object.method,
            data: this.parameters,
            syncType: true,
            dataType: 'json',
            complete: function ( e, r ) {
     
                if ( e.success && e.error === 0 )
                {
                    
                    fn.handleSuccess.apply ( fn, [ e ] );
                    
                }
                else
                {
 
                    fn.handleError.apply ( fn, [ e ] );
                    
                }  
                
            }
        }   );
        
    };
    
    this.setEvents = function ( )
    {
        
        this.object.addEventListener ( 'submit', function ( ) {
         
            fn.getInputs.apply ( fn );
            fn.submit.apply ( fn );
            
            return false;
            
        }, true   );
        
        this.object.onsubmit = function ( )
        {
            
            return false;
            
        };
        
    };
    
    this.handleSuccess = function ( r )
    {
        
        this.request.send ( {
            url: 'index.php/.admin',
            type: 'get',
            data: null,
            syncType: true,
            dataType: 'text',
            complete: function ( e, r ) {
                
                if ( fn.options.success && fn.options.success !== null )
                {
                    
                    fn.options.success.apply ( fn, [ e, r ] );
                    
                }
                
            }
        }   );
        
    };
    
    this.handleError = function ( e )
    {   
           
        if ( this.options.error && this.options.error !== null )
        {
            
            this.options.error.apply ( this, [ e ] );
            
        }
        
        if ( e && e !== null )
        {

            this.validator.show.apply ( this.validator );
            this.validator.html.apply ( this.validator, [ '<span>' + e.errorMessage + '</span>' ] );
        
        }
        
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
    this.position = 'top';
    this.margin = [ 6, 8 ];
    this.defaultDirection = 'bottom'; //top || right || bottom || left


    //init
    this.init = function ( )
    {

        this.object = document.createElement ( 'div' );
            this.object.setAttribute ( 'class', this.class );
            this.object.setAttribute ( 'style', 'position: absolute; left: 0; top: 0 ' );

        this.textContainer = document.createElement ( 'span' );

        this.hide.apply ( this );

        this.object.appendChild ( this.textContainer );

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

        switch ( this.position )
        {

            default: case 'top':

                l = x - ( ( w > this.width ) ? w - this.width : this.width - w ) / 2;
                t = y - this.height - this.margin[ 1 ];

                break;

            case 'bottom':

                l = x - ( ( w > this.width ) ? w - this.width : this.width - w ) / 2;
                t = y + h + this.margin[ 1 ];

                break;

            case 'left':

                l = x - this.width - this.margin[ 0 ];
                t = y - ( ( h > this.height ) ? h - this.height : this.height - h );

                break;

            case 'right':

                l = x + w + this.margin[ 0 ];
                t = y - ( ( h > this.height ) ? h - this.height : this.height - h );

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
        this.object.style.opacity = 1;

    };

    this.hide = function ( )
    {

        this.visible = false;
        this.object.style.display = 'none';
        this.object.style.opacity = 0;

    };

    this.setText = function ( t )
    {

        this.textContent = t;

        this.textContainer.innerText = this.textContent;

    };

    this.toElement = function ( e )
    {
        var pos = e.getBoundingClientRect();

        this.setText.apply ( this, [ e.getAttribute ( 'tooltip-text' ) ] );
        this.reposition.apply ( this, [ pos.left, pos.top, e.offsetWidth, e.offsetHeight ] );
        this.show.apply ( this );

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
            
                    response = eval ( '(' + this.responseText + ')' ); 
                  
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