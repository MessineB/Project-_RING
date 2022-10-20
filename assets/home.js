
import { Modal } from "bootstrap"
// Function to load on loadingpage
Window.onload = loadingpage() 
    function  loadingpage () {
        if (!sessionStorage.getItem("runOnce")) {
            $('.modal').modal('show')
            sessionStorage.setItem("runOnce", true);
        }
    }
// 
