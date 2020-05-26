$(document).ready(function(){

    $("#kategoriEkle").submit(function (e) {
        var url = $(this).attr("action");
        var deger = $.trim($("input[name='categoryName']").val());
        if(deger == ""){
            alert("Metin Kutusu Boş Olamaz");
        }else{
            // Eğer type = "post" demezsek obje göndermemiz lazım
            //serialize kullanacaksak bu olay şart
            $.ajax({
                type: "POST",
                url : url,
                dataType: 'JSON',
                data : $("#kategoriEkle").serialize(),
                success : function (response) {
                    console.log(response);
                    $("#kategori-list").append("<li data-id='"+response.id+"'><b>"+response.cetogryName+"</b></li>");
                    $("#kategoriEkle").trigger("reset");
                    $("#sectionKategori").append("<option data-id='"+response.id+"' value='"+response.id+"'>"+response.cetogryName+"</option>");

                },
                error: function (response) {
                    alert(response);
                }
            });
        }
        // bu kod olmaz ise sayfa yenileniyor
        e.preventDefault();
    });

    $("button[name='deleteCategory']").click(function (e) {
        var url = $("#kategoriIslemler").attr("action");
        var id = $("#sectionKategori").val();
        const data = {
            p: "deleteFromJquery",
            categoryId: id
        };
        if (id <= 0){
            alert("select option'daki seçili değerde bir anormallik var");
        }else{
            console.log(data);
            $.ajax({
                type: "POST",
                url : url,
                data: data,
                success: function (response) {
                    if(response == "true"){
                        $("[data-id='"+id+"']").remove();
                        $("#kategoriIslemler").trigger("reset");
                    }else if(response == "false"){
                        alert("Upss.. \n Silmeye çalıştığın kategoriye ait yazılar var önce onları sil yada kategori adını değiştir.")
                    }else{
                        alert("Anormal Sistem Davranışı! \n Geliştirici Özgür Bey ile İletişime Geçin");
                        console.log(response);
                    }

                },error: function (response) {
                    alert(response);
                }
            });
        }
        e.preventDefault();
    });


    $("button[name='updateCategory']").click(function (e) {
        $("button[name='deleteCategory']").hide(); // Sil butonunu aynı anda kullanabilir ama istemiyorum.

        var id = $("#sectionKategori").val();

        if( id == 0){
            console.log("boş");
            $("#updateWarningSpan").show("slow");
        }
        else{
            // bütün bu taklalar bir butonu 2 defa kullanabilmek için Düzenle  sonra Güncelle aynı butonda
            if($("#sectionKategori option:selected").text() != $("#updateCategoryText").val() && $.trim($("#updateCategoryText").val()) != "" ){
                console.log("değişti");
                var url = $("#kategoriIslemler").attr("action");
                var id = $("#sectionKategori").val();
                var newCategoryName =  $("#updateCategoryText").val();

                console.log($("#updateCategoryText").val());
                console.log(id);
                const data = {
                    p: "updateFromJquery",
                    categoryId: id,
                    newCategoryName: newCategoryName
                };


                if(categoryText != newCategoryName ){
                    $.ajax({
                        type: "POST",
                        url : url,
                        data: data,
                        success: function (response) {
                            if(response == "true"){
                                // Başarılı
                                $("[data-id='"+id+"']").html("<b>"+newCategoryName+"</b>");
                                $("#kategoriIslemler").trigger("reset");
                                resetAll();

                            }else if(response == "false"){
                                alert("Upss.. \n Güncellemeye sırasında bir problem oluştu!");
                            }else{
                                alert("Anormal Sistem Davranışı! \n Geliştirici Özgür Bey ile İletişime Geçin");
                                console.log(response);
                            }

                        },error: function (response) {
                            alert(response);
                        }
                    });


                }
            }
            else{
                var categoryText = $("#sectionKategori option:selected").text();
                console.log(categoryText);
                $("button[name='updateCategory']").text("Güncelle");
                $("button[name='updateCategory']").removeClass("btn-primary");
                $("button[name='updateCategory']").addClass("btn-success");

                $("#updateWarningSpan").hide();
                $(".updateCategoryDiv").show("slow");
                $("#updateCategoryText").val(categoryText);
                console.log("seçildi");
            }
        }
        e.preventDefault();
    });

    // Select değişiklik olursa
    $("#sectionKategori").change(function () {
        $("#updateCategoryText").val($("#sectionKategori option:selected").text());
    });

    // Reset butonuna basılınca
    $("button[name='resetCategory']").click(function () {
        resetAll();
    });

    function resetAll(){
        $("#updateWarningSpan").hide();
        $(".updateCategoryDiv").hide();
        $("button[name='deleteCategory']").show("fast");


        $("button[name='updateCategory']").text("Düzenle");
        $("button[name='updateCategory']").removeClass("btn-success");
        $("button[name='updateCategory']").addClass("btn-primary");
    }

});






/* Eski Still Seriliaze olmadan kullanma */
// $(document).ready(function () {
//     $("#kategoriEkle").on("submit",function () {
//         var that = $(this),
//             url = that.attr("action"),
//             method = that.attr("method"),
//             data = {};
//
//         that.find("[name]").each(function (index, value) {
//             var newThat = $(this),
//                 name = newThat.attr("name"),
//                 value = newThat.val();
//
//             data[name] = value;
//         });
//         console.log(data);
//         return false;
//     });
// });