let productLocalStorage;
//modification de la quantité d'objet
const quantityInputs = document.querySelectorAll(".itemQuantity");
for(const index in quantityInputs) {
    quantityInputs[index].addEventListener("change", (e) => {
        const quantity = e.target.textContent;
        if(quantity === "" || quantity <= 0)
        {
            alert("Mettez un nombre valide.");
            return false;
        } else if (quantity <= 0){
            // Cas où la valeur entrée est nulle et doit mener à une suppression
        } else {
            productLocalStorage[index].quantity = quantity;
        }
        localStorage.setItem("product", JSON.stringify(productLocalStorage));
        window.location.reload();
    });
}

