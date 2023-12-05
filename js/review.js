const SERVER_URL = "";

//toast Message
function toastMessage(message, className) {
       const toastMessageContainer = document.getElementById(
              "toastMessageContainer"
       );
       const toastLiveExample = document.getElementById("liveToast");

       toastMessageContainer.innerHTML = "";
       const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
       toastMessageContainer.innerHTML += `<span>${message}</span>`;

       toastLiveExample.classList.remove("text-bg-success");
       toastLiveExample.classList.remove("text-bg-danger");

       if (className !== undefined) {
              toastLiveExample.classList.add(className);
       }
       toastBootstrap.show();
}


function sendReview() {
       const review = document.getElementById('reviewReview').value;

       const data = new FormData();
       data.append("review_text", review);
       // Fetch request
       fetch(SERVER_URL + "backend/api/addReview.php", {
              method: "POST", // HTTP request method
              body: data,
       })
              .then((response) => {
                     if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                     }
                     return response.json(); // Parse the response body as JSON
              })
              .then((data) => {
                     // Handle the JSON data received from the API
                     console.log("Data from the API:", data);
                     if (data.status === "success") {
                            toastMessage("tanks for the review", "text-bg-success");

                            setTimeout(() => {
                                   window.location.href = "https://saweedessert.com/index.php";
                            }, 1000);

                     } else {
                            toastMessage(data.error, "text-bg-danger");
                     }
              })
              .catch((error) => {
                     // Handle errors that occur during the Fetch request
                     console.error("Fetch error:", error);
              });
}