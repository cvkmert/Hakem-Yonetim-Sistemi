<?php
include 'connect.php';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
$query = mysqli_query($conn, "SELECT * FROM fikstur WHERE id = '$id'");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $tarih = $row['tarih'];
        $saat = $row['saat'];
        $lig = $row['lig'];
        $takim_1 = $row['takim_1'];
        $takim_2 = $row['takim_2'];
        $hakem = $row['hakem'];
        $stadyum = $row['stadyum'];
        $yardimci_hakem_1 = $row['yardimci_hakem_1'];
        $yardimci_hakem_2 = $row['yardimci_hakem_2'];
        $gozlemci = $row['gozlemci'];
    }
}
?>
<div class="page-title">
    <h1>Karşılaşma Güncelle - <?php echo $takim_1.' - '. $takim_2; ?></h1>
</div>
<div class="add-category">

    <div class="add-category product-category form-tab">
        <div class="tab-icerik form-layout">
            <div class="card-body">
                <div class="form-group">
                    <label>Takım 1:</label>
                    <select class="form-control select2" id="kt_select2_1" name="takim-1" class="takim-1">
                        <option value="null" disabled selected>Seçin</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM takimlar");
                        while ($row = mysqli_fetch_array($query)) {
                            $takim = $row['takim_adi'];
                            if ($takim == $takim_1) {
                                echo '<option value="' . $takim . '" selected>' . $takim . '</option>';
                            } else {
                                echo '<option value="' . $takim . '">' . $takim . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Takım 2:</label>
                    <select class="form-control select2" id="kt_select2_2" name="takim-2" class="takim-2">
                        <option value="null" disabled selected>Seçin</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM takimlar");
                        while ($row = mysqli_fetch_array($query)) {
                            $takim = $row['takim_adi'];
                            if ($takim == $takim_2) {
                                echo '<option value="' . $takim . '" selected>' . $takim . '</option>';
                            } else {
                                echo '<option value="' . $takim . '">' . $takim . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tarih:</label>
                    <input type="date" value="<?php echo $tarih; ?>" name="tarih" id="tarih" class="tarih form-control form-control-solid" placeholder="Tarih" />
                </div>

                <div class="form-group">
                    <label>Saat:</label>
                    <input type="time" value="<?php echo $saat; ?>" name="saat" id="saat" class="saat form-control form-control-solid" placeholder="Saat" />
                </div>
                
                <div class="form-group">
                    <label>Stadyum:</label>
                    <select class="form-control select2" id="kt_select2_10" name="takim-2" class="takim-2">
                        <option value="null" disabled selected>Seçin</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM stadyumlar");
                        while ($row = mysqli_fetch_array($query)) {
                            $stadyumm = $row['stadyum_adi'];
                            if ($stadyumm == $stadyum) {
                                echo '<option value="' . $stadyumm . '" selected>' . $stadyumm . '</option>';
                            } else {
                                echo '<option value="' . $stadyumm . '">' . $stadyumm . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Hakem:</label>
                    <select class="form-control select2" id="kt_select2_3" name="takim-2" class="takim-2">
                        <option value="null" disabled selected>Seçin</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM hakemler");
                        while ($row = mysqli_fetch_array($query)) {
                            $hakemm = $row['ad_soyad'];
                            if ($hakemm == $hakem) {
                                echo '<option value="' . $hakemm . '" selected>' . $hakemm . '</option>';
                            } else {
                                echo '<option value="' . $hakemm . '">' . $hakemm . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>1. Yardımcı Hakem:</label>
                    <select class="form-control select2" id="kt_select2_7" name="takim-2" class="takim-2">
                        <option value="null" disabled selected>Seçin</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM hakemler");
                        while ($row = mysqli_fetch_array($query)) {
                            $hakemm = $row['ad_soyad'];
                            if ($hakemm == $yardimci_hakem_1) {
                                echo '<option value="' . $hakemm . '" selected>' . $hakemm . '</option>';
                            } else {
                                echo '<option value="' . $hakemm . '">' . $hakemm . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>2. Yardımcı Hakem:</label>
                    <select class="form-control select2" id="kt_select2_8" name="takim-2" class="takim-2">
                        <option value="null" disabled selected>Seçin</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM hakemler");
                        while ($row = mysqli_fetch_array($query)) {
                            $hakemm = $row['ad_soyad'];
                            if ($hakemm == $yardimci_hakem_2) {
                                echo '<option value="' . $hakemm . '" selected>' . $hakemm . '</option>';
                            } else {
                                echo '<option value="' . $hakemm . '">' . $hakemm . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Gözlemci:</label>
                    <select class="form-control select2" id="kt_select2_9" name="takim-2" class="takim-2">
                        <option value="null" disabled selected>Seçin</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM gozlemciler");
                        while ($row = mysqli_fetch_array($query)) {
                            $gozlemcii = $row['ad_soyad'];
                            if ($gozlemcii == $gozlemci) {
                                echo '<option value="' . $gozlemcii . '" selected>' . $gozlemcii . '</option>';
                            } else {
                                echo '<option value="' . $gozlemcii . '">' . $gozlemcii . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                

                <div class="form-group">
                    <label>Lig:</label>
                    <input type="text" value="<?php echo $lig; ?>" name="lig" id="lig" class="lig form-control form-control-solid" placeholder="Lig" />
                </div>
            </div>
            <div class="card-body-image">
                <br>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" name="add" onclick="guncelle()" class="kaydet btn btn-success mr-2">Güncelle</button>
            <button type="reset" class="btn btn-secondary">Geri Al</button>
        </div>
    </div>

    <script>
        var getid;
        var i = 0;

        function guncelle() {
            var id = "<?php echo $id; ?>";
            var takim1 = document.getElementById("kt_select2_1").value;
            var takim2 = document.getElementById("kt_select2_2").value;
            var tarih = document.getElementById("tarih").value;
            var saat = document.getElementById("saat").value;
            var lig = document.getElementById("lig").value;
            var hakem = document.getElementById("kt_select2_3").value;
            var yardimci1 = document.getElementById("kt_select2_7").value;
            var yardimci2 = document.getElementById("kt_select2_8").value;
            var gozlemci = document.getElementById("kt_select2_9").value;
            var stadyum = document.getElementById("kt_select2_10").value;
            var form_data = new FormData();
            form_data.append('id', id);
            form_data.append('takim1', takim1);
            form_data.append('takim2', takim2);
            form_data.append('tarih', tarih);
            form_data.append('saat', saat);
            form_data.append('lig', lig);
            form_data.append('hakem', hakem);
            form_data.append('yardimci1', yardimci1);
            form_data.append('yardimci2', yardimci2);
            form_data.append('gozlemci', gozlemci);
            form_data.append('stadyum', stadyum);
            
            $.ajax({
                url: "post.php?command=karsilasma-guncelle",
                type: "POST",
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function(result) {
                    var split = result.split("+");
                    var type = split[0];
                    var message = split[1];
                    var message_box = document.getElementById('message-container').innerHTML;
                    if (type == "danger") {
                        document.getElementById("message-container").innerHTML = message_box + `
					<div class="message` + i + `">
						<div class="alert alert-custom alert-danger fade show" role="alert">
							<div class="alert-icon">
								<i class="far fa-check-circle"></i>
							</div>
							<div class="alert-text">
							` + message + `
							</div>
							<div class="alert-close">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true"><i class="ki ki-close"></i></span>
								</button>
							</div>
						</div>
					</div>`;
                        var mbox = ".message" + i;
                        setTimeout(function() {
                            $(mbox).hide(300);
                        }, 5000);
                        i += 1;
                    }
                    if (type == "warning") {
                        document.getElementById("message-container").innerHTML = message_box + `
					<div class="message` + i + `">
						<div class="alert alert-custom alert-warning fade show" role="alert">
							<div class="alert-icon">
								<i class="far fa-check-circle"></i>
							</div>
							<div class="alert-text">
							` + message + `
							</div>
							<div class="alert-close">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true"><i class="ki ki-close"></i></span>
								</button>
							</div>
						</div>
					</div>`;
                        var mbox = ".message" + i;
                        setTimeout(function() {
                            $(mbox).hide(300);
                        }, 5000);
                        i += 1;
                    }
                    if (type == "success") {
                        document.getElementById("message-container").innerHTML = message_box + `
					<div class="message` + i + `">
						<div class="alert alert-custom alert-success fade show" role="alert">
							<div class="alert-icon">
								<i class="far fa-check-circle"></i>
							</div>
							<div class="alert-text">
							` + message + `
							</div>
							<div class="alert-close">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true"><i class="ki ki-close"></i></span>
								</button>
							</div>
						</div>
					</div>`;
                        var mbox = ".message" + i;
                        setTimeout(function() {
                            $(mbox).hide(300);
                        }, 1000);
                        getid = split[2];
                        i += 1;
                    }
                }
            });
        }
    </script>