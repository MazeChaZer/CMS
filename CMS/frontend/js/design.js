   function Navigation(nav,id,event,dingel)
   {
   var SubNavItem = new Array();
   
    if(document.getElementById("nav"+nav))
    {
     var links = document.getElementById("nav"+nav).offsetLeft;
      if(!links){
       links = document.getElementById("nav"+nav).offsetX; }
    }
    
     if(links + 400 > screen.width)
     {
      links = links - 120;
     }
      
    if(dingel == 1)
    {
     if(Verstecken == true)
     {
      document.getElementById("sub"+id).style.display = "none";
     }
    }
    else
    {
     if(event == 1)
     {
      for(i = 0;i != document.getElementById("NavigationSubs").getElementsByTagName("div").length;i++)
      {
       if(document.getElementById("NavigationSubs").getElementsByTagName("div")[i])
       {
        document.getElementById("NavigationSubs").getElementsByTagName("div")[i].style.display = "none";
       }
      }
      document.getElementById("sub"+id).style.display = "block";
      document.getElementById("sub"+id).style.left = links+"px";
      Verstecken = false;
     }
     else
     {
      Verstecken = true;
      setTimeout(function(){Navigation(nav,id,event,1)},3000);
     }
    }
   }
   
   var a = 0;
   
   function NavigationInit(i)
   {
    if(!i)
    {
     i = 0;
    }
    if(document.getElementById("NavigationsLinks").getElementsByTagName("a")[i])
    {
     document.getElementById("NavigationsLinks").getElementsByTagName("a")[i].title = document.getElementById("NavigationsLinks").getElementsByTagName("a")[i].innerHTML;
     document.getElementById("NavigationsLinks").style.display = "none";
     if(document.getElementById("NavigationsLinks").getElementsByTagName("a")[i].className == "sub")
     {
      document.getElementById("NavigationsLinks").getElementsByTagName("a")[i].id = "nav"+i;
      document.getElementById("NavigationsLinks").getElementsByTagName("a")[i].onmouseover = function(){ Navigation(i-1,i-1,1,null); }
      document.getElementById("NavigationsLinks").getElementsByTagName("a")[i].onmouseout = function(){ Navigation(i-1,i-1,2,null); }
       document.getElementById("NavigationSubs").getElementsByTagName("div")[a].id = "sub"+i;
       document.getElementById("NavigationSubs").getElementsByTagName("div")[a].onmouseover = function(){ Navigation(i-1,i-1,1,null); }
       document.getElementById("NavigationSubs").getElementsByTagName("div")[a].onmouseout = function(){ Navigation(i-1,i-1,2,null); }
       a++;
     }
    }
    else
    {
     document.getElementById("NavigationsLinks").style.display = "block";
     document.getElementById("NavigationLaden").style.display = "none";
    }
    i++;
    setTimeout(function(){NavigationInit(i)},1);
   }
   
   var Sub = 1;
   
   function Subbar(){
    if(Sub == 1)
    {
     document.getElementById("subbar").className = "offen";
     Sub = 2;
    }
    else
    {
    document.getElementById("subbar").className = "geschlossen";
    Sub = 1;
    }
   }
   
   var Bilder = new Array("abstrakt.jpg","baum.jpg","palme.jpg","meer.jpg","gras.jpg","blume.jpg","bambus.jpg","stadt.jpg","aurora.jpg")
   var BilderPos = new Array("bottom","center","bottom","center","center","top","center","bottom","center");
   var Default = 0;
   var Selected = 0;
   
   var Designs = new Array();
    for(i = 0; i != Bilder.length;i++)
    {
     Designs[i] = new Array();
      Designs[i][0] = Bilder[i];
    }
   
   function DesignChange(value,event)
   {
    if(value != Selected)
    {
     if(event == 2)
     {
      document.getElementById("DesignAuswahl").getElementsByTagName("p")[value].className = "selected";
      document.getElementById("DesignAuswahl").getElementsByTagName("p")[Selected].className = "";
      Selected = value;
      Default = value;
     }

     if(value != "Default")
     {
      document.getElementById("header").style.background = "url(frontend/img/designs/"+Designs[value][0]+") no-repeat "+BilderPos[value]+" center #000";
     }
     else
     {
     document.getElementById("header").style.background = "url(frontend/img/designs/"+Designs[Default][0]+") no-repeat "+BilderPos[Default]+" center #000";
     }
    }
   }
   
   var SlideStopp = false;
   var ScrollLeft = 0;
   
   function SlideShowScroll(d,w){
    if(w == 1)
    {
     SlideStopp = true;
    }
    
    if(w == 2)
    {
     SlideStopp = false;
    }
        
     Anzahl = (document.getElementById("ScrollFenster").getElementsByTagName("img").length - 5) * 220;
     Anzahl1 = (document.getElementById("ScrollFenster").getElementsByTagName("img").length - 7) * 220;
    if(SlideStopp != true)
    {
     if(d == 1)
     {
      if(ScrollLeft != (-1) * Anzahl)
      {
       ScrollLeft--;
       document.getElementById("ScrollFenster").style.marginLeft = ScrollLeft+"px";
       setTimeout(function(){SlideShowScroll(1)},1);
      }
      else
      {
       SlideStopp = true;
      }
     }
     else
     {
      if( ScrollLeft != Anzahl1)
      {
       ScrollLeft++;
       document.getElementById("ScrollFenster").style.marginLeft = ScrollLeft+"px";
       setTimeout(function(){SlideShowScroll(2)},1);
      }
      else
      {
       SlideStop = true;
      }
     }
    }
   }