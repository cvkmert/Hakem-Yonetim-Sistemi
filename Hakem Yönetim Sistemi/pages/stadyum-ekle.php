<?php
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<div class="page-title">
    <h1>Stadyum Ekle</h1>
</div>
<div class="add-category">

    <div class="add-category product-category form-tab">
        <div class="tab-icerik form-layout">
            <div class="card-body">
                <div class="form-group">
                    <label>Stadyum Adı:</label>
                    <input type="text" name="stadyum-adi" class="stadyum-adi form-control form-control-solid" placeholder="Stadyum Adı" />
                </div>

                <div class="form-group">
                    <label>İl:</label>
                    <select class="form-control select2" id="kt_select2_2" name="il" class="il">
                        <option value="null" disabled selected>Seçin</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM iller");
                        while ($row = mysqli_fetch_array($query)) {
                            $id = $row['id'];
                            $il = $row['il'];
                            echo '<option value="' . $il . '">' . $il . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>İlçe:</label>
                    <input type="text" name="ilce" class="ilce form-control form-control-solid" placeholder="İlçe" />
                </div>
            </div>
            <div class="card-body-image">
                <br>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" name="add" onclick="ekle()" class="kaydet btn btn-success mr-2">Ekle</button>
            <button type="reset" class="btn btn-secondary">Geri Al</button>
        </div>
    </div>

    <script>
        var getid;
        var i = 0;

        function ekle() {
            var stadyum_adi = $('.stadyum-adi').val();
            var il = document.getElementById("kt_select2_2").value;
            var ilce = $('.ilce').val();
            var form_data = new FormData();
            form_data.append("stadyum_adi", stadyum_adi);
            form_data.append("il", il);
            form_data.append("ilce", ilce);
            
            $.ajax({
                url: "post.php?command=stadyum-ekle",
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
                            location.href = "stadyum-guncelle-"+getid;
                        }, 1000);
                        getid = split[2];
                        i += 1;
                    }
                }
            });
        }
    </script>