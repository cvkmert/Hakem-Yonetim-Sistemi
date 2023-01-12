<?php
include 'connect.php';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
$query = mysqli_query($conn, "SELECT * FROM antrenmanlar WHERE id = '$id'");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $stadyum = $row['stadyum'];
        $tarih = $row['tarih'];
        $saat = $row['saat'];
    }
}
?>
<div class="page-title">
    <h1>Antrenman Güncelle - <?php echo $tarih; ?></h1>
</div>
<div class="add-category">

    <div class="add-category product-category form-tab">
        <div class="tab-icerik form-layout">
            <div class="card-body">
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
                    <select class="form-control select2" id="kt_select2_2" name="stadyum" class="stadyum">
                        <option value="null" disabled selected>Seçin</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM stadyumlar");
                        while ($row = mysqli_fetch_array($query)) {
                            $stadyum_adi = $row['stadyum_adi'];
                            if ($stadyum == $stadyum_adi) {
                                echo '<option value="' . $stadyum_adi . '" selected>' . $stadyum_adi . '</option>';
                            } else {
                                echo '<option value="' . $stadyum_adi . '">' . $stadyum_adi . '</option>';
                            }
                        }
                        ?>
                    </select>
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
            var tarih = document.getElementById("tarih").value;
            var saat = document.getElementById("saat").value;
            var stadyum = document.getElementById("kt_select2_2").value;
            var form_data = new FormData();
            form_data.append("id", id);
            form_data.append("tarih", tarih);
            form_data.append("saat", saat);
            form_data.append("stadyum", stadyum);
            
            $.ajax({
                url: "post.php?command=antrenman-guncelle",
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