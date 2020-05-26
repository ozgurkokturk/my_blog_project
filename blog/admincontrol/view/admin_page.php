<?php

if (!isset($_SESSION["kadi"])){
    echo "Session Sorunu <br> Çıkartılıyorsun..";
    header("refresh:2;url=../index.php");
}else{ ?>

    <?php include "header.php"?>



<div class="container">
    <div class="row">
        <div class="col-lg-12">



            <!--      Üstteki Bilgiler     -->
           <div id="headerInfo">
               <ul id="headerInfoUl">
                   <li class="headerInfoLi">Siteye Gelen Tekil Ziyaretçi Sayısı:
                       <span>
                           <?php
                                echo $sumVisitor = sumVisitor($db);
                           ?>
                       </span>
                   </li>
                   <li class="headerInfoLi">Toplam İçerik Sayısı: <span id="toplamSatirSayisi"> <?php echo $toplamSatirSayisi; ?> </span></li>
                   <li class="headerInfoLi">En Çok Okunan İçerik:
                       <span>
                           <?php
                                $popularPost = popularPost($db,$_SESSION["id"]);
                                // Eğer obje olarak gönderip de boş gelseydi okumaya çalışsaydık hata alaaktık
                                // Ama FETCH_ASSOC'da hata vermiyor...
                                echo $popularPost["title"] . " - (" . $popularPost["number"] . ")";
                           ?>
                       </span>
                   </li>
               </ul>
           </div>






            <!--      Tablo Başlığı          -->
            <div id="tableHeaderContainer">
                <div id="pageNoDiv" class="tableHeaderDivs bg-success">
                    <select name="" id="pageNoSelect" class="">
                        <?php $sayfaSayilari = array(5,10,20,50);
                            foreach ($sayfaSayilari as $sayi) {
                                if(!isset($_COOKIE["gosterLimit"])){
                                    echo '
                                        <option value="'.$sayi.'">'.$sayi.'</option>
                                    ';
                                }
                                else{
                                    if($sayi == $_COOKIE["gosterLimit"]){
                                        echo '
                                        <option value="'.$sayi.'" selected>'.$sayi.'</option>
                                    ';
                                    }
                                    else{
                                        echo '
                                        <option value="'.$sayi.'">'.$sayi.'</option>
                                    ';
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>


                <div class="tableHeaderDivs" id="deleteAll">
                    <button class="btn btn-danger">Seçilenleri Sil</button>
                </div>

                <div class="tableHeaderDivs" id="searchContent">
                    <form action="index.php" method="get">
                        <input type="text" name="search" placeholder="Ara" required>
                        <button type="submit">
                            <i class="fas fa-search" ></i>
                        </button>
                    </form>
                </div>

            </div>




                <!--      Tablo         -->
                <table class="table table-striped table-hover" id="content-table">
                    <thead class="thead-dark">
                        <tr>
                            <th><input type="checkbox" id="theCheckBox"></th>
                            <th>id</th>
                            <th>Title</th>
                            <th>Tarih</th>
                            <th>Etiketler</th>
                            <th><span title="Sitedeki görünürlük durumu">Visibility</span></th>
                            <th>Kategori</th>
                            <th style="min-width: 150px !important;">

                                <a class="text-success viewConter" href="index.php?sayfa=<?php echo $pageNo; ?>&order=desc&search=<?php echo $arama; ?>"><i class="fas fa-angle-up"></i></a>
                                <span title="Toplam Görüntüleme Sayısı">Gör. Sayısı</span>
                                <a class="text-danger viewConter" href="index.php?sayfa=<?php echo $pageNo; ?>&order=asc&search=<?php echo $arama; ?>"><i class="fas fa-angle-down"></i></a>
                            </th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($posts as $post) { ?>

                        <tr data-id="<?php echo $post->blogId; ?>">
                            <td class="firstTd"> <input type="checkbox" class="myCheckboxes"> </td>
                            <td><?php echo $post->blogId; ?></td>
                            <td><b><?php echo $post->blogTitle; ?></b></td>
                            <td><?php echo turkcetarih_formati('j F Y',$post->blogTarih); ?></td>
                            <td><?php echo $post->blogLabels; ?></td>
                            <td>
                                <?php
                                    if($post->blogVisibility == "1"){
                                        echo "Açık";
                                    }else if($post->blogVisibility == "0"){
                                        echo "Kapalı";
                                    }else{ echo "Sorun var!";}
                                ?>
                            </td>
                            <td><?php echo $post->blogCategoryTitle; ?></td>
                            <td>
                                <!-- Görüntüleme Sayısı -->
                                <?php
                                    echo $post->number;
                                ?>
                            </td>
                            <td class="islemler">
                                <a class="updateContent" href="index.php?url=duzenle&id=<?php echo $post->blogId; ?>" style="color: darkgoldenrod; padding-right: 10px; font-weight: 600;">Düzenle</a>
                                <a  data-id="<?php echo $post->blogId; ?>" class="deleteContent" href="index.php?url=sil&id=<?php echo $post->blogId; ?>" style="color: darkred; font-weight: 600;">Sil</a>
                            </td>
                        </tr>

                    <?php } ?>

                    <tr>
                        <td colspan="9">
                            <ul class="pagination flex-wrap justify-content-center" style="margin: 0;" >
                                <?php for($i=1; $i<=$paginationCount; $i++): ?>
                                    <li class="page-item"><a class="page-link" href="index.php?sayfa=<?php echo $i;?>&order=<?php echo $siralama; ?>&search=<?php echo $arama; ?>"><?php echo $i;?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </td>
                    </tr>

                    </tbody>
                </table>






        </div>
    </div>

</div>



    <?php include "footer.php"?>



<?php } ?>
