var navOpen = false;

$(document).ready(function(){
    
	$('#nav-toggler').click(function(){
		$(this).toggleClass('open');
        switchNav();
	});  
    
    //Changes header text if window is to small
    $( window ).resize(function() {
        if(screen.width < 450){
            document.getElementsByTagName("h1")[0].textContent = "BTV Heidenheim e.V."
        }
    });
    
});

function switchNav() {
    
    if(navOpen == false){
         document.getElementById("nav").style.width = "100%";
        navOpen = true;
     }
    else{
          document.getElementById("nav").style.width = "0";
          navOpen = false;
     }
  }   

