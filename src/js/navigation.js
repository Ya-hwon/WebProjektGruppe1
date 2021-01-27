var navOpen = false;

$(document).ready(function(){
    
	$('#nav-toggler').click(function(){
		$(this).toggleClass('open');
        switchNav();
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

