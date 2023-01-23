import '../styles/styles.scss';
import "../../node_modules/materialize-css/dist/css/materialize.min.css";
import "../../node_modules/materialize-css/dist/js/materialize.min.js";

document.addEventListener('DOMContentLoaded', function() {
    let elems = document.querySelectorAll('.sidenav');
    let instances = M.Sidenav.init(elems, 'edge');
});



// Or with jQuery

$(document).ready(function(){
    $('.sidenav').sidenav();
});