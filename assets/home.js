
import { Modal } from "bootstrap"
// Function to load on loadingpage
Window.onload = loadingpage() 
    function  loadingpage () {
        if (!localStorage.getItem("runOnce")) {
            $('.modal').modal('show')
            localStorage.setItem("runOnce", true);
        }
    }
// 
