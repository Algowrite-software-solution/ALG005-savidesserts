const SERVER_URL = "http://localhost:9001/";

document.addEventListener("DOMContentLoaded", () => {
     productPromotionView();
});

//product promotion view section
function productPromotionView() {
     // Fetch request
     fetch(SERVER_URL + "backend/api/promotionDataView.php", {
          method: "GET", // HTTP request method
          headers: {
               "Content-Type": "application/json", // Request headers
          },
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
          })
          .catch((error) => {
               // Handle errors that occur during the Fetch request
               console.error("Fetch error:", error);
          });
}