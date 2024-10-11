document.getElementById("ticketForm").addEventListener("submit", function (event) {
    let url = document.getElementById("url").value;

    // Validar si la URL comienza con "https"
    if (!url.startsWith("https")) {
        event.preventDefault(); 

        Swal.fire({
          icon: "error",
          title: "URL inválida",
          text: "Por favor, ingresa una URL segura que comience con https.",
          customClass: {
            popup: "swal2-custom-popup",
          },
        });
    } else {
        Swal.fire({
          icon: "success",
          title: "URL válida",
          text: "Procesando información...",
          customClass: {
            popup: "swal2-custom-popup",
          },
          showConfirmButton: false,
          timer: 1500,
        }).then(() => {
          this.submit();
        });

        event.preventDefault();
    }
});
