<div class="page-title">
    <h1>Stadyumlar</h1>
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
    echo '<a href="stadyum-ekle" class="btn btn-success btn-sm">Yeni Ekle</a>';
    $size = 20;
    if (isset($_GET['id'])) {
        $queryc = mysqli_query($conn, "SELECT * FROM stadyumlar WHERE stadyum_adi LIKE '%$search%'");
        $query = mysqli_query($conn, "SELECT * FROM stadyumlar WHERE stadyum_adi LIKE '%$search%' ORDER BY id DESC LIMIT $page, $size");
    } else {
        $queryc = mysqli_query($conn, "SELECT * FROM stadyumlar WHERE stadyum_adi LIKE '%$search%'");
        $query = mysqli_query($conn, "SELECT * FROM stadyumlar WHERE stadyum_adi LIKE '%$search%' ORDER BY id DESC LIMIT $page, $size");
    }
    $count = mysqli_num_rows($queryc);
    $pagination = ceil($count / $size);
    ?>
</div>
<div class="row">
    <div class="product-category">
        <div class="row">
            <div style="width: 40%;">
                <b>Stadyum Adı</b>
            </div>
            <div style="width: 20%;">
                <b>İl</b>
            </div>
            <div style="width: 20%;">
                <b>İlçe</b>
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
            $stadyum_adi = $row['stadyum_adi'];
            $il = $row['il'];
            $ilce = $row['ilce'];

            echo '
                <div class="row rowcont row' . $id . '">
                    <div style="width: 40%;">
                        ' . $stadyum_adi . '
                    </div>
                    <div style="width: 20%; display:flex;">
                        ' . $il . '
                    </div>
                    <div style="width: 20%; display:flex;">
                        ' . $ilce . '
                    </div>
                    <div style="width: 20%; display:flex; justify-content: flex-end">
                        <a href="stadyum-guncelle-' . $id . '" class="btn btn-primary mr-2 btn-sm">Güncelle</a>
                        <div class="btn btn-danger btn-sm" onclick="sil(`' . $id . '`,`'.$stadyum_adi.'`)">Sil</div>
                    </div>
                </div>
            ';
        }
        echo '</div>';
        ?>
    </div>
</div>
<div class="pagination" style="width: 100%; display: flex; flex-direction: row; align-items: center; justify-content: center;">
    <a href="<?php echo $url; ?>/hys/stadyumlar/" class="page-button" style="margin: 10px;">
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
                    <a href="' . $url . '/hys/stadyumlar/' . $i . '" class="page-button active" style="margin: 10px; color: #000;">
                        ' . $i . '
                    </a>
                ';
                } else {
                    echo '
                    <a href="' . $url . '/hys/stadyumlar/' . $i . '" class="page-button" style="margin: 10px;">
                        ' . $i . '
                    </a>
                ';
                }
            }
            ?>
            <a href="<?php echo $url . '/hys/stadyumlar/' . $pagination; ?>" class="page-button" style="margin: 10px;">
                >
            </a>
</div>

<script>
    function sil(id, stadyum_adi) {
        $.ajax({
            url: "post.php?command=stadyum-sil",
            type: "POST",
            data: {
                "id": id,
                "stadyum_adi": stadyum_adi
            },
            success: function(result) {
                if (result == true) {
                    document.getElementsByClassName("alert-text1")[0].innerHTML = "Stadyum başarılı bir şekilde silinmiştir.";
                    $(".success").removeClass("disabled-message");
                    $('.row'+id).hide(200);
                } else if (result == "hata") {
                    $(document).ready(function() {
                        document.getElementsByClassName("alert-text3")[0].innerHTML = "Stadyum silinirken bir sorun yaşandı!";
                        $(".warning").removeClass("disabled-message");
                    });
                }
            }
        });
    }
</script>