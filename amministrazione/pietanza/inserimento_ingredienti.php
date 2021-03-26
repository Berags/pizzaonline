<!DOCTYPE html>
<html lang="it">
<head>
  <?php
  /* Jacopo Beragnoli 5°IC */
  session_start();
  if(!isset($_SESSION["username"])) {
    header("location: ../");
  }
  ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>I tre porcellini - Inseriemnto ingredienti</title>
  <link rel="stylesheet" href="../static/css/bootstrap.min.css">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../static/css/menu.css">
  <link rel="shortcut icon" href="../images/logo.ico" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="../../static/js/jquery.js"></script>
</head>
<body>
  <div class="flex inline-block justify-center mt-10">
    <div class="w-full max-w-md">
      <form class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4" method='POST' action='../post/post_inserimento_ingrediente.php' id="ingrediente" enctype="multipart/form-data">
        <div
        class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4"
        >
        Inserisci un nuovo Ingrediente
      </div>
      <table>
        <tr><td><div class="mb-4">
          <label
          class="block text-gray-700 text-sm font-normal mb-2"
          for="nome_ingrediente"
          >
          Nome
        </label>
        <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        name="nome_ingrediente"
        type="text"
        required
        autofocus
        placeholder="Nome dell'ingrediente"
        />
      </div>
    </td>
    <td>
      <div class="mb-6">
        <label
        class="block text-gray-700 text-sm font-normal mb-2"
        for="celiaci"
        >
        Per celiaci
      </label>
      <style>
      .toggle-checkbox:checked {
        right: 0;
        border-color: #68D391;
      }
      .toggle-checkbox:checked + .toggle-label {
        background-color: #68D391;
      }
      </style>

      <div class="relative inline-block w-10 mr-2 ml-2 align-middle select-none transition duration-200 ease-in">
        <input type="checkbox" name="celiaco" id="celiaco" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
        <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
      </div>
    </div>
  </td>
</tr>
</table>
<div class="flex items-center justify-center">
  <button class="px-4 py-2 rounded text-white inline-block shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700" type="submit">Inserisci</button>
</div>
</form>
</div>
</div>
</body>
