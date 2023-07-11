
function sidebarSm() {
    var element = document.getElementById("home").classList;
    if(element.contains("open")){
        element.remove("open");
        element.add("close")
    }else{
        element.add("open");
        element.remove("close")
    }
     
   
}


function clClose() {
    var element = document.getElementById("home").classList;
    if(element.contains("open")){
        element.remove("open");
    }
     
   
}