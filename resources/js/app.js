import './bootstrap';


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


//profile icon
document.getElementById('profile-icon').addEventListener('click', function(){
    const profileIcon = document.getElementById('profile-icon');
    const profileMenu = document.getElementById('profile-menu');

    if (profileIcon && profileMenu){
        if (profileMenu.classList.contains('hidden')){
            profileMenu.classList.remove('hidden');
            profileMenu.classList.add('block');
        }
        else{
            profileMenu.classList.remove('block');
            profileMenu.classList.add('hidden');
        }
    }
})