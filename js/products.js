// URL to the API endpoint you want to fetch data from
const apiUrl = "https://api.example.com/data";

// Optional: Request headers
const headers = new Headers();
headers.append("Content-Type", "application/json");
headers.append("Authorization", "Bearer YourAccessToken");

// Optional: Request options
const requestOptions = {
  method: "GET", // HTTP request method (GET, POST, PUT, DELETE, etc.)
  headers: headers, // Headers to include in the request
  mode: "cors", // Request mode ('cors', 'no-cors', 'same-origin')
  cache: "default", // Cache mode ('default', 'no-store', 'reload', etc.)
  redirect: "follow", // Redirect behavior ('follow', 'error', 'manual')
  referrerPolicy: "no-referrer", // Referrer policy ('no-referrer', 'origin', 'unsafe-url', etc.)
};

// Make the Fetch request
fetch(apiUrl, requestOptions)
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
