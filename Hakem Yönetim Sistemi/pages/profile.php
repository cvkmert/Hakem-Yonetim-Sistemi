<?php
$getuser = mysqli_query($conn, "SELECT * FROM admin WHERE admin_username = '$username'");
while ($rowuser = mysqli_fetch_array($getuser)) {
    $admin_id = $rowuser['admin_id'];
    $admin_username = $rowuser['admin_username'];
    $admin_phone = $rowuser['admin_phone'];
    $admin_email = $rowuser['admin_email'];
    $admin_image = $rowuser['admin_image'];
}
?>
<h1 class="page-title">Kullanıcı Bilgileri</h1>
<form method="POST" class="form" id="siteinformationsform" enctype="multipart/form-data" action="index.php?page=profile">
    <div class="form-layout">
        <div class="card-body">
            <div class="form-group">
                <input type="text" style="display: none;" name="admin-id" class="admin-id" value="<?php echo $admin_id; ?>">
                <label>Kullanıcı Adı:</label>
                <input type="text" name="admin-username" class="admin-username form-control form-control-solid" placeholder="Kullanıcı adı yazın" <?php
                                                                                                                                    if (!empty($admin_username)) {
                                                                                                                                        echo 'value="' . $admin_username . '"';
                                                                                                                                    }
                                                                                                                                    ?> />
            </div>

            <div class="form-group">
                <label>Telefon:</label>
                <input type="text" name="admin-phone" class="admin-phone form-control form-control-solid" placeholder="Telefon numarası yazın" <?php
                                                                                                                                    if (!empty($admin_phone)) {
                                                                                                                                        echo 'value="' . $admin_phone . '"';
                                                                                                                                    }
                                                                                                                                    ?> />
            </div>

            <div class="form-group">
                <label>E-posta Adresi:</label>
                <input type="text" name="admin-email" class="admin-email form-control form-control-solid" placeholder="E-posta adresi yazın" <?php
                                                                                                                                    if (!empty($admin_email)) {
                                                                                                                                        echo 'value="' . $admin_email . '"';
                                                                                                                                    }
                                                                                                                                    ?> />
            </div>

            <div class="form-group">
                <label>Yeni Şifre:</label>
                <input type="password" name="admin-password" class="admin-password form-control form-control-solid" placeholder="Yeni şifre yazın" />
            </div>
        </div>
        <div class="card-body-image">
            <div class="form-group-image">
                <div class="image">
                    <img src="../<?php if (empty($admin_image)) {
                                    echo $site_logo;
                                } else {
                                    echo $admin_image;
                                } ?>">
                </div>
                <label>Profil Resmi Ekleyin</label><br>
                <input type="file" name="admin-image" class="admin-image" accept=".jpg,.png,.jpeg,.svg" />
            </div>
        </div>
    </div>

    <div class="card-footer">
        <input type="button" name="admin-update-button" class="guncelle btn btn-primary mr-2" value="Güncelle">
        <button type="reset" class="btn btn-secondary">Geri Al</button>
    </div>
</form>

<script>
    $('.guncelle').click(function(e) {
        e.preventDefault();
        var id = $('.admin-id').val();
        var username = $('.admin-username').val();
        var phone = $('.admin-phone').val();
        var mail = $('.admin-email').val();
        var password = $('.admin-password').val();
        var image = $('.admin-image').prop('files')[0];
        var form_data = new FormData();
        form_data.append("id", id);
        form_data.append("username", username);
        form_data.append("phone", phone);
        form_data.append("mail", mail);
        form_data.append("password", password);
        form_data.append("image", image);
        $.ajax({
            url: 'post.php?command=profile-update',
            type: "POST",
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function(result) {
                console.log(result);
                if (result) {
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
                        }, 5000);
                        i += 1;
                    }
                }
            }
        });
    });
</script>