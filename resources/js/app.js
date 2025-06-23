import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {

    //navigation responsive menu
    document.getElementById('menu-button').addEventListener('click', function(){
        const mobileMenu = document.getElementById('mobile-menu');
        const menuButton = document.getElementById('menu-button');

        if (menuButton && mobileMenu){
                if (mobileMenu.classList.contains('hidden')){
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.classList.add('flex');
                }
                else{
                    mobileMenu.classList.remove('flex');
                    mobileMenu.classList.add('hidden');
                }
            }
    });

    const profileIcon = document.getElementById('profile-icon');
    const profileMenu = document.getElementById('profile-menu');

    if (profileIcon && profileMenu) {
        profileIcon.addEventListener('click', function () {
            if (profileMenu.classList.contains('hidden')) {
                profileMenu.classList.remove('hidden');
                profileMenu.classList.add('block');
            } else {
                profileMenu.classList.remove('block');
                profileMenu.classList.add('hidden');
            }
        });
    }

    const basketButton = document.getElementById('basket');
    const basketOverlay = document.getElementById('basketOverlay');
    const guestBasketSection = document.getElementById('guestBasket');
    const closeBasket = document.getElementById('closeGuestBasket');

    if (basketButton && guestBasketSection) {
        basketButton.addEventListener('click', () => {
        guestBasketSection.classList.toggle('right-[-600px]');
        guestBasketSection.classList.toggle('right-0');
        basketOverlay.classList.toggle('right-500');
        basketOverlay.classList.remove('opacity-0');
        basketOverlay.classList.add('opacity-70');
        });
        closeBasket.addEventListener('click', function(){
            guestBasketSection.classList.toggle('right-[-600px]');
            guestBasketSection.classList.toggle('right-0');
            basketOverlay.classList.toggle('right-500');
            basketOverlay.classList.add('opacity-0');
            basketOverlay.classList.remove('opacity-70');
            
        })
    } 

    //add and decrmeent

    let incrementButton = document.querySelectorAll('.incrementButton');
    let decrementButton = document.querySelectorAll('.decrementButton');

    incrementButton.forEach(function(button) {
        button.addEventListener('click', function() {
            let action = this.parentElement.querySelector('.quantityAction');
            let input = this.parentElement.querySelector('.quantityInput');
            let currentValue = parseInt(input.value, 10);
            let max = parseInt(input.max, 10);
            if (currentValue < max) {
                input.value = parseInt(input.value) + 1;
                action.value = "increment";

                let form = this.closest('form');
                let formData = new FormData(form);

                fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Example: update basket total
                        console.log('guestBasket:', data.guestBasket);

                        Object.values(data.guestBasket).forEach(item => updateGuestBasketUI(item));

                    }
                });
            };
        });
    });

    decrementButton.forEach(function(button) {
        button.addEventListener('click', function() {
            let input = this.parentElement.querySelector('.quantityInput');
            let action = this.parentElement.querySelector('.quantityAction');
            let min = input.min;
            if (input.value > min) {
                input.value = parseInt(input.value) - 1;
                action.value = "decrement";

                let form = this.closest('form');
                let formData = new FormData(form);

                fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Example: update basket total
                        console.log('guestBasket:', data.guestBasket);

                        Object.values(data.guestBasket).forEach(item => updateGuestBasketUI(item));
                    }
                });
            };
        });
    });


    function updateGuestBasketUI(basket) {
        const productId = basket.product.id;
        const colorId = basket.color ? basket.color.id : '';
        const itemContainer = document.querySelector(`.quantity-section[data-product-id="${productId}"][data-color-id="${colorId}"]`);

        if(!itemContainer) return;

        const quantityInput = itemContainer.querySelector('.quantityInput');
        const price = itemContainer.querySelector('.price');
        const progress = document.querySelector('.progress');
        const percentage = document.querySelector('.percentage');
        if (quantityInput){
            quantityInput.value = basket.quantity;
        }

        if (price){
            price.innerHTML = (basket.price * basket.quantity).toFixed(2);
        }

        if(progress && percentage){
            progress.style.width = basket.percentage + "%";
        }



    }

    
});