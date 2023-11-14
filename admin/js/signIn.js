const ALG = new DashboardComponents();

function signIn() {
  const mobile = document.getElementById("mobile").value;
  const password = document.getElementById("password").value;

  const form = new FormData();
  form.append("mobile", mobile);
  form.append("password", password);

  if (mobile == "") {
    ALG.openToast(
      "Warnning",
      "Please add a mobile no ",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );
    return;
  } else if (password == "") {
    ALG.openToast(
      "Warnning",
      "Please add a password",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );
    return;
  }

  fetch("api/adminSignInProcess.php", {
    method: "POST",
    body: form,
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "successfully signed in!",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        setTimeout(() => {
          window.location.reload();
        }, 1500);
      } else if (data.status == "failed") {
        ALG.openToast(
          "Alert",
          data.error,
          ALG.getCurrentTime(),
          "bi-x",
          "Error"
        );
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      console.error(error);
    });
}
