let dataTable;
const tabellaTotale = () => {
  dataTable = $("#dataTable").DataTable({
    order: [[0, "desc"]],
    ajax: {
      url: "../../api/ordini",
      type: "GET",
      datatype: "json",
      dataSrc: "",
    },
    columns: [
      { data: "id_ordine", width: "10%" },
      { data: "data_ora", width: "30%" },
      {
        data: "prezzo_tot",
        width: "30%",
        render: (data) => {
          return `<span>€${data}</span>`;
        },
      },
      {
        data: "id_cliente",
        render: (data) => {
          return `
          <div class="text-center">
          <a href="../cliente/riepilogo?id=${data}" class='' style='cursor:pointer; width:100px;'>
          ${data}
          </a>
          </div>`;
        },
        width: "30%",
      },
      {
        data: "id_ordine",
        render: (data) => {
          return `
          <div class="text-center">
          <a href="./riepilogo?id=${data}" class='btn btn-success text-white text-center' style='cursor:pointer; width:100px;'>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
          <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
          </svg>
          </a>
          </div>`;
        },
        width: "40%",
      },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Italian.json",
      emptyTable: "Nessuna pietanza trovata",
    },
    width: "100%",
  });
};

const tabellaMensile = () => {
  dataTable = $("#dataTable").DataTable({
    order: [[0, "desc"]],
    ajax: {
      url: "../../api/ordini?tipo=mensile",
      type: "GET",
      datatype: "json",
      dataSrc: "",
    },
    columns: [
      { data: "id_ordine", width: "10%" },
      { data: "data_ora", width: "30%" },
      {
        data: "prezzo_tot",
        width: "30%",
        render: (data) => {
          return `<span>€${data}</span>`;
        },
      },
      {
        data: "id_cliente",
        render: (data) => {
          return `
          <div class="text-center">
          <a href="../cliente/riepilogo?id=${data}" class='' style='cursor:pointer; width:100px;'>
          ${data}
          </a>
          </div>`;
        },
        width: "30%",
      },
      {
        data: "id_ordine",
        render: (data) => {
          return `
          <div class="text-center">
          <a href="./riepilogo?id=${data}" class='btn btn-success text-white text-center' style='cursor:pointer; width:100px;'>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
          <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
          </svg>
          </a>
          </div>`;
        },
        width: "40%",
      },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Italian.json",
      emptyTable: "Nessuna pietanza trovata",
    },
    width: "100%",
  });
};

const tabellaGiornaliero = () => {
  dataTable = $("#dataTable").DataTable({
    order: [[0, "desc"]],
    ajax: {
      url: "../../api/ordini?tipo=giornaliero",
      type: "GET",
      datatype: "json",
      dataSrc: "",
    },
    columns: [
      { data: "id_ordine", width: "10%" },
      { data: "data_ora", width: "30%" },
      {
        data: "prezzo_tot",
        width: "30%",
        render: (data) => {
          return `<span>€${data}</span>`;
        },
      },
      {
        data: "id_cliente",
        render: (data) => {
          return `
          <div class="text-center">
          <a href="../cliente/riepilogo?id=${data}" class='' style='cursor:pointer; width:100px;'>
          ${data}
          </a>
          </div>`;
        },
        width: "30%",
      },
      {
        data: "id_ordine",
        render: (data) => {
          return `
          <div class="text-center">
          <a href="./riepilogo?id=${data}" class='btn btn-success text-white text-center' style='cursor:pointer; width:100px;'>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
          <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
          </svg>
          </a>
          </div>`;
        },
        width: "40%",
      },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Italian.json",
      emptyTable: "Nessuna pietanza trovata",
    },
    width: "100%",
  });
};

const Delete = (url) => {
  swal({
    title: "Sei sicuro?",
    text: "Una volta eliminato non sarà possibile tornare indietro!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type: "GET",
        url: url + "&method=delete",
        success: (data) => {
          console.log(data);
          if (data.status == "ok") {
            toastr.success(data.message);
            dataTable.ajax.reload();
          } else {
            toastr.error(data.message);
          }
        },
      });
    }
  });
};
