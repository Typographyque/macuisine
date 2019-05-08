"use strict";

///////////////////////////////////////////////////////////
//                FONCTIONS MATERIALIZE                 //
/////////////////////////////////////////////////////////

$(document).ready(function(){
    $('.materialboxed').materialbox();  // ZOOM PHOTO

    $('.sidenav').sidenav();            // MENU MOBILE

    $('select').formSelect();          // GESTION DE CATEGORIES D'ARTICLES

    $('.modal').modal();               // VISIONNEUSE DE COMMENTAIRES
});



///////////////////////////////////////////////////////////
//                   EDITEUR WYSIWYG                    //
/////////////////////////////////////////////////////////

tinymce.init({
    selector: '.editor',
    height: 300,
    theme: 'modern',
    plugins: 'print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
    toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
    image_advtab: true,
});