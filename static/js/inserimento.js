$(document).ready(() => {
  $("#errore_nome").hide();
  $("#errore_descrizione").hide();
  $("#errore_prezzo").hide();
  $("#divTipo").hide();
});
const nome = $("#nome_pietanza");
const descrizione = $("#descrizione");
const prezzo = $("prezzo");
const tipo = $("tipo");

const controllaNomePietanza = () => {
  if (nome.val() === "" || nome.val() === undefined || nome.val() === null) {
    $("#errore_nome").fadeIn();
    return;
  }

  $("#errore_nome").fadeOut();
};

const controllaPrezzo = () => {
  console.log(prezzo.val());
  if (
    prezzo.val() === "" ||
    prezzo.val() === undefined ||
    prezzo.val() === null
  ) {
    $("#errore_prezzo").fadeIn();
    $("#divTipo").show();
    return;
  }

  $("#errore_prezzo").fadeOut();
};

const controllaDescrizione = () => {
  if (
    descrizione.val() === "" ||
    descrizione.val() === undefined ||
    descrizione.val() === null
  ) {
    $("#errore_descrizione").fadeIn();
    return;
  }

  $("#errore_descrizione").fadeOut();
};

const controllaTipo = () => {};

const nuovoIngrediente = () => {
  window.open("./inserimento_ingredienti", "", "width=600,height=600");
};

const aggiungiIngrediente = () => {
  $("#inserimento_ingredienti").append(
    '<input list="ingredienti" name="ingredienti[]" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-2 mt-2"></input>'
  );
};
