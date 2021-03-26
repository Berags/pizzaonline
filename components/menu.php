<div class="bg-purple-500" id="menu">
  <div class="custom-shape-divider-top-1615023353">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" class="shape-fill" style="fill: #ffffff;" opacity=".25" ></path>
      <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" class="shape-fill" style="fill: #ffffff;" opacity=".5" ></path>
      <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill" style="fill: #ffffff;"></path>
    </svg>
  </div>
  <div class="flex justify-center">
    <h1 class="text-6xl text-white mt-12">MENÙ</h1>
  </div>
  <div class="flex flex-wrap flex-auto">
    <?php
    include_once './classes/DBManager.php';
    include_once './resolvers/pietanze.php';
    $menu = PietanzeResolver::GetMenu();

    foreach($menu as $pietanza) { ?>
      <div class="p-6 mt-10 sm:w-full md:w-1/2 lg:w-1/3">
        <div class="bg-white w-full flex p-1 items-center object-cover rounded-lg shadow-2xl">
          <div class="flex-none w-44 h-44 relative">
            <img src="./static/images/menu/<?php echo $pietanza["imgpath"]; ?>" alt="" class="absolute inset-0 w-full h-full object-cover rounded-lg" />
          </div>
          <div class="flex-auto pl-6">
            <h1 class="w-full flex-none font-semibold mb-2.5 text-purple-900 h-12 overflow-y-auto text-lg">
              <a href="./menu?id_pietanza=<?php echo $pietanza['id_pietanza']; ?>"><?php echo $pietanza["nome"]; ?></a>
            </h1>
            <div class="leading-7 font-bold h-4 mt-2 mb-3">
              €<?php echo $pietanza["prezzo"]; ?>
            </div>
            <div class="flex items-baseline h-16 overflow-y-auto">
              <?php echo $pietanza["descrizione"]; ?>
            </div>
            <div class="flex space-x-3 text-sm font-semibold self-end overflow-y-auto">
              <button type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Aggiungi al carrello" onclick="aggiungiElementoAlCarrello(<?php echo $pietanza['id_pietanza']; ?>, 1, '<?php echo $pietanza['nome']; ?>', '<?php echo $pietanza['imgpath']; ?>', <?php echo $pietanza['prezzo']; ?>)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                  <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
