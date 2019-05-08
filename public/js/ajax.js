$(document).ready(function(){

    $('.see_comment').click(function () {
        var id = $(this).attr("id");
        console.log(id);
        $.get("../app/ajax/seeComment.php?",{id: id},function () {
            $("#commentaire_"+id).hide();
        });
    });

    $(".delete_comment").click(function(){
        var id = $(this).attr("id");
        $.get('../app/ajax/delete_comment.php',{id:id},function(){
            $("#commentaire_"+id).hide();
        });
    });


});

