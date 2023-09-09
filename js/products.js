const SERVER_URL = "http://localhost:9001/";

document.addEventListener("DOMContentLoaded", () => {});

// load category
function loadCategory() {
  fetch("https://api.example.com/data", {
    method: "POST", // HTTP request method
    headers: {
      "Content-Type": "application/json", // Request headers
    },
    body: JSON.stringify({
      // Request body (if sending data)
      key1: "value1",
      key2: "value2",
    }),
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

// Fetch request
fetch("https://api.example.com/data", {
  method: "POST", // HTTP request method
  headers: {
    "Content-Type": "application/json", // Request headers
  },
  body: JSON.stringify({
    // Request body (if sending data)
    key1: "value1",
    key2: "value2",
  }),
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
