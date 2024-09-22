let text_copy = "";

const bouton_copie = document.querySelector("#copie_email")
    bouton_copie.addEventListener("click", function(){
        const email_copie = document.querySelectorAll(".mail")
            email_copie.forEach(function(copie) {
                text_copy += copie.innerText + " "
            });
            navigator.clipboard.writeText(text_copy)
    });
