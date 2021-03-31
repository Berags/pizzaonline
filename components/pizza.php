<div class="max-w-4xl flex items-center h-auto lg:h-screen flex-wrap mx-auto my-32 lg:my-0">
  <div id="profile" class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white opacity-75 mx-6 lg:mx-0">
    <div class="p-4 md:p-12 text-center lg:text-left">
      <div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-16 h-48 w-48 bg-cover bg-center" style="background-image: url('./static/images/menu/<?php echo $pietanza[0]["imgpath"]; ?>')"></div>
      
      <h1 class="text-3xl font-bold pt-8 lg:pt-0"><?php echo $pietanza[0]["nome"]; ?></h1>
      <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-purple-500 opacity-25"></div>
      <p class="pt-4 pr-4 text-base font-bold flex items-center justify-center lg:justify-start">Pizza <?php echo $pietanza[0]["tipo"];?></p>
      <p class="pt-2 text-gray-600 text-xs lg:text-sm flex items-center justify-center lg:justify-start">Prezzo: €<?php echo $pietanza[0]["prezzo"];?></p>
      <p class="pt-2 mb-2 text-sm"><?php echo $pietanza[0]['descrizione']; ?></p>
      <hr>
      <div>
        <button type="button" name="button" class="mt-1 focus:outline-none text-purple-600 text-sm py-2.5 px-5 rounded-md hover:bg-purple-100" onclick="mostraIngredienti()">Ingredienti</button>
        <ul id="ingredienti" class="ml-4" style="list-style-type:disc">
          <?php
          foreach ($ingredienti as $ingrediente) {
            ?>
            <li>
              <?php echo $ingrediente['nome']; ?>
            </li>
          <?php }
          ?>
        </ul>
      </div>
      
      <div class="pt-12 pb-8 flex justify-center gap-4">
        <?php
        $returnLink = './';
        if(isset($_GET['back'])) {
          $returnLink = $_GET['back'];
        }
        ?>
        <a class="bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 flex rounded-full items-center" href="<?php echo $returnLink?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
          </svg>Indietro
        </a>
        <button class="bg-purple-700 hover:bg-purple-900 text-white font-bold py-2 px-4 flex rounded-full items-center" onclick="aggiungiElementoAlCarrello(<?php echo $pietanza[0]['id_pietanza']; ?>, 1, '<?php echo $pietanza[0]['nome']; ?>', '<?php echo $pietanza[0]['imgpath']; ?>', <?php echo $pietanza[0]['prezzo']; ?>)">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
          </svg>Aggiungi al carrello
        </button>
      </div>
    </div>
    
  </div>
  <!--Img Col-->
  <div class="w-full lg:w-2/5">
    <img src="./static/images/menu/<?php echo $pietanza[0]['imgpath']; ?>" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
  </div>
  
</div>
<script>
$(document).ready(() => $("#ingredienti").hide());
let visibileIngredienti = false;
const mostraIngredienti = () => {
  !visibileIngredienti ? $("#ingredienti").fadeIn() : $("#ingredienti").fadeOut();
  visibileIngredienti = !visibileIngredienti;
}
</script>
