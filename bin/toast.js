function toastMessage(message, className) {
     const toastMessageContainer = document.getElementById('toastMessageContainer');
     const toastLiveExample = document.getElementById('liveToast')


     toastMessageContainer.innerHTML = "";
     const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
     toastMessageContainer.innerHTML += `<span>${message}</span>`;

     if (className !== undefined) {
          toastLiveExample.classList.add(className)
     }
     toastBootstrap.show();

}

function request(id) {
     if (id === 1) {
          toastMessage("success");
          alert("hello");
     } else if (id === 2) {
          toastMessage("Error", "text-bg-danger");
          alert("errrr");
     }
}
