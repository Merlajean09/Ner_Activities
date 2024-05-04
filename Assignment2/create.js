const button = document.getElementById('submit');

button.addEventListener("click", () => {
    let firstName = document.getElementById('firstName').value;
    let lastName = document.getElementById('lastName').value;
    let email = document.getElementById('email').value;
    let gender = document.getElementById('gender').value;

    const data = {
        firstName: firstName,
        lastName: lastName,
        email: email,
        gender: gender,
    };

    fetch('http://localhost/assignment/activity/create.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(data),
    })
    .then((res) => res.json())
    .then(response => {
        console.log(response);
        fetchAndDisplay();
    });

});

    function fetchAndDisplay() {
        fetch('http://localhost/assignment/activity/create.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('tableBody');

            tableBody.innerHTML = '';

            for(let i = 0; i < data.length; i++){
                let tableRow = `<tr>
                              <td>${data[i].id}</td>
                              <td>${data[i].firstName}</td>
                              <td>${data[i].lastName}</td>
                              <td>${data[i].email}</td>
                              <td>${data[i].gender}</td>
                            </tr>`;
                tableBody.innerHTML += tableRow;
            }
        })
        .catch(error => console.error('error!', error));
    }
    fetchAndDisplay();