const SERVER_URL = "http://localhost:9001/";

document.getElementById('signupBtn').addEventListener('click', () => {
console.log("1");
    // let email = document.getElementById('signUp-email').value;
    // let full_name = document.getElementById('signUp-fullname').value;
    // let password = document.getElementById('signUp-password').value;
    // let rePassword = document.getElementById('signUp-retypepassword').value;

    // // console.log("2");

    // const form = new FormData();
    // form.append('email',email);
    // form.append('fullName',full_name);
    // form.append('password',password);
    // form.append('confPassword',rePassword);

    // fetch(SERVER_URL + 'backend/api/signUpProcess.php', {
    //     method: "POST",
    //     headers: {
    //         "Content-Type": "application/x-www-form-urlencoded",
    //     },
    //     body: form,
    // })
    //     .then(response => response.json())
    //     .then(responseData =>{
    //         alert(responseData);
    //         console.log(responseData)            
    //     })
    //     .catch(error=>{
    //         console.error('Error:',error);
    //     });
})

function signUp(){

    let email = document.getElementById('signUp-email').value;
    let full_name = document.getElementById('signUp-fullname').value;
    let password = document.getElementById('signUp-password').value;
    let rePassword = document.getElementById('signUp-retypepassword').value;

    // console.log("2");

    const form = new FormData();
    form.append('email',email);
    form.append('fullName',full_name);
    form.append('password',password);
    form.append('confPassword',rePassword);

    fetch(SERVER_URL + 'backend/api/signUpProcess.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: form,
    })
        .then(response => response.json())
        .then(responseData =>{
            alert(responseData);
            console.log(responseData)            
        })
        .catch(error=>{
            console.error('Error:',error);
        });
}