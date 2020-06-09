
$(document).ready(function () {

    $("[name='myForm']").submit(function (e) {
        e.preventDefault();

        const formUrl = $(this).attr("action");

        $.ajax({
            url: 'upload.php',
            type:'POST',
            dataType: "JSON",
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {

                // // ajax içinde dataType: 'JSON' demezsek bu işlemi yapmak zorundayız.
                // response = JSON.parse(response);

                $("#myDiv1").html(response["bilgilerEski"]);
                $("#myDiv2").html(response["orginalFoto"]);
                $("#myDiv3").html(response["bilgilerYeni"]);
                $("#myDiv4").html(response["yeniFoto"]);

            }
        });


    });

});

