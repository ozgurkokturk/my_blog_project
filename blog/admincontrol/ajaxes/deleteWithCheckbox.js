$(document).ready(function () {

    // toplu checbox
    $("#theCheckBox").click(function () {
        //Power Of JQUERY :)
        if($(this).is(":checked")){
            $("input[class='myCheckboxes']").prop("checked",true);
        }else{
            $("input[class='myCheckboxes']").prop("checked",false);
        }
    });


    // checkbox'ı tutturamayıp yanına bassak da checked olması için :)
    $("#content-table .firstTd").click(function (e) {

        // console.log(e.target.className);
        // console.log($(this).children(":checkbox").is(":checked"));

        if (e.target.className != "myCheckboxes"){
            if($(this).children(":checkbox").is(":checked")){
                $(this).find('input[type="checkbox"]').prop("checked",false);
            }
            else{
                $(this).find('input[type="checkbox"]').prop("checked",true);
            }
            // bunun nerede durduğu da önemliymiş
            // if 'in dışında olunca checkboxlar normal çalışmıyor!
            e.preventDefault();
        }
    });

    $("#deleteAll").click(function (e) {
        // Classı myCheckboxes olup da chekced olan bütün elementleri gez
        if(confirm("Seçili yazıları kalıcı olarak silmek istiyor musun?")) {
            $("input[class='myCheckboxes']:checked").each(function () {
                // console.log($(this).parent().parent().children(".islemler").children(".deleteContent").html());
                console.log($(this).parent().siblings(".islemler").children(".deleteContent").addClass("tikli"));
                console.log($(this).parent().siblings(".islemler").children(".deleteContent").trigger("click"));

            });
        }
        //bulduğun elementten parent'a çık sonra classı "islemler" olan td'ye kadar git
        // onun child'larından classı "deleteContent" olanı bul ve onu clickle
        e.preventDefault();
    });



});