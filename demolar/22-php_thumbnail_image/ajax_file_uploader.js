
$(document).ready(function () {

    $("#myForm").submit(function (e) {
        e.preventDefault();

        /* Normal Versiyonu */
        // const formUrl = $(this).attr("action");
        // $.ajax({
        //     url: formUrl,
        //     type:'POST',
        //     dataType: "JSON",
        //     data: new FormData(this), //+9 shard
        //     contentType: false,
        //     processData: false,
        //     cache: false,
        //     success: function (response) {
        //
        //         // // ajax içinde dataType: 'JSON' demezsek bu işlemi yapmak zorundayız.
        //         // response = JSON.parse(response);
        //
        //         $("#myDiv1").html(response["bilgilerEski"]);
        //         $("#myDiv2").html(response["orginalFoto"]);
        //         $("#myDiv3").html(response["bilgilerYeni"]);
        //         $("#myDiv4").html(response["yeniFoto"]);
        //
        //     }
        // });

        // Sayfa yenilenmeden tekrar dosya seçersek bar sıfırlansın
        $("#dosyaSec").on("click",function () {
            $(".progress-bar").width('0');
            $(".progress-bar").html('0');
        });

        /* Malsup JQuery Form Başlar... */
        var options = {
            url: 'upload.php',
            method: 'POST',
            dataType: "JSON",
            beforeSubmit: function () {
                $(".progress").show();
                $(".progress-bar").width('%0');
            },
            uploadProgress: function(e,position,total,percentComplete){
                $(".progress-bar").width(percentComplete + '%');
                $(".progress-bar").html(percentComplete + '%');
            },
            success: function(response) {
                $("#myDiv1").html(response["bilgilerEski"]);
                $("#myDiv2").html(response["orginalFoto"]);
                $("#myDiv3").html(response["bilgilerYeni"]);
                $("#myDiv4").html(response["yeniFoto"]);
            },
                // resetForm: true
        };

        // bu kontrolü sağlamazsak dosya seçmeden butona basınca da progress çalışabilir
        if($("#dosyaSec").val()){
            e.preventDefault();
            $("#myForm").ajaxSubmit(options);
        }

        return false;
     /* Malsup JQuery Form Biter... */



    });


});

