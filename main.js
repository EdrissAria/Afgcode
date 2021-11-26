// for apearing slide out menu 
const slide = document.getElementById("slide-out-menu");
    const out = document.getElementById("out");
    slide.addEventListener('click', function(){
        if(out.style.display == "block"){
            out.style.display = "none";
        }else{
            out.style.display = "block";
        }
})
// for navigation into active links 
function navigation(){
    let current_location = location.pathname.split('/')[2];
    let menu_items = document.querySelector("header").getElementsByTagName("a");
    let slide_out = document.querySelector(".slide-out-menu").getElementsByTagName("a");
    for (let i = 0, len = menu_items.length; i < len; i++) {
        if (menu_items[i].getAttribute("href") == current_location) {
          menu_items[i].setAttribute('id', 'active');
        }
        if (slide_out[i].getAttribute("href") == current_location) {
          slide_out[i].setAttribute('id', 'active');
        }
    }
}
navigation();

// for focusing into comment input by clickin on reply button

function focusInput(){
    document.getElementById('c_name').focus();
}
