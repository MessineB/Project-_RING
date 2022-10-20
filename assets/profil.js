const profil_info = document.getElementsByClassName('profil_info')
const profil_userpost = document.getElementsByClassName('profil_posts')
const button_swap  = document.getElementById('profil_swaptopostpending')

button_swap.addEventListener("click", swap )

console.log(profil_userpost[0].classList)

function swap() {
    if ((profil_userpost[0].classList.contains("profil_hidden"))) {
        profil_userpost[0].classList.remove("profil_hidden")
        profil_userpost[0].classList.add("profil_visible")
        profil_info[0].classList.remove("profil_visible")
        profil_info[0].classList.add("profil_hidden")
    } 
    else {
        profil_userpost[0].classList.add("profil_hidden")
        profil_userpost[0].classList.remove("profil_visible")
        profil_info[0].classList.add("profil_visible")
        profil_info[0].classList.remove("profil_hidden")
    }
    // Scroll back to top 
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}