document.getElementById("btn").addEventListener("click", function(){
    if(!document.getElementById("sidebar").classList.contains("open")){
        document.getElementById("btn").classList.remove("rotate");
    }
    else {
        document.getElementById("btn").classList.add("rotate");
    }
    document.getElementById("sidebar").classList.toggle("open");

});
