<?php 
if (isset($_POST['admin-add-button'])) {
    $admin_username = $_POST['admin-username'];
    $admin_phone = $_POST['admin-phone'];
    $admin_email = $_POST['admin-email'];
    $admin_password = $_POST['admin-password'];
    $admin_password = md5(sha1(crc32($admin_password)));
    $admin_image_name = $_FILES['admin-image']['name'];
    $admin = $_POST['admin'];
    $error = 0;
    if ($admin_username != $username) {
        $getusers = mysqli_query($conn, "SELECT * FROM users WHERE a_username = '$admin_username'");
        if (mysqli_num_rows($getusers) > 0) {
            $error = 1;
            echo '
                    <script>
                        $(document).ready(function() {
                        document.getElementsByClassName("alert-text3")[0].innerHTML = "Bu kullanıcı adı zaten kullanılıyor!";
                        $(".warning").removeClass("disabled-message");
                        });
                    </script>';
        }
    }
    if ($error != 1 and $admin_email != $a_email) {
        $getmail = mysqli_query($conn, "SELECT * FROM users WHERE a_email = '$admin_email'");
        if (mysqli_num_rows($getmail) > 0) {
            $error = 1;
            echo '
                    <script>
                        $(document).ready(function() {
                        document.getElementsByClassName("alert-text3")[0].innerHTML = "Bu eposta zaten kullanılıyor!";
                        $(".warning").removeClass("disabled-message");
                        });
                    </script>';
        }
    }
    if ($_FILES['admin-image']['error']) {
        if (empty($admin_image_name)) {
            $admin_image = "cw_admin/assets/media/users/blank.png";
        }
        $error_image = 1;
    }
    if ($error != 1 and $error_image != 1) {
        $admin_image = "../img/" . $admin_image_name;
        if (move_uploaded_file($_FILES["admin-image"]["tmp_name"], $admin_image)) {
            $admin_image = "img/" . $admin_image_name;
        } else {
            $error = 1;
            echo '
                <script>
                    $(document).ready(function() {
                        document.getElementsByClassName("alert-text2")[0].innerHTML = "Profil resmi eklenirken bir hata ile karşılaşıldı!";
                        $(".failed").removeClass("disabled-message");
                    });
                </script>';
        }
    }
    if ($error != 1) {
        $adduser = mysqli_query($conn, "INSERT INTO users(
            a_username,
            a_password,
            a_phone,
            a_email,
            a_image,
            a_admin
        )
        VALUES(
            '$admin_username',
            '$admin_password',
            '$admin_phone',
            '$admin_email',
            '$admin_image',
            '$admin')");
        if ($adduser) {
            echo '
                    <script>
                        $(document).ready(function() {
                            document.getElementsByClassName("alert-text1")[0].innerHTML = "Kullanıcı başarılı bir şekilde eklendi.";
                            $(".success").removeClass("disabled-message");
                        });
                    </script>';
            $date = date('d-m-Y H:i:s', time());
            $activity_name = $admin_username. " kullanıcısı eklendi.";
            $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
                        VALUES('$activity_name', '$username', '$date', '4')");
        } else {
            echo '
                    <script>
                        $(document).ready(function() {
                          document.getElementsByClassName("alert-text2")[0].innerHTML = "Yeni kullanıcı eklenirken bir hata ile karşılaşıldı!";
                            $(".failed").removeClass("disabled-message");
                        });
                    </script>';
        }
    } else {
        echo '
                <script>
                    $(document).ready(function() {
                      document.getElementsByClassName("alert-text2")[0].innerHTML = "Yeni kullanıcı eklenirken bir hata ile karşılaşıldı!";
                        $(".failed").removeClass("disabled-message");
                    });
                </script>';
    }
}
$getusers = mysqli_query($conn, "SELECT * FROM users");
while ($rowusers = mysqli_fetch_array($getusers)) {
    $user_id = $rowusers['id'];
    $user_name = $rowusers['a_username'];
    if (isset($_POST["user-delete" . $user_id])) {
        $deleteuser = mysqli_query($conn, "DELETE FROM users WHERE id = '$user_id'");
        if ($deleteuser) {
            echo '
                    <script>
                        $(document).ready(function() {
                            document.getElementsByClassName("alert-text1")[0].innerHTML = "Kullanıcı başarılı bir şekilde silinmiştir.";
                            $(".success").removeClass("disabled-message");
                        });
                    </script>';
                    $date = date('d-m-Y H:i:s', time());
                    $activity_name = $user_name." kullanıcı silindi!";
                    $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
                    VALUES('$activity_name', '$username', '$date', '3')");
        } else {
            echo '
                    <script>
                        $(document).ready(function() {
                            document.getElementsByClassName("alert-text2")[0].innerHTML = "Silme işlemi sırasında bir sorun oluştu!";
                            $(".failed").removeClass("disabled-message");
                        });
                    </script>';
        }
    }
}
?>
<form method="POST" action="index.php?page=users" enctype="multipart/form-data">
    <div class="page-title">
        <h1>Kullanıcılar</h1>
        <!-- Button trigger modal-->
        <a href="index.php?page=add-user" class="btn btn-success btn-sm">Yeni Ekle</a>
    </div>
    <div class="product-category">
        <div class="row">
            <div class="image">
            </div>
            <div class="name">
                <b>Kullanıcı Adı</b>
            </div>
            <div class="phone">
                <b>Telefon</b>
            </div>
            <div class="mail">
                <b>E-Posta</b>
            </div>
            <div class="delete">
            </div>
        </div>
        <?php
        $getusers = mysqli_query($conn, "SELECT * FROM users");
        while ($rowusers = mysqli_fetch_array($getusers)) {
            $user_id = $rowusers['id'];
            $user_name = $rowusers['a_username'];
            $user_phone = $rowusers['a_phone'];
            $user_mail = $rowusers['a_email'];
            $user_image = $rowusers['a_image'];
            $silinemez = $rowusers['silinemez'];
            echo '
                <div class="row">
                    <div class="image">
                        <img src="/';if(empty($user_image)) {echo $site_logo;} else {echo $user_image;} echo '">
                    </div>
                    <div class="name">
                        ' . $user_name . '
                    </div>
                    <div class="phone">
                        ' . $user_phone . '
                    </div>
                    <div class="mail">
                        ' . $user_mail . '
                    </div>
                    <div class="delete">';
                        if ($silinemez != '1') {
                            echo '
                            <input type="submit" name="user-delete' . $user_id . '" class="btn btn-danger" value="Sil">';
                        }
                        echo '
                    </div>
                </div>
            ';
        }
        ?>
    </div>
</form>