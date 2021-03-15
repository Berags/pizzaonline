<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I tre porcellini - Creazione</title>
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/menu.css">
    <link rel="shortcut icon" href="../images/logo.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../static/js/jquery.js"></script>
</head>
<body>
    <form method='POST' action='post_inserimento.php' id="pietanza" enctype="multipart/form-data">
        <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
            <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                    <div class="max-w-md mx-auto">
                        <div class="flex items-center space-x-5">
                            <div class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">
                                <?php 
                                include_once "../classes/DBManager.php";
                                echo DBManager::query("SELECT MAX(id_pietanza) FROM pietanza;")[0]["MAX(id_pietanza)"] + 1;
                                ?>
                            </div>
                            <div class="block pl-2 font-semibold text-xl text-gray-700">
                                <h1 class="leading-relaxed">Creazione pietanza</h1>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="flex flex-col">
                                    <label class="leading-loose">Nome</label>
                                    <input type="text" onfocusout="controllaNomePietanza()" name="nome_pietanza" id="nome_pietanza" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Nome" required>
                                    <span id="errore_nome" class="text-red-500 text-sm">Il nome della pietanza non deve essere vuoto!</span>
                                </div>
                                <div class="flex flex-col">
                                    <label class="leading-loose">Descrizione</label>
                                    <textarea type="text" name="descrizione" id="descrizione" onfocusout="controllaDescrizione()" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Descrizione" required></textarea>
                                    <span id="errore_descrizione" class="text-red-500 text-sm">La descrizione della pietanza non deve essere vuoto!</span>
                                </div>
                                <div class="flex items-center space-x-10">
                                    <div class="flex flex-col w-2/3">
                                        <label class="leading-loose">Prezzo</label>
                                        <div class="relative focus-within:text-gray-600 text-gray-400">
                                            <input type="number" name="prezzo" id="prezzo" onfocusout="controllaPrezzo()" step="0.01" min = "0.00" name ="prezzo" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required>
                                            <span id="errore_prezzo" class="text-red-500 text-sm">Il prezzo della pietanza non deve essere vuoto!</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="leading-loose">Tipo</label>
                                        <div class="relative focus-within:text-gray-600 text-gray-400">
                                            <select onfocusout="controllaTipo()" class="w-1/3 pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"  name="tipo" id="tipo">
                                                <option value="Rossa">Rossa</option>
                                                <option value="Bianca">Bianca</option>
                                                <option value="Senza glutine">Senza glutine</option>
                                            </select>
                                            <div id="divTipo"><br><br></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex flex-wrap items-center">
                                        <a class="leading-loose cursor-pointer" onclick="nuovoIngrediente()">Ingredienti</a>
                                    </div>
                                    <div id="inserimento_ingredienti">
                                        <input list="ingredienti" name="ingredienti[]" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-2">
                                    </div>
                                    <datalist id="ingredienti" >
                                        <?php 
                                        $ingredienti = DBManager::query("SELECT * FROM ingrediente");
                                        foreach($ingredienti as $ingrediente) {
                                            ?>
                                            <option><?php echo $ingrediente["nome"];?></option>
                                        <?php }?>
                                    </datalist>
                                    <button type="button" onclick="aggiungiIngrediente()">Aggiungi</button>
                                    
                                </div>
                            </div>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <div class="pt-4 flex items-center space-x-4">
                                <button type="reset" class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Annulla
                                </button>
                                <button class="bg-purple-600 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Crea</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="../static/js/inserimento.js"></script>
</body>
</html>