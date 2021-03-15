<?php include_once "./components/heading.php"; ?>
<body>
  <?php include_once "./components/sidebar.php"; ?>
  <!-- component -->
  <div class="container mx-auto px-5 bg-white">
    <div class="flex lg:flex-row flex-col-reverse shadow-lg">
      <!-- left section -->
      <div class="w-full lg:w-3/5 min-h-screen shadow-lg">
        <!-- header -->
        <div class="flex flex-row justify-between items-center px-5 mt-5">
          <div class="text-gray-800">
            <div class="font-bold text-xl">Pizzeria "I Tre Porcellini"</div>
          </div>
          <div class="flex items-center">
            <div class="text-sm text-center mr-4">
              <div class="font-light text-gray-500">last synced</div>
              <span class="font-semibold">3 mins ago</span>
            </div>
          </span>
        </div>
      </div>
      <!-- end header -->
      <!-- products -->
      <div class="grid grid-cols-3 gap-4 px-5 mt-5 overflow-y-auto h-3/4">
        <script>
          const aggiungiCarrelloDaCarrello = (id, quantita, nome, imgpath, prezzo) => {
            aggiungiElementoAlCarrello(id, quantita, nome, imgpath, prezzo);
            location.reload();
          }
        </script>
        <?php 
        include_once "./classes/DBManager.php";
        include_once "./resolvers/pietanze.php";
        $menu = PietanzeResolver::GetMenu(); 

        foreach($menu as $pietanza) {
          ?>
          <div class="px-3 py-3 flex flex-col border border-gray-200 rounded-md h-36 justify-between">
            <div>
              <div class="font-bold text-gray-800 overflow-y-auto h-12"><a href="./menu?id_pietanza=<?php echo $pietanza['id_pietanza']; ?>&back=./carrello"><?php echo $pietanza["nome"]; ?></a></div>
            </div>
            <div class="flex flex-row justify-between items-center">
              <span class="self-end font-bold text-lg text-yellow-500">€<?php echo $pietanza["prezzo"]; ?>
              <button type="button" class="ml-2 text-black" data-bs-toggle="tooltip" data-bs-placement="right" title="Aggiungi al carrello" onclick="aggiungiCarrelloDaCarrello(<?php echo $pietanza['id_pietanza']; ?>, 1, '<?php echo $pietanza['nome']; ?>', '<?php echo $pietanza['imgpath']; ?>', <?php echo $pietanza['prezzo']; ?>);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                  <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
              </button>
            </span>
            <img src="./static/images/menu/<?php echo $pietanza['imgpath'] ?>" class=" h-14 w-14 object-cover rounded-md" alt="">
          </div>
        </div>
      <?php } ?>
    </div>
    <!-- end products -->
  </div>
  <!-- end left section -->
  <!-- right section -->
  <div class="w-full lg:w-2/5">
    <!-- header -->
    <div class="flex flex-row items-center justify-between px-5 mt-5">
      <div class="font-bold text-xl">Ordine corrente</div>
      <div class="font-semibold">
        <span class="px-4 py-2 rounded-md bg-red-100 text-red-500" onclick="eliminaCarrello()">Svuota carrello</span>
      </div>
    </div>
    <!-- end header -->
    <!-- order list -->
    <form class="px-5 py-4 mt-5 overflow-y-auto h-64" id="ordini">    
    </form>
    <!-- end order list -->
    <!-- totalItems -->
    <div class="px-5 mt-5">
      <div class="py-2 rounded-md shadow-lg">
        <div class="mt-3 pb-2 px-4 flex items-center justify-between">
          <span class="font-semibold text-2xl">Totale</span>
          <span class="font-bold text-2xl" id="totale"></span>
        </div>
      </div>
    </div>
    <!-- end total -->
    <!-- cash -->
    <div class="px-5 mt-5">
      <script>
        console.table(ottieniCarrello());
      </script>
      <form action="" method="POST">
      </form>
    </div>
    <!-- end cash -->
    <!-- button pay-->
    <div class="px-5 mt-5">
      <div class="px-4 py-4 rounded-md shadow-lg text-center bg-purple-700 text-white font-semibold">
        Ordina
      </div>
    </div>
    <!-- end button pay -->
  </div>
  <!-- end right section -->
</div>
</div>
<script>
  componiTabella(ottieniCarrello())
</script>
</body>
</html>