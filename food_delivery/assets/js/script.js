document.addEventListener("DOMContentLoaded", function () {
    // General button click effect
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            button.classList.add('clicked');
            setTimeout(() => {
                button.classList.remove('clicked');
            }, 150);
        });
    });

    // Handling restaurant list view for customers
    const restaurantList = document.querySelectorAll('.restaurant-card');
    if (restaurantList) {
        restaurantList.forEach(card => {
            card.addEventListener('click', function () {
                const restaurantId = this.getAttribute('data-id');
                window.location.href = `restaurant_menu.php?id=${restaurantId}`;
            });
        });
    }

    // Handling dish selection for customers
    const dishList = document.querySelectorAll('.dish-card');
    if (dishList) {
        dishList.forEach(card => {
            card.addEventListener('click', function () {
                const dishId = this.getAttribute('data-id');
                addToOrder(dishId);
            });
        });
    }

    // Handling order placement
    const placeOrderBtn = document.querySelector('#placeOrderBtn');
    if (placeOrderBtn) {
        placeOrderBtn.addEventListener('click', function () {
            placeOrder();
        });
    }
});

// Function to add a dish to the order
function addToOrder(dishId) {
    console.log("Adding dish with ID " + dishId + " to order.");

    // Example logic to send a request to the server (AJAX)
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_to_order.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Success response
            console.log(xhr.responseText);
            alert('Dish added to your order!');
        }
    };
    xhr.send(`dish_id=${dishId}`);
}

// Function to confirm order placement
function placeOrder() {
    console.log("Order placed.");

    // Example AJAX request to submit the order
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'place_order.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            console.log(xhr.responseText);
            alert('Order has been successfully placed!');
            // You can redirect the user to the order confirmation page or reset the order form
            window.location.href = 'order_confirmation.php';
        }
    };
    xhr.send();
}
