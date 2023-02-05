document.getElementById("btn").addEventListener("click", function(){
    if(!document.getElementById("sidebar").classList.contains("open")){
        document.getElementById("btn").classList.remove("rotate");
    }
    else {
        document.getElementById("btn").classList.add("rotate");
    }
    document.getElementById("sidebar").classList.toggle("open");
    let list = document.createElement("ul");
    list.classList.add("sidebar-list");

    // Add links as list items
    let items = [
        { name: "All", link: "/neatest/html/shop/allproducts.php" },
        { name: "New Items", link: "/neatest/html/shop/newitems.php" },
        { name: "Hats", link: "#" },
        { name: "Outerwear", link: "#" },
        { name: "Sweatshirts", link: "#" },
        { name: "Shirts", link: "#" },
        { name: "Bottomwear", link: "#" },
        { name: "Socks", link: "#" },
        { name: "Footwear", link: "#" },
    ];
    items.forEach(item => {
        let li = document.createElement("li");
        let a = document.createElement("a");
        a.href = item.link;
        a.classList.add("item-link");
        a.innerText = item.name;
        li.appendChild(a);
        list.appendChild(li);
    });
    
    // add the list to the sidebar element
    document.getElementById("sidebar").append

});
