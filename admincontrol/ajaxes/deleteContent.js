$(document).ready(function () {
    $(".deleteContent").click(function (e) {
        const hrefValue = $(this).attr("href");
        const id = $(this).attr("data-id");
        console.log(hrefValue);
        console.log(id);

        // silme ajax işlemini fonksiyona aldım, tekli silmede soru sorsun çokluda bir kere sorsun sonra komple silsin diye
        function deleteContent(){
            //Ajax'ın kısa hali ve GET method
            $.get(hrefValue,function (response) {
                console.log(response);
                if(response == "true"){
                    $("[data-id='"+id+"']").hide("slow");

                    // headerInfo kısmındaki toplam içerik sayısı için bu cambazlıklar
                    toplamSatirSayisi = $("#toplamSatirSayisi").text();
                    toplamSatirSayisi = toplamSatirSayisi - 1;
                    $("#toplamSatirSayisi").text(toplamSatirSayisi);

                    // sayfada 5 tanede içerik üst üste silinirse sayfa yenilensin
                    // tabi bazen ilk silmeye de denk gelebilir ama olsun
                    if(toplamSatirSayisi % 5 == 0){
                        window.location.reload();
                    }

                }else if(response == "false"){
                    alert("Yazı silinemedi bir hata var!");
                }else{
                    alert("ne true ne false döndü!");
                }
            });
        }

        // çoklu seçimde class name'e tikla diye isim ekliyorum buradan anlıyorum çoklu seçimle seçildiğini
        if($(this).hasClass("tikli")){
            deleteContent();
        }else{
            if(confirm("Yazıyı kalıcı olarak silmek istiyor musun?")){
                deleteContent();
            }
        }


        e.preventDefault();
    });





});