const _localStorage = window.localStorage;
let totale = 0;

const ottieniCarrello = () => {
  return JSON.parse(_localStorage.getItem("carrello"));
};

const salvaCarrello = (nuovoCarrello) => {
  _localStorage.setItem("carrello", JSON.stringify(nuovoCarrello));
};

const mostraCarrello = () => {};

const eliminaElemento = (index) => {
  console.log(index);
  let nuovoCarrello = ottieniCarrello();
  nuovoCarrello[index] = null;
  console.table(nuovoCarrello);
  salvaCarrello(nuovoCarrello);
};

const eliminaCarrello = () => {
  totale = 0;
  _localStorage.removeItem("carrello");
  $("#ordini").html("");
  $("#totale").html("€" + totale.toFixed(2));
};

const aggiungiElementoAlCarrello = (id, quantita, nome, imgpath, prezzo) => {
  const carrello = ottieniCarrello() || [];
  carrello.push({ id, quantita, nome, imgpath, prezzo });
  console.table(carrello);
  _localStorage.setItem("carrello", JSON.stringify(carrello));
  toastr["success"]("Pietanza aggiunta correttamente al carrello!", "Carrello");
};

const componiTabella = (carrello) => {
  if(!carrello) {
    return;
  }
  carrello
  .filter((el) => {
    if (el === null) return false;
    return true;
  })
  .map((element, index) => {
    totale += element.prezzo * element.quantita;
    // Creazione dell'elemento
    const row = `
    <div class="flex flex-row justify-between items-center mb-4" id="${index}">
    <div class="flex flex-row items-center w-2/5">
    <img src="./static/images/menu/${
      element.imgpath
    }" class="w-10 h-10 object-cover rounded-md" alt="">
    <span class="ml-4 font-semibold text-sm">${element.nome}</span>
    </div>
    <div class="w-32 flex justify-between">
    <input type="hidden" value="${element.id}" name="id[]">
    <span class="px-3 py-1 rounded-md bg-gray-300 cursor-pointer" onclick="rimuoviDaCarrello(${index}, ${
      element.prezzo
    })">-</span>
    <input id="input-${index}" name="quantita[]" readonly class="font-semibold mx-4 w-2" value="${
      element.quantita
    }">
    <span class="px-3 py-1 rounded-md bg-gray-300 cursor-pointer" onclick="aggiungiDaCarrello(${index}, ${
      element.prezzo
    })">+</span>
    </div>
    <div class="font-semibold text-lg w-16 text-center">
    ${element.quantita * element.prezzo}
    </div>
    </div>
    `;
    $("#ordini").append(row);
  });
  console.log(totale);
  $("#totale").html("€" + totale);
};

const aggiungiDaCarrello = (index, prezzo) => {
  let input = document.getElementById("input-" + index);
  input.value = parseInt(input.value) + 1;
  totale += prezzo;
  $("#totale").html("€" + totale.toFixed(2));
};

const rimuoviDaCarrello = (index, prezzo) => {
  let input = document.getElementById("input-" + index);
  input.value = parseInt(input.value) - 1;
  totale -= prezzo;
  if (input.value <= 0) {
    $("#" + index).remove();
    eliminaElemento(index);
  }
  if (totale < 0) totale = 0;
  $("#totale").html("€" + totale.toFixed(2));
};

const controllaInvio = () => {
  if (!_localStorage["carrello"]) {
    toastr["error"]("Devi selezionare almeno una pietanza!", "Carrello");
    return;
  }
  $("#ordini").submit();
};
