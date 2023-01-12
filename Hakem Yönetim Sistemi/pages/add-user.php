<h1 class="page-title">Kullanıcı Ekle</h1>
<form method="POST" class="form" id="siteinformationsform" enctype="multipart/form-data" action="kullanicilar">
    <div class="form-layout">
        <div class="card-body">
            <div class="form-group">
                <label>Kullanıcı Adı:</label>
                <input type="text" name="admin-username" class="form-control form-control-solid" placeholder="Kullanıcı adı yazın"/>
            </div>

            <div class="form-group">
                <label>Telefon:</label>
                <input type="text" name="admin-phone" class="form-control form-control-solid" placeholder="Telefon numarası yazın"/>
            </div>

            <div class="form-group">
                <label>E-posta Adresi:</label>
                <input type="text" name="admin-email" class="form-control form-control-solid" placeholder="E-posta adresi yazın"/>
            </div>

            <div class="form-group">
                <label>Yeni Şifre:</label>
                <input type="password" name="admin-password" class="form-control form-control-solid" placeholder="Yeni şifre yazın" />
            </div>
        </div>
        <div class="card-body-image">
            <div class="form-group-image">
                <div class="image">
                    <img src="/<?php echo $site_logo;?>">
                </div>
                <label>Profil Resmi Ekleyin</label><br>
                <input type="file" name="admin-image" accept=".jpg,.png,.jpeg,.svg" />
            </div>
            <div class="tool">
                <label for="switch-admin"><b>Yönetici</b></label>
                <span class="switch switch-outline switch-icon switch-primary">
                    <label>
                        <input type="checkbox" value="1" name="admin" id="switch-admin" />
                        <span></span>
                    </label>
                </span>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <input type="submit" name="admin-add-button" class="btn btn-primary mr-2" value="Ekle">
        <button type="reset" class="btn btn-secondary">Geri Al</button>
    </div>
</form>