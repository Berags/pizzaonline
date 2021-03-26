<?php include_once "./components/heading.php"; ?>
<body>
  <?php include_once "./components/sidebar.php"; ?>
  <div class="grid grid-cols-1 sm:grid-cols-2 sm:px-8 sm:py-12 sm:gap-x-8 md:py-16">
    <div class="z-10 col-start-1 row-start-1 px-4 pt-20 pb-3 bg-gradient-to-t from-black sm:bg-none grid grid-cols-4 items-center">
      <img src="./static/images/logo.png" class="col-span-1 inset-0 w-32 h-32 object-cover sm:rounded-lg md:rounded-lg" alt="" srcset="">
      <h2 class="col-span-3 text-5xl font-semibold sm:text-2xl leading-7 md:text-6xl text-black">Pizzeria<br><span class="md:text-purple-900">I Tre Porcellini</span></h2>
    </div>
    <div class="col-start-1 row-start-2 px-4 sm:pb-16">
      <div class="flex items-center text-sm font-medium my-5 sm:mt-2 sm:mb-4">
        <svg width="20" height="20" fill="currentColor" class="text-violet-600">
          <path d="M9.05 3.691c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.372 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.363-1.118l-2.8-2.034c-.784-.57-.381-1.81.587-1.81H7.03a1 1 0 00.95-.69L9.05 3.69z" />
        </svg>
        <div class="ml-1">
          <span class="text-black">4.94</span>
          <span class="sm:hidden md:inline">(128)</span>
        </div>
        <div class="text-base font-normal mx-2">·</div>
        <div>Pistoia, Italia</div>
      </div>
      <div class="flex items-center text-sm font-medium my-2 sm:mt-2 sm:mb-4">
        <span style="text-align: justify;text-justify: inter-word;">
          Benvenuti nella Pizzeria <b>"I Tre Porcellini"</b>. Dal <b>1963</b> la nostra pizzeria sforna <i>ogni giorno</i> dalle 100 alle 200 pizze di <i>ogni tipo</i>.
          Un ringraziamento va a tutta la nostra <b>famiglia</b> che con il cambio generazionale, "sforna" da anni pizzaioli con <i>grandi capacità</i>. Non perdetevi inoltre il servizio
          del nostro grande <b>chef</b> nonchè mastro pizzaiolo <b>Jacopo</b>, con il quale ogni giorno riusciamo a garantire un servizio da "<b>leccarsi i baffi"</b>.
          Vi consiglio di non perdervi le specialità della casa come per esempio la nostra imperdibile e sfiziosa margherita, composta da materie prime di qualità e soprattutto della zona.
          <br><b>Buona pizza!</b>
        </span>
      </div>
      <hr class="w-16 border-gray-300 hidden sm:block">
    </div>
    <div class="col-start-1 row-start-3 space-y-3 px-4">
      <a href="./carrello" class="focus:outline-none text-white text-sm py-2.5 px-5 border-b-4 border-purple-600 rounded-md bg-purple-500 hover:bg-purple-400">Ordina</a>
    </div>
    <div class="col-start-1 row-start-1 flex sm:col-start-2 sm:row-span-3">
      <div class="w-full grid grid-cols-3 grid-rows-2 gap-2">
        <div class="relative col-span-3 row-span-2 md:col-span-2">
          <img src="./static/images/index001.jpg" alt="" class="absolute inset-0 w-full h-full object-cover bg-gray-100 sm:rounded-lg" />
        </div>
        <div class="relative hidden md:block">
          <img src="./static/images/pizzeria0.jpg" alt="" class="absolute inset-0 w-full h-full object-cover rounded-lg bg-gray-100" />
        </div>
        <div class="relative hidden md:block">
          <img src="./static/images/index003.jpg" alt="" class="absolute inset-0 w-full h-full object-cover rounded-lg bg-gray-100" />
        </div>
      </div>
    </div>
  </div>
  <?php include_once "./components/menu.php"; ?>
</body>
</html>
