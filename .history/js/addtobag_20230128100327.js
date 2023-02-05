let productQuantity = 0;

document.getElementById("add-to-bag-btn").addEventListener("click", function(){
    if (productQuantity === 0) {
        this.value = 'Take out from bag';
        this.style.backgroundColor = 'red';
    }
    productQuantity++;
    var addedToBag = document.createElement("div");
    addedToBag.classList.add("added-to-bag");
    addedToBag.innerHTML = "Product has been added to bag. Quantity: " + productQuantity;
    this.after(addedToBag);
});

document.getElementById("add-to-bag-btn").addEventListener("click", function(){
    if (productQuantity === 1) {
        this.value = 'Add to bag';
        this.style.backgroundColor = 'green';
        var addedToBag = document.getElementsByClassName("added-to-bag")[0];
        addedToBag.remove();
    }
    productQuantity--;
});