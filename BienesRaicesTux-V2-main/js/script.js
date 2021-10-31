/****** Menu Hamburguesa *********/
((d) => {
  const $btnMenu = d.querySelector(".menu-btn"),
    $menu = d.querySelector(".bar-nav");

  $btnMenu.addEventListener("click", (e) => {
    $btnMenu.firstElementChild.classList.toggle("none");
    $btnMenu.lastElementChild.classList.toggle("none");
    $menu.classList.toggle("is-active");
  });

  d.addEventListener("click", (e) => {
    if (!e.target.matches(".bar-nav")) return false;
    $btnMenu.firstElementChild.classList.remove("none");
    $btnMenu.lastElementChild.classList.add("none");
    $menu.classList.remove("is-active");
  });
})(document);

/****** Menu desplejable Mobile *********/
((d) => {
  const $SubMenuBtn = d.querySelectorAll(".submenu-btn");
  for (let i = 0; i < $SubMenuBtn.length; i++) {
    $SubMenuBtn[i].addEventListener("click", function () {
      if (window.innerWidth < 1024) {
        const $subMenu = this.nextElementSibling;
        const $height = $subMenu.scrollHeight;
        if ($subMenu.classList.contains("desplegar")) {
          $subMenu.classList.remove("desplegar");
          $subMenu.removeAttribute("style");
        } else {
          $subMenu.classList.add("desplegar");
          $subMenu.style.height = $height + "px";
        }
      }
    });
  }
})(document);

// funcion para mostrar dependiendo de el tipo de registro vendedor o venta
function tipochange(sel) {
  if (sel.value == "1") {
    //comparacion si el valor del select es 1 o 2
    //los ids si es 1 estaran en none ocultos
    txtinput = document.getElementById("RFCvent");
    txtinput.style.display = "none";

    txtinput = document.getElementById("celvent");
    txtinput.style.display = "none";

    txtlabel = document.getElementById("RFClabel");
    txtlabel.style.display = "none";

    txtlabel = document.getElementById("celebal");
    txtlabel.style.display = "none";

    txtinput = document.getElementById("direccionvent");
    txtinput.style.display = "none";

    txtlabel = document.getElementById("direccionlebal");
    txtlabel.style.display = "none";
  } else {
    //en caso contrario estaran visibles
    txtinput = document.getElementById("RFCvent");
    txtinput.style.display = "block";

    txtinput = document.getElementById("celvent");
    txtinput.style.display = "block";

    txtlabel = document.getElementById("RFClabel");
    txtlabel.style.display = "block";

    txtlabel = document.getElementById("celebal");
    txtlabel.style.display = "block";

    txtinput = document.getElementById("direccionvent");
    txtinput.style.display = "block";

    txtlabel = document.getElementById("direccionlebal");
    txtlabel.style.display = "block";
  }
}

// funcion mostrar o ocultar contraseña
function mostrar() {
  //vriable donde guardamos el tipo de elemento que es el id pasword
  var tipo = document.getElementById("password");
  //condicion para saber si el tipo es password
  if (tipo.type === "password") {
    //si lo es el tipo lo cambiamos a text
    tipo.type = "text";
  } else {
    //sino se conserva en tipo pasword
    tipo.type = "password";
  }
}
