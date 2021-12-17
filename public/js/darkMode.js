document.addEventListener('DOMContentLoaded', function(){
    darkMode();
})


function darkMode(){
    const inputDarkMode = document.querySelector('#inputDarkMode')
    const navbar = document.querySelector('.navbar')
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)')

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
        navbar.classList.remove('navbar-light','bg-light')
        navbar.classList.add('navbar-dark','bg-dark')
    } else {
        document.body.classList.remove('dark-mode');
        navbar.classList.remove('navbar-dark','bg-dark')
        navbar.classList.add('navbar-light','bg-light')
    }

    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
            navbar.classList.remove('navbar-light','bg-light')
            navbar.classList.add('navbar-dark','bg-dark')
        } else {
            document.body.classList.remove('dark-mode');
            navbar.classList.remove('navbar-dark','bg-dark')
            navbar.classList.add('navbar-light','bg-light')
        }
    })

    inputDarkMode.addEventListener('click',function() {
        document.body.classList.toggle('dark-mode')
        if(navbar.classList.contains('navbar-light')){
            navbar.classList.remove('navbar-light','bg-light')
            navbar.classList.add('navbar-dark','bg-dark')
        } else{
            navbar.classList.remove('navbar-dark','bg-dark')
            navbar.classList.add('navbar-light','bg-light')
        }
    })
}