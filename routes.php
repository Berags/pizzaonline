<?php 
    /* Jacopo Beragnoli 5°IC */
    /* Questo file contiene tutte le route della nostra webapp */

    Route::set("index.php", function () {
        Controller::CreateView("Index");
    });

    Route::set('home', function () {
        Home::CreateView("Home");
    });
?>