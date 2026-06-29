const form = document.querySelector("form");

form.addEventListener("submit", function(event) {
    event.preventDefault();

    const user = document.getElementById("user").value;
    const password = document.getElementById("password").value;
    const erroruser = document.getElementById("errouser");

    if (user === "" && password === "") {
        erroruser.textContent = "Todos os campos são obrigatórios";
        return;
    } else {
        erroruser.textContent = "";
    }
    if (user === "") {
        erroruser.textContent = "Digite como quer ser chamado!";
        return;
    }else {
        erroruser.textContent = "";
    }
    if (password === "") {
        erroruser.textContent = "A senha é obrigatório";
        return;
    }else {
        erroruser.textContent = "";
    }
    
   form.submit();

} );