document.querySelectorAll(".Pbo-select-custom").forEach(function (customSelect) {
    const selected = customSelect.querySelector(".custom-selected");
    const options = customSelect.querySelectorAll(".custom-option");
    const originDestination = customSelect.closest(".Pbo-individual-select-container").querySelector(".origin-destination");
    const point = customSelect.querySelector('.pbo-point');
    

    function handleSelectClick() {
        customSelect.classList.toggle("open");
        closeOtherSelects(customSelect);
    } 

    selected.addEventListener("click", handleSelectClick);
    originDestination.addEventListener("click", handleSelectClick);
    
    customSelect.addEventListener("click", function (event) {
        if (event.target.classList.contains("custom-option")) {
            const option = event.target;
            selected.value = option.getAttribute("data-value");
            selected.innerHTML = option.innerHTML;
            point.value =  option.getAttribute("data-value");
            customSelect.classList.remove("open");
        }
    });
});

document.addEventListener("click", function (event) {
    if (!event.target.closest(".Pbo-select-custom") && !event.target.closest(".origin-destination")) {
        closeAllSelects();
    }
});

function closeOtherSelects(currentSelect) {
    document.querySelectorAll(".Pbo-select-custom").forEach(function (select) {
        if (select !== currentSelect && select.classList.contains("open")) {
            select.classList.remove("open");
        }
    });
}

function closeAllSelects() {
    document.querySelectorAll(".Pbo-select-custom").forEach(function (select) {
        select.classList.remove("open");
    });
}
    
    function adjustPadding() {
        var windowWidth = window.innerWidth;
        var formularioContainer = document.getElementById("formulario-container");
        var desplegables = document.querySelectorAll(".custom-options");


        if (windowWidth <= 700) {
            formularioContainer.style.paddingLeft = "0px";
            formularioContainer.style.paddingRight = "0px";
            desplegables.forEach((desplegable)=>{
                desplegable.style.width = "100vw";
                desplegable.style.left = "0";
            })
        } else {
            formularioContainer.style.paddingLeft = "50px";
            formularioContainer.style.paddingRight = "50px";
            desplegables.forEach((desplegable)=>{
                desplegable.style.width = "auto";
                desplegable.style.left = "auto";
            })
        }
    }

    adjustPadding();

    jQuery(document).ready(function ($) {

        var main = jQuery("#main-main");
        var formularioContainer = main.find("#formulario-container");
        var initialTop = formularioContainer.offset().top;
        var pboInputsContainer = formularioContainer.find("#inputs-container");

        main.css("paddingTop","50px");
        main.css("padding-bottom","50px");
        
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > initialTop && enableAdhesion) {
                formularioContainer.css("position", "fixed");
                formularioContainer.css("top", "0");
                formularioContainer.css("left", "0");
                formularioContainer.css("marginTop", separacionSuperior + "px");
                pboInputsContainer.css("width","100vw");
                main.css("paddingTop","0");
                main.css("padding-bottom","0");
                formularioContainer.css("padding","0")
            } else {
                formularioContainer.css("position", "static");
                formularioContainer.css("margin", "0");
                formularioContainer.css("max-width","100%");
                pboInputsContainer.css("width","100%");
                main.css("paddingTop","50px");
                main.css("padding-bottom","50px");
                adjustPadding();
            }
        });
    });

    window.addEventListener("resize", function() {
        adjustPadding();
    });
