const slide = document.getElementById("slide-out-menu");
    const out = document.getElementById("out");
    slide.addEventListener('click', function(){
        if(out.style.display == "block"){
            out.style.display = "none";
        }else{
            out.style.display = "block";
        }
})