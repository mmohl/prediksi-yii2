/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

'use strict';

$(document).ready(function() {

    let teknik = $('#teknik-input');
    var table = $('#table-prediction').DataTable({
        searching: false,
        bLengthChange: false,
        responsive: true,
        scrollY: "200px",
        scrollCollapse: true,
        paging: false,
        bInfo: false
    });

//    $('#teknik-button').on('click', function() {
//        table.ajax.url(loadUrl()).load();
//    });
//
//    $('#teknik-input').on('change', function() {
//        table.ajax.url(loadUrl()).load();
//    });

//    function loadUrl() {
//        return `http://localhost/projects/prediksi2/penjualan/error?teknik=${teknik.val()}`;
//    }
});