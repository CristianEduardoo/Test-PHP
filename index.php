<!DOCTYPE html>
<html lang="es">

<?php include 'includes/head.php'; ?>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Análisis de entradas disponibles</h1>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <form id="ticketForm" action="function.php" method="POST" class="card p-4 shadow-sm">
                    <div class="mb-3">
                        <label for="url" class="form-label">URL del evento:</label>
                        <input id="url" type="text" name="url" class="form-control" placeholder="Ingresa la URL del evento" required>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success px-4">Consultar</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="./js/scripts.js"></script>
</body>

</html>