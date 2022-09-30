


const BoutonArticle = document.getElementById('articles_affiche') 
const BountonUSer = document.getElementById('user_affiche') 
const BoutonArticleDelete = document.getElementById('article_to_delete_affiche') 

const adminpost = document.getElementsByClassName('adminpost')
const adminuser = document.getElementsByClassName('adminuser')
const adminposttodelete = document.getElementsByClassName('adminposttodelete')

BoutonArticle.addEventListener("click" , articleaffiche) 
BountonUSer.addEventListener("click" , useraffiche) 
BoutonArticleDelete.addEventListener("click" , articletodeleteaffiche)

function articleaffiche() {
    BoutonArticle.style.backgroundColor='#21295e'
    BountonUSer.style.backgroundColor='#1d9bf0'
    BoutonArticleDelete.style.backgroundColor='#1d9bf0'

    for(i = 0; i < adminpost.length; i++) {
            adminpost[i].style.display = 'block'
    }
    for(i = 0; i < adminuser.length; i++) {
        adminuser[i].style.display = 'none' 
    } 
    for(i = 0; i < adminposttodelete.length; i++) {
        adminposttodelete[i].style.display = 'none' 
    } 
}
function useraffiche() {
    BountonUSer.style.backgroundColor='#21295e'
    BoutonArticle.style.backgroundColor='#1d9bf0'
    BoutonArticleDelete.style.backgroundColor='#1d9bf0'

    for(i = 0; i < adminpost.length; i++) {
        adminpost[i].style.display = 'none'
    }
    for(i = 0; i < adminuser.length; i++) {
        adminuser[i].style.display = 'block'
    }
    for(i = 0; i < adminposttodelete.length; i++) {
        adminposttodelete[i].style.display = 'none' 
    } 
}

function articletodeleteaffiche() {
    BoutonArticleDelete.style.backgroundColor='#21295e'
    BountonUSer.style.backgroundColor='#1d9bf0'
    BoutonArticle.style.backgroundColor='#1d9bf0'
  
    for(i = 0; i < adminpost.length; i++) {
        adminpost[i].style.display = 'none'
    }
    for(i = 0; i < adminposttodelete.length; i++) {
        adminposttodelete[i].style.display = 'block'
    }
    for(i = 0; i < adminuser.length; i++) {
        adminuser[i].style.display = 'none' 
    } 
}
