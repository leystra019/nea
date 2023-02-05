document.getElementById("add-to-bag-btn").addEventListener("click", function(){
    this.value = 'Take out from bag';
    this.style.backgroundColor = 'red';
    var addedToBag = document.createElement("div");
    addedToBag.classList.add("added-to-bag");
    addedToBag.innerHTML = "Product has been added to bag";
    this.after(addedToBag);
});