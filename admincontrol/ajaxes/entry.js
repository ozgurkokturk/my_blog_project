$(document).ready(function () {

    $("#entryForm").submit(function (e) {

        const data = $(this).serializeArray();
        const url = $(this).attr("action");

        $.ajax({
            type : "POST",
            url : url,
            dataType: "JSON",
            data : $(this).serializeArray(),
            success: function (response) {
                if(response.state == "true"){
                    $.growl.notice({  title:"Durum", message: response['message'] });
                    setTimeout(function() { document.location.href = response['newUrl']; }, 2000 );

                    //butonu pasif yaptım sürekli post işlemi tekrarlanmasın basan olursa..
                    $("#entryBtn").prop("disabled",true);

                }else if (response.state == "false"){
                    $.growl.error({  title:"Durum", message: response['message'] });
                    // güvenlik kontrolu doğru bilgiler yanlış ise sayfayı yenile
                    if (response.guvenlikkontrol == "1"){
                       setTimeout(function () { location.reload();},2000);
                        $("#entryBtn").prop("disabled",true);
                    }
                }
                else{
                    console.log(response);
                }

            },
            error: function (response) {
                console.log(response);
            }

        });

        e.preventDefault();
    });


});