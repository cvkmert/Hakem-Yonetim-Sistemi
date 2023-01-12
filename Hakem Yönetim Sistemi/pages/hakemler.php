<div class="page-title">
    <h1>Hakemler</h1>
    <form action="" method="POST">
        <input type="search" class="form-control form-control" name="search" placeholder="Ara.." aria-controls="kt_datatable">
    </form>
    <?php
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
    } else {
        $search = "";
    }
    if (isset($_GET['iter'])) {
        $page = intval($_GET['iter']);
        $page -= 1;
    } else {
        $page = 0;
    }
    echo '<a href="hakem-ekle" class="btn btn-success btn-sm">Yeni Ekle</a>';
    $size = 20;
    if (isset($_GET['id'])) {
        $queryc = mysqli_query($conn, "SELECT * FROM hakemler WHERE ad_soyad LIKE '%$search%'");
        $query = mysqli_query($conn, "SELECT * FROM hakemler WHERE ad_soyad LIKE '%$search%' ORDER BY id DESC LIMIT $page, $size");
    } else {
        $queryc = mysqli_query($conn, "SELECT * FROM hakemler WHERE ad_soyad LIKE '%$search%'");
        $query = mysqli_query($conn, "SELECT * FROM hakemler WHERE ad_soyad LIKE '%$search%' ORDER BY id DESC LIMIT $page, $size");
    }
    $count = mysqli_num_rows($queryc);
    $pagination = ceil($count / $size);
    ?>
</div>
<div class="row">
    <div class="product-category">
        <div class="row">
            <div style="width: 60px;">
            </div>
            <div style="width: calc(20% - 60px);">
                <b>Kimlik Numarası</b>
            </div>
            <div style="width: 20%;">
                <b>Adı ve Soyadı</b>
            </div>
            <div style="width: 20%;">
                <b>Meslek</b>
            </div>
            <div style="width: 20%;">
                <b>Klasman</b>
            </div>
            <div style="width: 20%;">
            </div>
        </div>
        <?php
        echo '
                    <div class="pages" style="width:100%;">
                        ';

        while ($row = mysqli_fetch_array($query)) {
            $id = $row['id'];
            $kimlik_numarasi = $row['kimlik_numarasi'];
            $ad_soyad = $row['ad_soyad'];
            $resim = $row['resim'];
            $meslek = $row['meslek'];
            $klasman = $row['klasman'];
            echo '
                <div class="row rowcont row' . $id . '">
                    <div style="width: 60px;">
                        <img src="' . $resim . '" alt="' . $ad_soyad . '" style="width: 50px; height: 50px; object-fit: cover;">
                    </div>
                    <div style="width: calc(20% - 60px);">
                        ' . $kimlik_numarasi . '
                    </div>
                    <div style="width: 20%; display:flex;">
                        ' . $ad_soyad . '
                    </div>
                    <div style="width: 20%; display:flex;">
                        ' . $meslek . '
                    </div>
                    <div style="width: 20%; display:flex;">
                        ' . $klasman . '
                    </div>
                    <div style="width: 20%; display:flex; justify-content: flex-end">
                        <a href="hakem-guncelle-' . $id . '" class="btn btn-primary mr-2 btn-sm">Güncelle</a>
                        <div class="btn btn-danger btn-sm" onclick="sil(`' . $id . '`,`'.$ad_soyad.'`)">Sil</div>
                    </div>
                </div>
            ';
        }
        echo '</div>';
        ?>
    </div>
</div>
<div class="pagination" style="width: 100%; display: flex; flex-direction: row; align-items: center; justify-content: center;">
    <a href="<?php echo $url; ?>/hys/hakemler/" class="page-button" style="margin: 10px;">
        < </a>
            <?php
            if ($pagination < 10) {
                $i = 1;
                $j = $pagination;
            } else if ($page < 4) {
                $i = 1;
                $j = 9;
            } else if ($page >= $pagination - 4) {
                $i = $pagination - 8;
                $j = $pagination;
            } else {
                $i = $page - 3;
                $j = $page + 5;
            }
            for ($i; $i <= $j; $i++) {
                if ($i == $page + 1) {
                    echo '
                    <a href="' . $url . '/hys/hakemler/' . $i . '" class="page-button active" style="margin: 10px; color: #000;">
                        ' . $i . '
                    </a>
                ';
                } else {
                    echo '
                    <a href="' . $url . '/hys/hakemler/' . $i . '" class="page-button" style="margin: 10px;">
                        ' . $i . '
                    </a>
                ';
                }
            }
            ?>
            <a href="<?php echo $url . '/hys/hakemler/' . $pagination; ?>" class="page-button" style="margin: 10px;">
                >
            </a>
</div>

<script>
    function sil(id, ad_soyad) {
        $.ajax({
            url: "post.php?command=hakem-sil",
            type: "POST",
            data: {
                "id": id,
                "ad": ad_soyad
            },
            success: function(result) {
                if (result == true) {
                    document.getElementsByClassName("alert-text1")[0].innerHTML = "Hakem başarılı bir şekilde silinmiştir.";
                    $(".success").removeClass("disabled-message");
                    $('.row'+id).hide(200);
                } else if (result == "hata") {
                    $(document).ready(function() {
                        document.getElementsByClassName("alert-text3")[0].innerHTML = "Hakem silinirken bir sorun yaşandı!";
                        $(".warning").removeClass("disabled-message");
                    });
                }
            }
        });
    }
</script>