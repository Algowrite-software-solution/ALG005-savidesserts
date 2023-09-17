<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Admin</title>

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="adminComponents.css">

    <!-- js -->
    <script defer src="../js/bootstrap.bundle.js"></script>
    <script defer src="adminComponent.js"></script>
</head>

<body class="w-100 bg-dark" style="height: 100vh;">
    <div class="container">
        <div class="alg-table-container" id="tableContainer">

        </div>
    </div>

    <!-- utility -->
    <!-- model -->
    <div class="modal" tabindex="-1" id="dashBoardModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelTitle">Modal title</h5>
                    <button type="button" class="alg-rounded-large alg-bg-dark" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body" id="modelBody">
                    <p>Modal body goes here.</p>
                </div>
                <div class="modal-footer" id="modelFooter">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- message toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="dashBoardToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i id="toastIcon" class=""></i>
                <strong class="me-auto" id="toastTitle">Bootstrap</strong>
                <small id="toastTime">11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBody">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
    <i id="toastIcon" class="bi bi-heart text-white"></i>
</body>

</html>