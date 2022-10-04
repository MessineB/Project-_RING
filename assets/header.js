
const posts = document.getElementsByClassName("posts")
const bigmain = document.getElementsByClassName("bigmain")
const lposts = document.getElementsByClassName("lposts")
const layoutleft =  document.getElementsByClassName("layout_left")
const form = document.getElementsByClassName("formpost")
const menu = document.getElementsByClassName("menu_main")
const footer = document.getElementsByTagName("footer")
const imagebtn = document.getElementsByName("imagebtn")

const btnnight = document.getElementById("btnnight")

if ( localStorage.getItem("nightmode")) {
    for (let i = 0 ; i < posts.length ; i++ ) {
        if (posts[i].classList.contains("nightmode")) {
            posts[i].classList.remove("nightmode");
        } 
        else {
            posts[i].classList.add("nightmode");
        }
    }
    for (let i = 0 ; i < bigmain.length ; i++ ) {
        if (bigmain[i].classList.contains("nightmain")) {
            bigmain[i].classList.remove("nightmain")  
        } 
        else {
            bigmain[i].classList.add("nightmain");
            
        }
    }
    for (let i = 0 ; i < lposts.length ; i++ ) {
        if (lposts[i].classList.contains("nightmode")) {
            lposts[i].classList.remove("nightmode");
            lposts[i].classList.remove("nightmain");
        } 
        else {
            lposts[i].classList.add("nightmode");
            lposts[i].classList.add("nightmain");
        }  
    }
    for (let i = 0 ; i < layoutleft.length ; i++ ) {
        if (layoutleft[i].classList.contains("nightmode")) {
            layoutleft[i].classList.remove("nightmode");
            layoutleft[i].classList.remove("nightmain");
        } 
        else {
            layoutleft[i].classList.add("nightmode");
            layoutleft[i].classList.add("nightmain");
        }  
    }
    for (let i = 0 ; i < form.length ; i++ ) {
        if (form[i].classList.contains("nightmode")) {
            form[i].classList.remove("nightmode");
            form[i].classList.remove("nightmain");
        } 
        else {
            form[i].classList.add("nightmode");
            form[i].classList.add("nightmain");
        }  
    }

    for (let i = 0 ; i < menu.length ; i++ ) {
        if (menu[i].classList.contains("nightmode")) {
            menu[i].classList.remove("nightmode");
            menu[i].classList.remove("nightmain");
        } 
        else {
            menu[i].classList.add("nightmode");
            menu[i].classList.add("nightmain");
        } 
    }
}

if ( localStorage.getItem("nightmode") ) {
    imagebtn[0].classList.remove("fa-moon")
    imagebtn[0].classList.add("fa-sun")
    btnnight.style.backgroundColor='#dc532a'
}
else {
    imagebtn[0].classList.add("fa-moon")
    imagebtn[0].classList.remove("fa-sun")
    btnnight.style.backgroundColor='#1d9bf0'
}


btnnight.addEventListener("click", nightmode )
btnnight.addEventListener("click" , verificationnightmode)


function verificationnightmode() {
    if ( localStorage.getItem("nightmode")) {   
        for (let i = 0 ; i < posts.length ; i++ ) {
            if (posts[i].classList.contains("nightmode")) {
                posts[i].classList.remove("nightmode");
            } 
            else {
                posts[i].classList.add("nightmode");
            }
        }
        for (let i = 0 ; i < bigmain.length ; i++ ) {
            if (bigmain[i].classList.contains("nightmain")) {
                bigmain[i].classList.remove("nightmain")  
            } 
            else {
                bigmain[i].classList.add("nightmain"); 
            }
        }
        for (let i = 0 ; i < lposts.length ; i++ ) {
            if (lposts[i].classList.contains("nightmode")) {
                lposts[i].classList.remove("nightmode");
                lposts[i].classList.remove("nightmain");
            } 
            else {
                lposts[i].classList.add("nightmode");
                lposts[i].classList.add("nightmain");
            }  
        }
        for (let i = 0 ; i < layoutleft.length ; i++ ) {
            if (layoutleft[i].classList.contains("nightmode")) {
                layoutleft[i].classList.remove("nightmode");
                layoutleft[i].classList.remove("nightmain");
            } 
            else {
                layoutleft[i].classList.add("nightmode");
                layoutleft[i].classList.add("nightmain");
            }  
        }
        for (let i = 0 ; i < form.length ; i++ ) {
            if (form[i].classList.contains("nightmode")) {
                form[i].classList.remove("nightmode");
                form[i].classList.remove("nightmain");
            } 
            else {
                form[i].classList.add("nightmode");
                form[i].classList.add("nightmain");
            }  
        }
    
        for (let i = 0 ; i < menu.length ; i++ ) {
            if (menu[i].classList.contains("nightmode")) {
                menu[i].classList.remove("nightmode");
                menu[i].classList.remove("nightmain");
            } 
            else {
                menu[i].classList.add("nightmode");
                menu[i].classList.add("nightmain");
            } 
        }
    }else 
    {
        for (let i = 0 ; i < posts.length ; i++ ) {
            if (posts[i].classList.contains("nightmode")) {
                posts[i].classList.remove("nightmode");
            } 
            else {
                posts[i].classList.add("nightmode");
            }
        }
        for (let i = 0 ; i < bigmain.length ; i++ ) {
            if (bigmain[i].classList.contains("nightmain")) {
                bigmain[i].classList.remove("nightmain")  
            } 
            else {
                bigmain[i].classList.add("nightmain"); 
            }
        }
        for (let i = 0 ; i < lposts.length ; i++ ) {
            if (lposts[i].classList.contains("nightmode")) {
                lposts[i].classList.remove("nightmode");
                lposts[i].classList.remove("nightmain");
            } 
            else {
                lposts[i].classList.add("nightmode");
                lposts[i].classList.add("nightmain");
            }  
        }
        for (let i = 0 ; i < layoutleft.length ; i++ ) {
            if (layoutleft[i].classList.contains("nightmode")) {
                layoutleft[i].classList.remove("nightmode");
                layoutleft[i].classList.remove("nightmain");
            } 
            else {
                layoutleft[i].classList.add("nightmode");
                layoutleft[i].classList.add("nightmain");
            }  
        }
        for (let i = 0 ; i < form.length ; i++ ) {
            if (form[i].classList.contains("nightmode")) {
                form[i].classList.remove("nightmode");
                form[i].classList.remove("nightmain");
            } 
            else {
                form[i].classList.add("nightmode");
                form[i].classList.add("nightmain");
            }  
        }
    
        for (let i = 0 ; i < menu.length ; i++ ) {
            if (menu[i].classList.contains("nightmode")) {
                menu[i].classList.remove("nightmode");
                menu[i].classList.remove("nightmain");
            } 
            else {
                menu[i].classList.add("nightmode");
                menu[i].classList.add("nightmain");
            } 
        }
    }
    if ( localStorage.getItem("nightmode") ) {
        imagebtn[0].classList.remove("fa-moon")
        imagebtn[0].classList.add("fa-sun")
        btnnight.style.backgroundColor='#dc532a'
    }
    else {
        imagebtn[0].classList.add("fa-moon")
        imagebtn[0].classList.remove("fa-sun")
        btnnight.style.backgroundColor='#1d9bf0'
    }
    
}
function nightmode() {
    if (!localStorage.getItem("nightmode")) {
        localStorage.setItem("nightmode", true)
    }
    else {
        localStorage.removeItem("nightmode")
    }
}
