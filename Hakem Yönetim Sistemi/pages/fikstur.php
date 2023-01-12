<div class="page-title">
    <h1>Fikstür</h1>
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
    echo '<a href="karsilasma-ekle" class="btn btn-success btn-sm">Yeni Ekle</a>';
    $size = 20;
    if (isset($_GET['id'])) {
        $queryc = mysqli_query($conn, "SELECT * FROM fikstur WHERE lig LIKE '%$search%' OR takim_1 LIKE '%$search%' OR takim_2 LIKE '%$search%' OR hakem LIKE '%$search%' OR yardimci_hakem_1 LIKE '%$search%' OR yardimci_hakem_2 LIKE '%$search%' OR gozlemci LIKE '%$search%' OR stadyum LIKE '%$search%'");
        $query = mysqli_query($conn, "SELECT * FROM fikstur WHERE lig LIKE '%$search%' OR takim_1 LIKE '%$search%' OR takim_2 LIKE '%$search%' OR hakem LIKE '%$search%' OR yardimci_hakem_1 LIKE '%$search%' OR yardimci_hakem_2 LIKE '%$search%' OR gozlemci LIKE '%$search%' OR stadyum LIKE '%$search%' ORDER BY id DESC LIMIT $page, $size");
    } else {
        $queryc = mysqli_query($conn, "SELECT * FROM fikstur WHERE lig LIKE '%$search%' OR takim_1 LIKE '%$search%' OR takim_2 LIKE '%$search%' OR hakem LIKE '%$search%' OR yardimci_hakem_1 LIKE '%$search%' OR yardimci_hakem_2 LIKE '%$search%' OR gozlemci LIKE '%$search%' OR stadyum LIKE '%$search%'");
        $query = mysqli_query($conn, "SELECT * FROM fikstur WHERE lig LIKE '%$search%' OR takim_1 LIKE '%$search%' OR takim_2 LIKE '%$search%' OR hakem LIKE '%$search%' OR yardimci_hakem_1 LIKE '%$search%' OR yardimci_hakem_2 LIKE '%$search%' OR gozlemci LIKE '%$search%' OR stadyum LIKE '%$search%' ORDER BY id DESC LIMIT $page, $size");
    }
    $count = mysqli_num_rows($queryc);
    $pagination = ceil($count / $size);
    ?>
</div>
<div class="row">
    <div class="product-category">
        <div class="row">
            <div style="width: 15%;">
                <b>Takım 1</b>
            </div>
            <div style="width: 15%;">
                <b>Takım 2</b>
            </div>
            <div style="width: 15%;">
                <b>Hakem</b>
            </div>
            <div style="width: 15%;">
                <b>Stadyum</b>
            </div>
            <div style="width: 15%;">
                <b>Tarih</b>
            </div>
            <div style="width: 5%;">
                <b>Saat</b>
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
            $takim_1 = $row['takim_1'];
            $takim_2 = $row['takim_2'];
            $hakem = $row['hakem'];
            $stadyum = $row['stadyum'];
            $tarih = $row['tarih'];
            $saat = $row['saat'];
            $lig = $row['lig'];
            $yardimci_hakem_1 = $row['yardimci_hakem_1'];
            $yardimci_hakem_2 = $row['yardimci_hakem_2'];
            $gozlemci = $row['gozlemci'];
            
            echo '
                <div class="row rowcont row' . $id . '">
                    <div style="width: 15%;">
                        ' . $takim_1 . '
                    </div>
                    <div style="width: 15%;">
                        ' . $takim_2 . '
                    </div>
                    <div style="width: 15%;">
                        ' . $hakem . '
                    </div>
                    <div style="width: 15%;">
                        ' . $stadyum . '
                    </div>
                    <div style="width: 15%;">
                        ' . $tarih . '
                    </div>
                    <div style="width: 5%;">
                        ' . $saat . '
                    </div>
                    <div style="width: 20%; display:flex; justify-content: flex-end">
                        <a href="karsilasma-guncelle-' . $id . '" class="btn btn-primary mr-2 btn-sm">Güncelle</a>
                        <div class="btn btn-danger btn-sm" onclick="sil(`' . $id . '`,`'.$takim_1.' - '.$takim_2.'`)">Sil</div>
                    </div>
                </div>
            ';
        }
        echo '</div>';
        ?>
    </div>
</div>
<div class="pagination" style="width: 100%; display: flex; flex-direction: row; align-items: center; justify-content: center;">
    <a href="<?php echo $url; ?>/hys/fikstur/" class="page-button" style="margin: 10px;">
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
                    <a href="' . $url . '/hys/fikstur/' . $i . '" class="page-button active" style="margin: 10px; color: #000;">
                        ' . $i . '
                    </a>
                ';
                } else {
                    echo '
                    <a href="' . $url . '/hys/fikstur/' . $i . '" class="page-button" style="margin: 10px;">
                        ' . $i . '
                    </a>
                ';
                }
            }
            ?>
            <a href="<?php echo $url . '/hys/fikstur/' . $pagination; ?>" class="page-button" style="margin: 10px;">
                >
            </a>
</div>

<script>
    function sil(id, takim_adi) {
        $.ajax({
            url: "post.php?command=karsilasma-sil",
            type: "POST",
            data: {
                "id": id,
                "takim_adi": takim_adi
            },
            success: function(result) {
                if (result == true) {
                    document.getElementsByClassName("alert-text1")[0].innerHTML = "Karşılaşma başarılı bir şekilde silinmiştir.";
                    $(".success").removeClass("disabled-message");
                    $('.row'+id).hide(200);
                } else if (result == "hata") {
                    $(document).ready(function() {
                        document.getElementsByClassName("alert-text3")[0].innerHTML = "Karşılaşma silinirken bir sorun yaşandı!";
                        $(".warning").removeClass("disabled-message");
                    });
                }
            }
        });
    }
</script>