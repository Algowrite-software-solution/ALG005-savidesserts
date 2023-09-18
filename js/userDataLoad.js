document.addEventListener("DOMContentLoaded", () => {
     userProfileDataload();
});

// load user data for profile
function userProfileDataload() {


     let text = "Hello world!";


     fetch(SERVER_URL + "backend/api/loadUserData.php", {
          method: "GET", // HTTP request method
          headers: {
               "Content-Type": "application/json", // Request headers
          },
     })
          .then((response) => response.json())

          .then((data) => {
               const userCardContainer = document.getElementById('userCardContainer');
               if (data.status === "success") {

                    const userName = data.response.user_name;
                    const name = userName.substring(0, 2);


                    userCardContainer.innerHTML = "";
                    userCardContainer.innerHTML += `
                    <div class="alg-profile-round alg-bg-light d-flex justify-content-center align-items-center fw-bold text-uppercase">${name}</div>
                    <div class="d-flex flex-column align-items-center alg-text-light text-white mt-1 px-4" >
                    <span class="fw-bold">${data.response.user_name}</span>
                    <span>${data.response.email}</span>
                   </div>
                    <button type="button" onclick="signOut();" class="text-decoration-none text-black page-transition-button alg-bg-tan fw-bold alg-button-hover px-4 py-1 rounded-4">SIGN OUT</button>
                 `;
               }
          })
          .catch((error) => {
               console.error("Error:", error);
          });
}