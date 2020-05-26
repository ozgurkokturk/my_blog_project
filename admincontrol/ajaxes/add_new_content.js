$(document).ready(function () {

    $("#addNewContent").submit(function (e) {

        //Ckeditor ilk submit'de  textarea boş gönderiyor
        //bu kod submit'den önce ckeditor'u yenilediği için sorun çözülüyor
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }


        const url = $(this).attr("action");
        console.log($(this).serializeArray());

        $.ajax({
            type : "POST",
            url : url,
            dataType: "JSON",
            data : $(this).serializeArray(),
            success: function (response) {
                if(response["state"] == "true"){

                    //butonnun daha fazla basılmasını engelledik önemli !
                    // $("#kaydetBtn").prop("disabled",true);

                    $.growl.notice({  title:"Durum", message: response['message'] });
                    setTimeout(function() { document.location.href = response['newUrl']; }, 3000 );

                }else{
                    $.growl.error({  title:"Durum", message: response['message'] });
                }
            },
            error: function (response) {
                alert("Karater Sınırlamasını geçmiş olabilirsin... Özellikle başlığın 100 karakteri geçmemesine dikkat et!");
                console.log(response);
            }

        });


        e.preventDefault();
    });
});

// $.growl({ title: "Growl", message: "The kitten is awake!" });
// $.growl.error({ message: "The kitten is attacking!" });
// $.growl.notice({ message: "The kitten is cute!" });
// $.growl.warning({ message: "The kitten is ugly!" });

