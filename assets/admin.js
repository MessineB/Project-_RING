

const BoutonSwitch = document.getElementById('switch') 
const adminpost = document.getElementsByClassName('adminpost')
const adminuser = document.getElementsByClassName('adminuser')
BoutonSwitch.addEventListener("click" , Switch) 

function Switch() {
    
    for(i = 0; i < adminpost.length; i++) {
        if (adminpost[i].style.display == "block") {
            adminpost[i].style.display = 'none';
        }
        else {
            adminpost[i].style.display = 'block';
        }
    }
    for(i = 0; i < adminuser.length; i++) {
        if (adminuser[i].style.display == "none") {
            console.log(adminuser[i].style)
            //console.log("adminuser if1")
            adminuser[i].style.display = 'block';
        }
        else {
           //console.log("adminuser if2")
            adminuser[i].style.display = 'none';
        }
    }
    
}