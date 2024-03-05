let t = document.querySelector('.inactive');
t = t.classList[1];

document.getElementById('submitted').addEventListener('submit', function (e) {
    e.preventDefault();

    const xhr = new XMLHttpRequest();
    const formData = new FormData(this);
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const message = document.getElementById('myTextarea');

            const messages = document.querySelector('.messages');
            const newMessage = document.createElement('div');
            newMessage.textContent = message.value;
            newMessage.classList.add('message-sent');
            messages.appendChild(newMessage);

            message.value = '';
            name.value = '';
            message.focus();

        }
    }
    xhr.open('GET', '../add/message/' + t + '?message=' + document.getElementById('myTextarea').value, true);
    xhr.send();

    // En post
    // xhr.open('POST', '../add/message/' + t, true);
    // Récupérer le jeton CSRF à partir de la balise meta
    // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Ajouter le jeton CSRF à l'en-tête de la requête
    // xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    // xhr.send(formData);

})