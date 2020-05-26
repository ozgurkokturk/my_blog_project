$(document).ready(function () {


    $("#pageNoSelect").on("change",function (e) {
        let pageNo = $("#pageNoSelect option:selected").val();

        $.post("index.php",{"limit":pageNo},function(response){
            window.location.reload();
        });


        e.preventDefault();
    });

});