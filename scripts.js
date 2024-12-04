document.addEventListener("DOMContentLoaded", () => {
    const cartItems = document.getElementById("cart-items");
    const totalCost = document.getElementById("total-cost");
    const promoCodeInput = document.getElementById("promo-code");
    const clearCartBtn = document.getElementById("clear-cart");
    const applyPromoBtn = document.getElementById("apply-promo");

    let cart = [];
    let discount = 0;

    // Actualizar la vista del carrito
    const updateCart = () => {
        cartItems.innerHTML = "";
        let total = 0;

        cart.forEach((item, index) => {
            const cartItem = document.createElement("div");
            cartItem.className = "cart-item";
            cartItem.innerHTML = `
                <span>${item.name} - $${item.price}</span>
                <button class="remove-item" data-index="${index}">Eliminar</button>
            `;
            cartItems.appendChild(cartItem);
            total += item.price;
        });

        total -= total * discount;
        totalCost.textContent = `Costo Total: $${total.toFixed(2)}`;
    };

    // Agregar productos al carrito
    document.querySelectorAll(".add-to-cart").forEach((button) => {
        button.addEventListener("click", (e) => {
            const name = e.target.getAttribute("data-name");
            const price = parseFloat(e.target.getAttribute("data-price"));

            cart.push({ name, price });
            updateCart();
        });
    });

    // Eliminar productos del carrito
    cartItems.addEventListener("click", (e) => {
        if (e.target.classList.contains("remove-item")) {
            const index = e.target.getAttribute("data-index");
            cart.splice(index, 1);
            updateCart();
        }
    });

    // Vaciar el carrito
    clearCartBtn.addEventListener("click", () => {
        cart = [];
        discount = 0;
        promoCodeInput.value = "";
        updateCart();
    });

    // Aplicar el código promocional
    applyPromoBtn.addEventListener("click", () => {
        const promoCode = promoCodeInput.value.trim();
        if (promoCode === "DESCUENTO10") {
            discount = 0.1; // Descuento del 10%
        } else {
            discount = 0;
        }
        updateCart();
    });

    // Inicializa el carrito al cargar la página
    updateCart();
});
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("product-modal");
    const closeModal = document.getElementById("close-modal");
    const productDetailsButtons = document.querySelectorAll(".view-details");
    
    productDetailsButtons.forEach(button => {
        button.addEventListener("click", () => {
            const productName = button.getAttribute("data-name");
            const productPrice = button.getAttribute("data-price");
            const productDescription = button.getAttribute("data-description");
            
            // Rellenar el modal con los detalles del producto
            document.getElementById("modal-product-name").textContent = productName;
            document.getElementById("modal-product-price").textContent = `$${productPrice}`;
            document.getElementById("modal-product-description").textContent = productDescription;
            document.getElementById("modal-product-image").src = button.getAttribute("data-image"); // Agrega data-image si tienes imágenes de cada producto

            // Mostrar el modal
            modal.style.display = "block";
        });
    });

    // Cerrar el modal
    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Cerrar el modal si se hace clic fuera de él
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
