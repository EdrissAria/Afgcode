const out = document.getElementById("out");
const slide_menu2 = document.getElementById("slide-out-menu2");
const slide_menu = document.getElementById("slide-out-menu");
slide_menu.addEventListener("click", function(){
        out.style.display = "block";  
        out.style.position = "absolute";
        out.style.zIndex = "9999";          
});
slide_menu2.addEventListener("click", function(){
        out.style.display = "none";       
});
