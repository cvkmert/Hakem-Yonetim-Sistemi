<?php
include 'connect.php';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
$query = mysqli_query($conn, "SELECT * FROM gozlemciler WHERE id = '$id'");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $kimlik_numarasi = $row['kimlik_numarasi'];
        $ad_soyad = $row['ad_soyad'];
        $resim = $row['resim'];
        $dogum_tarihi = $row['dogum_tarihi'];
        $meslek = $row['meslek'];
        $tahsil = $row['tahsil'];
        $yabanci_dil = $row['yabanci_dil'];
        $klasman = $row['klasman'];
        $lisans_no = $row['lisans_no'];
    }
}
?>
<div class="page-title">
    <h1>Gözlemci Güncelle - <?php echo $ad_soyad; ?></h1>
</div>
<div class="add-category">

    <div class="add-category product-category form-tab">
        <div class="tab-icerik form-layout">
            <div class="card-body">
                <div class="form-group">
                    <label>Kimlik Numarası:</label>
                    <input type="text" value="<?php echo $kimlik_numarasi; ?>" name="kimlik-numarasi" class="kimlik-numarasi form-control form-control-solid" placeholder="Kimlik Numarası" />
                </div>

                <div class="form-group">
                    <label>Adı ve Soyadı:</label>
                    <input type="text" value="<?php echo $ad_soyad; ?>" name="ad-soyad" class="ad-soyad form-control form-control-solid" placeholder="Ad ve Soyad" />
                </div>

                <div class="form-group">
                    <label>Doğum Tarih:</label>
                    <input type="date" value="<?php echo $dogum_tarihi; ?>" name="dogum-tarihi" id="dogum-tarihi" class="dogum-tarihi form-control form-control-solid" placeholder="Doğum Tarihi" />
                </div>

                <div class="form-group">
                    <label>Meslek:</label>
                    <input type="text" value="<?php echo $meslek; ?>" name="meslek" class="meslek form-control form-control-solid" placeholder="Meslek" />
                </div>

                <div class="form-group">
                    <label>Tahsil:</label>
                    <input type="text" value="<?php echo $tahsil; ?>" name="tahsil" class="tahsil form-control form-control-solid" placeholder="Tahsil" />
                </div>

                <div class="form-group">
                    <label>Yabancı Dil:</label>
                    <input type="text" value="<?php echo $yabanci_dil; ?>" name="yabanci-dil" class="yabanci-dil form-control form-control-solid" placeholder="Yabancı Dil" />
                </div>

                <div class="form-group">
                    <label>Klasman:</label>
                    <input type="text" value="<?php echo $klasman; ?>" name="klasman" class="klasman form-control form-control-solid" placeholder="Klasman" />
                </div>

                <div class="form-group">
                    <label>Lisans No:</label>
                    <input type="text" value="<?php echo $lisans_no; ?>" name="lisans-no" class="lisans-no form-control form-control-solid" placeholder="Lisans No" />
                </div>
            </div>
            <div class="card-body-image">
                <br>
                <div class="form-group-image">
                    <div class="image">
                        <?php
                            if (!empty($resim)) {
                                ?>
                                    <img src="<?php echo $resim; ?>">
                                <?php
                            } else {
                                ?>
                                    <img src="../<?php echo $site_logo; ?>">
                                <?php
                            }
                        ?>
                    </div>
                    <label>Görsel Ekleyin:</label><br>
                    <input type="file" name="hakem-image" class="hakem-image" accept=".jpg,.png,.jpeg,.svg"></input>
                </div>
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
            var kimlik_numarasi = $('.kimlik-numarasi').val();
            var ad_soyad = $('.ad-soyad').val();
           // var dogum_tarihi = $('.dogum-tarihi').val();
            var dogum_tarihi = document.getElementById("dogum-tarihi").value;
            var meslek = $('.meslek').val();
            var tahsil = $('.tahsil').val();
            var yabanci_dil = $('.yabanci-dil').val();
            var klasman = $('.klasman').val();
            var lisans_no = $('.lisans-no').val();
            var image = $(".hakem-image").prop('files')[0];
            var form_data = new FormData();
            form_data.append("id", id);
            form_data.append("kimlik-numarasi", kimlik_numarasi);
            form_data.append("ad-soyad", ad_soyad);
            form_data.append("dogum-tarihi", dogum_tarihi);
            form_data.append("meslek", meslek);
            form_data.append("tahsil", tahsil);
            form_data.append("yabanci-dil", yabanci_dil);
            form_data.append("klasman", klasman);
            form_data.append("lisans-no", lisans_no);
            form_data.append("image", image);
            
            $.ajax({
                url: "post.php?command=gozlemci-guncelle",
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