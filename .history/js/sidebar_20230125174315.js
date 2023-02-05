document.getElementById("btn").addEventListener("click", function(){
    if(!document.getElementById("sidebar").classList.contains("open")){
        document.getElementById("btn").classList.remove("rotate");
    }
    else {
        document.getElementById("btn").classList.add("rotate");
    }
    document.getElementById("sidebar").classList.toggle("open");
    document.getElementById("sidebar-list").classList.toggle("open");
    setTimeout(function(){
        document.getElementById("sidebar-list").style.display = "block";
    }, 500);
});

document.getElementById("sidebar").addEventListener("transitionend", function(){
    if(document.getElementById("sidebar").classList.contains("open")){
        document.getElementById("sidebar-list").style.display = "block";
    }else{
        document.getElementById("sidebar-list").style.display = "none";
    }
});
