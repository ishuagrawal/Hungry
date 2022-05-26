function ajaxPost(endpointUrl, data, returnFunction) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', endpointUrl, true);
    // POST requests need extra header information
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function(){
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                returnFunction( xhr.responseText );
            } else {
                alert('AJAX Error.');
                console.log(xhr.status);
            }
        }
    }
    xhr.send(JSON.stringify(data));
};


document.querySelector('form').onsubmit = function(event) {
    event.preventDefault();

    let myModal = document.getElementById("exampleModal");
    if (myModal) {
        myModal.remove();
    }

    // Client-side validation
    let username = document.querySelector("#username-id").value.trim();
    let email = document.querySelector("#email-id").value.trim();
    let password = document.querySelector("#password-id").value.trim();

    if ( username.length == 0 ) {
        document.querySelector('#username-id').classList.add('is-invalid');
    } else {
        document.querySelector('#username-id').classList.remove('is-invalid');
    }

    if ( email.length == 0 ) {
        document.querySelector('#email-id').classList.add('is-invalid');
    } else {
        document.querySelector('#email-id').classList.remove('is-invalid');
    }

    if ( password.length == 0 ) {
        document.querySelector('#password-id').classList.add('is-invalid');
    } else {
        document.querySelector('#password-id').classList.remove('is-invalid');
    }

    // no errors
    if (document.querySelectorAll('.is-invalid').length == 0) {
        let postData = {
            'username' : username,
            'email' : email,
            'password' : password
        };

        ajaxPost("register_results.php", postData, function(response) {
            let results = JSON.parse(response);

            // Dynamically creates the modal
            let modelTag1 = document.createElement("div");
            modelTag1.classList.add("modal");
            modelTag1.classList.add("fade");
            modelTag1.setAttribute("id", "exampleModal");
            modelTag1.setAttribute("tabindex", "-1");
            modelTag1.setAttribute("aria-labelledby", "exampleModalLabel");
            modelTag1.setAttribute("aria-hidden", "true");

            let modelTag2 = document.createElement("div");
            modelTag2.classList.add("modal-dialog");

            let modelTag3 = document.createElement("div");
            modelTag3.classList.add("modal-content");

            let modelTag4a = document.createElement("div");
            modelTag4a.classList.add("modal-header");

            let title = document.createElement("h5");
            title.classList.add("modal-title");
            title.setAttribute("id", "exampleModalLabel");
            title.innerHTML = "Registration Confirmation: ";
            if (results["error"]) {
                title.innerHTML += "Error!";
            } else {
                title.innerHTML += "Success!";
            }
            modelTag4a.appendChild(title);

            let buttonTag = document.createElement("button");
            buttonTag.setAttribute("type", "button");
            buttonTag.classList.add("btn-close");
            buttonTag.setAttribute("data-bs-dismiss", "modal");
            buttonTag.setAttribute("aria-label", "Close");
            modelTag4a.appendChild(buttonTag);

            let modelTag4b = document.createElement("div");
            modelTag4b.classList.add("modal-body");

            let message = document.createElement("p");
            if (results["error"]) {
                message.classList.add("text-danger");
            } else {
                message.classList.add("text-success");
            }
            message.innerHTML = results["msg"];
            modelTag4b.appendChild(message);

            let modelTag4c = document.createElement("div");
            modelTag4c.classList.add("modal-footer");

            if (!results["error"]) {
                let loginLink = document.createElement("a");
                loginLink.classList.add("btn");
                loginLink.classList.add("btn-color");
                loginLink.setAttribute("href", "login.php");
                loginLink.setAttribute("role", "button");
                loginLink.innerHTML = "Login";
                modelTag4c.appendChild(loginLink);
            } else {
                let buttonTagA = document.createElement("button");
                buttonTagA.setAttribute("type", "button");
                buttonTagA.classList.add("btn");
                buttonTagA.classList.add("btn-secondary");
                buttonTagA.setAttribute("data-bs-dismiss", "modal");
                buttonTagA.innerHTML = "Close";
                modelTag4c.appendChild(buttonTagA);
            }

            modelTag3.appendChild(modelTag4a);
            modelTag3.appendChild(modelTag4b);
            modelTag3.appendChild(modelTag4c);
            modelTag2.appendChild(modelTag3);
            modelTag1.appendChild(modelTag2);
            document.body.appendChild(modelTag1);

            $('#exampleModal').modal('show');
        });
    }
}