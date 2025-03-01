let dropDownProfileShowed = false;
const toggleBtns = document.querySelectorAll('.auth-form-toggle-btn');
const loginForm = document.querySelector('.login-form');
const registerForm = document.querySelector('.register-form');

const buttons = document.querySelectorAll(".buttonAddTo");

toggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        toggleBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        if (btn.dataset.form === 'login') {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        } else {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
        }
    });
});

// Seleccionar todos los botones con la clase "buttonAddTo"
buttons.forEach(button => {
    button.addEventListener("click", function () {
        // Obtener el índice único del botón actual
        const index = button.getAttribute("data-index");

        // Encontrar el contenedor correspondiente con el mismo índice
        const options = document.querySelector(`.optionsAddTo[data-index='${index}']`);

        if (options) {
            options.style.display = options.style.display === "flex" ? "none" : "flex";
        }
    });
});

function guardarCancion(idCancion) {
    // Crear un formulario temporal
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "agregarFavoritas.php";

    // Añadir el campo oculto con el nombre de la canción
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "song";
    input.value = idCancion;
    form.appendChild(input);

    // Añadir el formulario al cuerpo y enviarlo
    document.body.appendChild(form);
    form.submit();
}

function eliminarCancionBiblioteca(idCancion) {
    // Crear un formulario temporal
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "eliminarFavoritas.php";

    // Añadir el campo oculto con el nombre de la canción
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "song";
    input.value = idCancion;
    form.appendChild(input);

    // Añadir el formulario al cuerpo y enviarlo
    document.body.appendChild(form);
    form.submit();
}

function eliminarCancion(idCancion) {
    // Crear un formulario temporal
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "eliminarCancion.php";

    // Añadir el campo oculto con el nombre de la canción
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "song";
    input.value = idCancion;
    form.appendChild(input);

    // Añadir el formulario al cuerpo y enviarlo
    document.body.appendChild(form);
    form.submit();
}

window.onload = function() {
    document.getElementById("reanudar").onclick = pause;

    var login = document.getElementById("login");
    if (login) {
        login.onclick = formLogin;
        document.getElementById("exitFormIcon").onclick = exitFormLogin;
    }

    var loggedIn = document.getElementById("loggedIn-info");
    if (loggedIn) {
        loggedIn.onclick = showOptionsProfile;
    }

    var uploadSong = document.getElementById("uploadSong");
    if (uploadSong) {
        uploadSong.onclick = formUploadSong;
        document.getElementById("exitFormUploadSong").onclick = exitFormUploadSong;
    }

    let pathname = window.location.pathname;
    let parts = pathname.split('/');
    let fileName = parts[parts.length - 1];
    let imgArtists;
    switch (fileName) {
        case "index.php":
            document.getElementById("imgHome").src = "../imgs/home-filled.png";
            document.getElementById("imgLibrary").src = "../imgs/library.png";
            document.getElementById("imgSettings").src = "../imgs/settings.png";
            imgArtists = document.getElementById("imgArtists");
            if (imgArtists) {
                imgArtists.src = "../imgs/artist.png";
            }
            document.getElementsByClassName("box-inside")[0].style.backgroundColor = "#25974d";
            break;
        case "library.php":
            document.getElementById("imgHome").src = "../imgs/home.png";
            document.getElementById("imgLibrary").src = "../imgs/library-filled.png";
            document.getElementById("imgSettings").src = "../imgs/settings.png";
            imgArtists = document.getElementById("imgArtists");
            if (imgArtists) {
                imgArtists.src = "../imgs/artist.png";
            }
            document.getElementsByClassName("box-inside")[1].style.backgroundColor = "#25974d";
            break;
        case "zonaArtistas.php":
            document.getElementById("imgHome").src = "../imgs/home.png";
            document.getElementById("imgLibrary").src = "../imgs/library.png";
            document.getElementById("imgSettings").src = "../imgs/settings.png";
            imgArtists = document.getElementById("imgArtists");
            if (imgArtists) {
                imgArtists.src = "../imgs/artist-filled.png";
            }
            document.getElementsByClassName("box-inside")[2].style.backgroundColor = "#25974d";
            break;
        case "settings.php":
            document.getElementById("imgHome").src = "../imgs/home.png";
            document.getElementById("imgLibrary").src = "../imgs/library.png";
            document.getElementById("imgSettings").src = "../imgs/settings-filled.png";
            imgArtists = document.getElementById("imgArtists");
            if (imgArtists) {
                imgArtists.src = "../imgs/artist.png";
            }
            if (loggedIn) {
                document.getElementsByClassName("box-inside")[3].style.backgroundColor = "#25974d";
            } else {
                document.getElementsByClassName("box-inside")[2].style.backgroundColor = "#25974d";
            }

            break;
    }
}

let paused = true;
function pause() {
    if (paused) {
        paused = false;
        document.getElementById("reanudar").src = "../imgs/pause.png";
    } else {
        paused = true;
        document.getElementById("reanudar").src = "../imgs/play.png";
    }
}

function formLogin() {
    document.getElementById("auth-form-container").style.display = "flex";
    document.getElementsByClassName("navLeft")[0].style.filter = "blur(24px)";
    document.getElementsByClassName("mainGeneral")[0].style.filter = "blur(24px)";
}

function exitFormLogin() {
    document.getElementById("auth-form-container").style.display = "none";
    document.getElementsByClassName("navLeft")[0].style.filter = "initial";
    document.getElementsByClassName("mainGeneral")[0].style.filter = "initial";
}

function formUploadSong() {
    document.getElementById("uploadSongForm").style.display = "flex";
    document.getElementsByClassName("navLeft")[0].style.filter = "blur(24px)";
    document.getElementsByClassName("mainGeneral")[0].style.filter = "blur(24px)";
}

function exitFormUploadSong() {
    document.getElementById("uploadSongForm").style.display = "none";
    document.getElementsByClassName("navLeft")[0].style.filter = "initial";
    document.getElementsByClassName("mainGeneral")[0].style.filter = "initial";
}

function showOptionsProfile() {
    var dropDownProfile = document.getElementById("dropDownProfile");

    if (!dropDownProfileShowed) {
        dropDownProfile.style.display = "inline-block";
        dropDownProfileShowed = true;
    } else {
        dropDownProfile.style.display = "none";
        dropDownProfileShowed = false;
    }
}