(function($){
 $.fn.letItSnow = function(pOptions) {
 var el, canvas, zAnzahl, zSnow, zFrames, zForm, zWidth, zHeight, zSpeed, zImage, zClear, ctx;

 el = $(this);
 if(!el) { alert('Missing objekt to obtain to.'); return false; }
 
 if(!pOptions)
 {
  zAnzahl = 50;
  zFrames = 40;
  zForm = 1;
  zWidth = el.width();
  zHeight = el.height();
  zSpeed = 'medium';
  zClear = true;
 }
 else
 { 
  zAnzahl = pOptions.amount;  if(!zAnzahl) { zAnzahl = 50; }
  zFrames = pOptions.frames; if(!zFrames) { zFrames = 40; }
  zForm = pOptions.form;  if(!zForm) { zForm = 1; }
 
  zWidth = pOptions.width; if(!zWidth) { zWidth = 200; }
  zHeight = pOptions.height; if(!zHeight) { zHeight = 200; }
  
  zSpeed = pOptions.speed; if(!zSpeed) { zSpeed = 'medium'; }
  
  zClear = true;
  
  zClear = pOptions.clear;
  
  if(pOptions.radius)
   zRadius = pOptions.radius;
  else
   zRadius = [4,12];
   
  if(pOptions.image)
   zImage = true;
   
  if(pOptions.flakes)
   zImages = pOptions.flakes;
  else
   zImages = ['img/snow.png'];
   
 }
 
   zSnow = new Array();
   
 
 canvas = document.createElement('canvas');
  canvas.width = zWidth;
  canvas.height = zHeight;
  
  canvas.ws = zRadius[0];
  canvas.we = zRadius[1];
 
 if(pOptions.css)
  $(canvas).css(pOptions.css);
      
  if(zClear)
   canvas.clear = '1';
  
  if(zImage)
   canvas.img = pOptions.image;
  
   switch(zSpeed)
   {
    case 'slow':
     canvas.start = 10;
     canvas.end = 20;
    break;
    case 'medium':
     canvas.start = 30;
     canvas.end = 40;
    break;
    case 'fast':
     canvas.start = 50;
     canvas.end = 100;
    break;
    default:  
     canvas.start = pOptions.speed[0];
     canvas.end = pOptions.speed[1];
    break;
   }

 el.append(canvas);
 
 
 ctx = canvas.getContext('2d');
 
 // construct
 for(i = 0; i < zAnzahl; i++)
 {             
   zSnow[i] = new Array();
   zSnow[i] = setSnowFlake(zSnow[i]);                
 }
 
 function setSnowFlake(obj){
  obj['r'] = Math.round(canvas.ws+canvas.we*Math.random());
  
  obj['x'] = Math.round(0+zWidth*Math.random());
  obj['y'] = (-1) * Math.round(obj['r']+zHeight*Math.random());
  
  obj['s'] =(canvas.start+canvas.end* Math.random()) / (zFrames / (20/6));
  
  obj['img'] = zImages[(Math.round(0+(zImages.length)*Math.random()))];
  obj['state'] = 1;
   
  return obj;
 }
             
 function letItSnow(){
  if(canvas.clear == '1')
   ctx.clearRect(0, 0, zWidth, zHeight);
  
  ctx.beginPath();
  
  for(i = 0; i < zAnzahl; i++)
  {
   if(zSnow[i]['state'] == 1 || zForm == 1)
   {
    // calculate
    zSnow[i]['y'] = zSnow[i]['y'] + zSnow[i]['s'];
    
    if(Math.round(0+1 * Math.random()) == 0)
     zSnow[i]['x'] = zSnow[i]['x'] - .2;
    else
     zSnow[i]['x'] = zSnow[i]['x'] + .2;
     
    if((zSnow[i]['y'] > zHeight - zSnow[i]['r']) && zForm == 2)
     zSnow[i]['state'] = 2;
    
    if(zSnow[i]['y'] > zHeight && zForm == 1)
     zSnow[i] = setSnowFlake(zSnow[i]);
 
   }
  
   ctx.beginPath();
    var img = new Image();
    img.src = 'frontend/img/snow.png';
    ctx.drawImage(img, zSnow[i]['x'], zSnow[i]['y'], zSnow[i]['r'], zSnow[i]['r']); 
  }
    
   setTimeout(letItSnow, (1000/zFrames));
 }
 
  letItSnow();
 }
}) (jQuery);