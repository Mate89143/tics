// Petición para obtener clientes
fetch('/backend/crud_clientes.php')
  .then(response => response.json())
  .then(data => {
    console.log(data);
    // Aquí puedes iterar y mostrar clientes en HTML
  })
  .catch(error => console.error('Error:', error));
