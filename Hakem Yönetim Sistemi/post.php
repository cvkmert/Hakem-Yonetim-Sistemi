<?php
session_start();
$username = $_SESSION['username'];
include "connect.php";
date_default_timezone_set('Europe/Istanbul');

if ($_GET['command']) {
    $command = $_GET['command'];
}

if ($command == "hakem-sil") {
    $id = $_POST['id'];
    $ad = $_POST['ad'];

    $query = mysqli_query($conn, "DELETE FROM hakemler WHERE id = '$id'");
    if ($query) {
        $text = 'Hakem silindi. ('.$ad.')';
        $date = date('d-m-Y H:i:s', time());
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '3')");

        echo true;
    } else {
        echo "hata";
    }
}


if ($command == "hakem-ekle") {
    $kimlik_numarasi = $_POST['kimlik-numarasi'];
    $ad_soyad = $_POST['ad-soyad'];
    $dogum_tarihi = $_POST['dogum-tarihi'];
    $meslek = $_POST['meslek'];
    $boy = $_POST['boy'];
    $kilo = $_POST['kilo'];
    $tahsil = $_POST['tahsil'];
    $yabanci_dil = $_POST['yabanci-dil'];
    $klasman = $_POST['klasman'];
    $lisans_no = $_POST['lisans-no'];
    
    if (isset($_POST['image'])) {
        $newfilename = "";
    } else {
        $filename = $kimlik_numarasi . "-" . rand(1000, 5000);
        $target_directory = "img/";
        $target_file = $target_directory . basename($_FILES['image']['name']);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $newfilename = $target_directory . $filename . '.' . $file_type;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $newfilename)) {
        } else {
            $newfilename = "";
        }
    }
    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "INSERT INTO hakemler (
        kimlik_numarasi,
        ad_soyad,
        resim,
        dogum_tarihi,
        meslek,
        boy,
        kilo,
        tahsil,
        yabanci_dil,
        klasman,
        lisans_no,
        kayit_tarihi)
        VALUES (
            '$kimlik_numarasi',
            '$ad_soyad',
            '$newfilename',
            '$dogum_tarihi',
            '$meslek',
            '$boy',
            '$kilo',
            '$tahsil',
            '$yabanci_dil',
            '$klasman',
            '$lisans_no',
            '$date'
        )"
    );

    if ($query) {
        $getid = mysqli_query($conn, "SELECT * FROM hakemler");
        while ($r = mysqli_fetch_array($getid)) {
            $id = $r['id'];
        }
        $text = 'Hakem eklendi. ('.$ad_soyad.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '2')");

        echo "success+Hakem başarılı bir şekilde eklenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}


if ($command == "hakem-guncelle") {
    $id = $_POST['id'];
    $kimlik_numarasi = $_POST['kimlik-numarasi'];
    $ad_soyad = $_POST['ad-soyad'];
    $dogum_tarihi = $_POST['dogum-tarihi'];
    $meslek = $_POST['meslek'];
    $boy = $_POST['boy'];
    $kilo = $_POST['kilo'];
    $tahsil = $_POST['tahsil'];
    $yabanci_dil = $_POST['yabanci-dil'];
    $klasman = $_POST['klasman'];
    $lisans_no = $_POST['lisans-no'];

    $query = mysqli_query($conn, "SELECT * FROM hakemler WHERE id = '$id'"); {
        while ($row = mysqli_fetch_array($query)) {
            $oldimage = $row['resim'];
        }
    }
    
    if (isset($_POST['image'])) {
        $newfilename = $oldimage;
    } else {
        $filename = $kimlik_numarasi . "-" . rand(1000, 5000);
        $target_directory = "img/";
        $target_file = $target_directory . basename($_FILES['image']['name']);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $newfilename = $target_directory . $filename . '.' . $file_type;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $newfilename)) {
        } else {
            $newfilename = "";
        }
    }
    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "UPDATE hakemler SET
        kimlik_numarasi = '$kimlik_numarasi',
        ad_soyad = '$ad_soyad',
        resim = '$newfilename',
        dogum_tarihi = '$dogum_tarihi',
        meslek = '$meslek',
        boy = '$boy',
        kilo = '$kilo',
        tahsil = '$tahsil',
        yabanci_dil = '$yabanci_dil',
        klasman = '$klasman',
        lisans_no = '$lisans_no'
        WHERE id = '$id'
    ");

    if ($query) {
        $text = 'Hakem güncellendi. ('.$ad_soyad.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '4')");

        echo "success+Hakem başarılı bir şekilde güncellenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}





if ($command == "profile-update") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $password = md5(sha1(crc32($password)));
    $error = 0;

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = '$id'");
    while ($row = mysqli_fetch_array($query)) {
        $usernamea = $row['admin_username'];
        $phonea = $row['admin_phone'];
        $maila = $row['admin_email'];
        $passworda = $row['admin_password'];
    }

    if (empty($username)) {
        $username = $usernamea;
    }

    if (empty($password)) {
        $password = $passworda;
    }


    $query = mysqli_query($conn, "SELECT * FROM admin WHERE admin_username = '$username' AND admin_id != '$id'");
    if (mysqli_num_rows($query) > 0) {
        $error = 1;
        echo "danger+Bu kullanıcı adını bir başkası kullanıyor. Lütfen farklı bir kullanıcı adı deneyiniz.";
    }

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE admin_email = '$mail' admin_email != '' AND admin_id != '$id'");
    if (mysqli_num_rows($query) > 0) {
        $error = 1;
        echo "danger+Bu e-posta adresini bir başkası kullanıyor. Lütfen farklı bir e-posta adresi deneyiniz.";
    }

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE admin_phone = '$phone' AND admin_phone != '' AND admin_id != '$id'");
    if (mysqli_num_rows($query) > 0) {
        $error = 1;
        echo "danger+Bu telefon numarasını bir başkası kullanıyor. Lütfen farklı bir telefon numarası deneyiniz.";
    }

    if ($error != 1) {

        $query = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = '$id'"); {
            while ($row = mysqli_fetch_array($query)) {
                $oldimage = $row['admin_image'];
            }
        }

        if (isset($_POST['image'])) {
            $newfilename = $oldimage;
        } else {
            $filename = $url . "-" . rand(1000, 5000);
            $target_directory = "img/upload/";
            $target_file = $target_directory . basename($_FILES['image']['name']);
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $newfilename = $target_directory . $filename . '.' . $file_type;
            if (move_uploaded_file($_FILES['image']['tmp_name'], "../" . $newfilename)) {
            } else {
                $newfilename = $oldimage;
            }
        }
        $query = mysqli_query($conn, "UPDATE admin SET
                admin_username = '$username',
                admin_phone = '$phone',
                admin_email = '$mail',
                admin_password = '$password',
                admin_image = '$newfilename'
                WHERE admin_id = '$id'");
        if ($query) {

            $date = date('d-m-Y H:i:s', time());
            $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
                VALUES('Profil güncellendi.', '$username', '$date', '5')");

            echo "success+Profil başarılı bir şekilde güncellenmiştir.";
        } else {
            echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
        }
    }
}




if ($command == "gozlemci-ekle") {
    $kimlik_numarasi = $_POST['kimlik-numarasi'];
    $ad_soyad = $_POST['ad-soyad'];
    $dogum_tarihi = $_POST['dogum-tarihi'];
    $meslek = $_POST['meslek'];
    $tahsil = $_POST['tahsil'];
    $yabanci_dil = $_POST['yabanci-dil'];
    $klasman = $_POST['klasman'];
    $lisans_no = $_POST['lisans-no'];
    
    if (isset($_POST['image'])) {
        $newfilename = "";
    } else {
        $filename = $kimlik_numarasi . "-" . rand(1000, 5000);
        $target_directory = "img/";
        $target_file = $target_directory . basename($_FILES['image']['name']);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $newfilename = $target_directory . $filename . '.' . $file_type;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $newfilename)) {
        } else {
            $newfilename = "";
        }
    }
    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "INSERT INTO gozlemciler (
        kimlik_numarasi,
        ad_soyad,
        resim,
        dogum_tarihi,
        meslek,
        tahsil,
        yabanci_dil,
        klasman,
        lisans_no,
        kayit_tarihi)
        VALUES (
            '$kimlik_numarasi',
            '$ad_soyad',
            '$newfilename',
            '$dogum_tarihi',
            '$meslek',
            '$tahsil',
            '$yabanci_dil',
            '$klasman',
            '$lisans_no',
            '$date'
        )"
    );
    if ($query) {
        $getid = mysqli_query($conn, "SELECT * FROM gozlemciler");
        while ($r = mysqli_fetch_array($getid)) {
            $id = $r['id'];
        }
        $text = 'Gözlemci eklendi. ('.$ad_soyad.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '2')");

        echo "success+Gözlemci başarılı bir şekilde eklenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}


if ($command == "gozlemci-guncelle") {
    $id = $_POST['id'];
    $kimlik_numarasi = $_POST['kimlik-numarasi'];
    $ad_soyad = $_POST['ad-soyad'];
    $dogum_tarihi = $_POST['dogum-tarihi'];
    $meslek = $_POST['meslek'];
    $tahsil = $_POST['tahsil'];
    $yabanci_dil = $_POST['yabanci-dil'];
    $klasman = $_POST['klasman'];
    $lisans_no = $_POST['lisans-no'];

    $query = mysqli_query($conn, "SELECT * FROM gozlemciler WHERE id = '$id'"); {
        while ($row = mysqli_fetch_array($query)) {
            $oldimage = $row['resim'];
        }
    }
    
    if (isset($_POST['image'])) {
        $newfilename = $oldimage;
    } else {
        $filename = $kimlik_numarasi . "-" . rand(1000, 5000);
        $target_directory = "img/";
        $target_file = $target_directory . basename($_FILES['image']['name']);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $newfilename = $target_directory . $filename . '.' . $file_type;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $newfilename)) {
        } else {
            $newfilename = "";
        }
    }
    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "UPDATE gozlemciler SET
        kimlik_numarasi = '$kimlik_numarasi',
        ad_soyad = '$ad_soyad',
        resim = '$newfilename',
        dogum_tarihi = '$dogum_tarihi',
        meslek = '$meslek',
        tahsil = '$tahsil',
        yabanci_dil = '$yabanci_dil',
        klasman = '$klasman',
        lisans_no = '$lisans_no'
        WHERE id = '$id'
    ");

    if ($query) {
        $text = 'Gözlemci güncellendi. ('.$ad_soyad.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '4')");

        echo "success+Gözlemci başarılı bir şekilde güncellenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}

if ($command == "gozlemci-sil") {
    $id = $_POST['id'];
    $ad = $_POST['ad'];

    $query = mysqli_query($conn, "DELETE FROM gozlemciler WHERE id = '$id'");
    if ($query) {
        $text = 'Gözlemci silindi. ('.$ad.')';
        $date = date('d-m-Y H:i:s', time());
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '3')");

        echo true;
    } else {
        echo "hata";
    }
}




if ($command == "egitim-ekle") {
    $konu = $_POST['konu'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $yer = $_POST['yer'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "INSERT INTO egitimler (
        konu,
        tarih,
        saat,
        yer,
        kayit_tarihi)
        VALUES (
            '$konu',
            '$tarih',
            '$saat',
            '$yer',
            '$date'
        )"
    );
    if ($query) {
        $getid = mysqli_query($conn, "SELECT * FROM egitimler");
        while ($r = mysqli_fetch_array($getid)) {
            $id = $r['id'];
        }
        $text = 'Eğitim eklendi. ('.$konu.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '2')");

        echo "success+Eğitim başarılı bir şekilde eklenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}


if ($command == "egitim-guncelle") {
    $id = $_POST['id'];
    $konu = $_POST['konu'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $yer = $_POST['yer'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "UPDATE egitimler SET
        konu = '$konu',
        tarih = '$tarih',
        saat = '$saat',
        yer = '$yer'
        WHERE id = '$id'
    ");

    if ($query) {
        $text = 'Eğitim güncellendi. ('.$konu.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '4')");

        echo "success+Eğitim başarılı bir şekilde güncellenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}

if ($command == "egitim-sil") {
    $id = $_POST['id'];
    $konu = $_POST['konu'];

    $query = mysqli_query($conn, "DELETE FROM egitimler WHERE id = '$id'");
    if ($query) {
        $text = 'Eğitim silindi. ('.$konu.')';
        $date = date('d-m-Y H:i:s', time());
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '3')");

        echo true;
    } else {
        echo "hata";
    }
}




if ($command == "stadyum-ekle") {
    $stadyum_adi = $_POST['stadyum_adi'];
    $il = $_POST['il'];
    $ilce = $_POST['ilce'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "INSERT INTO stadyumlar (
        stadyum_adi,
        il,
        ilce,
        kayit_tarihi)
        VALUES (
            '$stadyum_adi',
            '$il',
            '$ilce',
            '$date'
        )"
    );
    if ($query) {
        $getid = mysqli_query($conn, "SELECT * FROM stadyumlar");
        while ($r = mysqli_fetch_array($getid)) {
            $id = $r['id'];
        }
        $text = 'Stadyum eklendi. ('.$stadyum_adi.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '2')");

        echo "success+Stadyum başarılı bir şekilde eklenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}


if ($command == "stadyum-guncelle") {
    $id = $_POST['id'];
    $stadyum_adi = $_POST['stadyum_adi'];
    $il = $_POST['il'];
    $ilce = $_POST['ilce'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "UPDATE stadyumlar SET
        stadyum_adi = '$stadyum_adi',
        il = '$il',
        ilce = '$ilce'
        WHERE id = '$id'
    ");

    if ($query) {
        $text = 'Stadyum güncellendi. ('.$stadyum_adi.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '4')");

        echo "success+Stadyum başarılı bir şekilde güncellenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}

if ($command == "stadyum-sil") {
    $id = $_POST['id'];
    $stadyum_adi = $_POST['stadyum_adi'];

    $query = mysqli_query($conn, "DELETE FROM stadyumlar WHERE id = '$id'");
    if ($query) {
        $text = 'Stadyum silindi. ('.$stadyum_adi.')';
        $date = date('d-m-Y H:i:s', time());
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '3')");

        echo true;
    } else {
        echo "hata";
    }
}




if ($command == "antrenman-ekle") {
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $stadyum = $_POST['stadyum'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "INSERT INTO antrenmanlar (
        tarih,
        saat,
        stadyum,
        kayit_tarihi)
        VALUES (
            '$tarih',
            '$saat',
            '$stadyum',
            '$date'
        )"
    );
    if ($query) {
        $getid = mysqli_query($conn, "SELECT * FROM antrenmanlar");
        while ($r = mysqli_fetch_array($getid)) {
            $id = $r['id'];
        }
        $text = 'Antrenman eklendi. ('.$tarih.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '2')");

        echo "success+Antrenman başarılı bir şekilde eklenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}


if ($command == "antrenman-guncelle") {
    $id = $_POST['id'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $stadyum = $_POST['stadyum'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "UPDATE antrenmanlar SET
        tarih = '$tarih',
        saat = '$saat',
        stadyum = '$stadyum'
        WHERE id = '$id'
    ");
    if ($query) {
        $text = 'Antrenman güncellendi. ('.$tarih.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '4')");

        echo "success+Antrenman başarılı bir şekilde güncellenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}

if ($command == "antrenman-sil") {
    $id = $_POST['id'];
    $tarih = $_POST['tarih'];

    $query = mysqli_query($conn, "DELETE FROM antrenmanlar WHERE id = '$id'");
    if ($query) {
        $text = 'Antrenman silindi. ('.$tarih.')';
        $date = date('d-m-Y H:i:s', time());
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '3')");

        echo true;
    } else {
        echo "hata";
    }
}




if ($command == "toplanti-ekle") {
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $yer = $_POST['yer'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "INSERT INTO toplantilar (
        tarih,
        saat,
        yer,
        kayit_tarihi)
        VALUES (
            '$tarih',
            '$saat',
            '$yer',
            '$date'
        )"
    );
    if ($query) {
        $getid = mysqli_query($conn, "SELECT * FROM toplantilar");
        while ($r = mysqli_fetch_array($getid)) {
            $id = $r['id'];
        }
        $text = 'Toplantı eklendi. ('.$tarih.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '2')");

        echo "success+Toplantı başarılı bir şekilde eklenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}


if ($command == "toplanti-guncelle") {
    $id = $_POST['id'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $yer = $_POST['yer'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "UPDATE toplantilar SET
        tarih = '$tarih',
        saat = '$saat',
        yer = '$yer'
        WHERE id = '$id'
    ");
    if ($query) {
        $text = 'Toplantı güncellendi. ('.$tarih.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '4')");

        echo "success+Toplantı başarılı bir şekilde güncellenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin.";
    }
}

if ($command == "toplanti-sil") {
    $id = $_POST['id'];
    $tarih = $_POST['tarih'];

    $query = mysqli_query($conn, "DELETE FROM toplantilar WHERE id = '$id'");
    if ($query) {
        $text = 'Toplantı silindi. ('.$tarih.')';
        $date = date('d-m-Y H:i:s', time());
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '3')");

        echo true;
    } else {
        echo "hata";
    }
}




if ($command == "takim-ekle") {
    $takim_adi = $_POST['takim_adi'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "INSERT INTO takimlar (
        takim_adi,
        kayit_tarihi)
        VALUES (
            '$takim_adi',
            '$date'
        )"
    );
    if ($query) {
        $getid = mysqli_query($conn, "SELECT * FROM takimlar");
        while ($r = mysqli_fetch_array($getid)) {
            $id = $r['id'];
        }
        $text = 'Takım eklendi. ('.$takim_adi.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '2')");

        echo "success+Takım başarılı bir şekilde eklenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin";
    }
}


if ($command == "takim-guncelle") {
    $id = $_POST['id'];
    $takim_adi = $_POST['takim_adi'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "UPDATE takimlar SET
        takim_adi = '$takim_adi'
        WHERE id = '$id'
    ");
    if ($query) {
        $text = 'Takım güncellendi. ('.$takim_adi.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '4')");

        echo "success+Takım başarılı bir şekilde güncellenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin.";
    }
}

if ($command == "takim-sil") {
    $id = $_POST['id'];
    $takim_adi = $_POST['takim_adi'];

    $query = mysqli_query($conn, "DELETE FROM takimlar WHERE id = '$id'");
    if ($query) {
        $text = 'Takım silindi. ('.$takim_adi.')';
        $date = date('d-m-Y H:i:s', time());
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '3')");

        echo true;
    } else {
        echo "hata";
    }
}




if ($command == "karsilasma-ekle") {
    $takim1 = $_POST['takim1'];
    $takim2 = $_POST['takim2'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $lig = $_POST['lig'];
    $hakem = $_POST['hakem'];
    $yardimci1 = $_POST['yardimci1'];
    $yardimci2 = $_POST['yardimci2'];
    $gozlemci = $_POST['gozlemci'];
    $stadyum = $_POST['stadyum'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "INSERT INTO fikstur (
        takim_1,
        takim_2,
        tarih,
        saat,
        lig,
        hakem,
        yardimci_hakem_1,
        yardimci_hakem_2,
        gozlemci,
        stadyum,
        kayit_tarihi)
        VALUES (
            '$takim1',
            '$takim2',
            '$tarih',
            '$saat',
            '$lig',
            '$hakem',
            '$yardimci1',
            '$yardimci2',
            '$gozlemci',
            '$stadyum',
            '$date'
        )"
    );
    if ($query) {
        $getid = mysqli_query($conn, "SELECT * FROM fikstur");
        while ($r = mysqli_fetch_array($getid)) {
            $id = $r['id'];
        }
        $text = 'Karşılaşma eklendi. ('.$takim1.' - '.$takim2.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '2')");

        echo "success+Karşılaşma başarılı bir şekilde eklenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin".mysqli_error($conn);
    }
}


if ($command == "karsilasma-guncelle") {
    $id = $_POST['id'];
    $takim1 = $_POST['takim1'];
    $takim2 = $_POST['takim2'];
    $tarih = $_POST['tarih'];
    $saat = $_POST['saat'];
    $lig = $_POST['lig'];
    $hakem = $_POST['hakem'];
    $yardimci1 = $_POST['yardimci1'];
    $yardimci2 = $_POST['yardimci2'];
    $gozlemci = $_POST['gozlemci'];
    $stadyum = $_POST['stadyum'];

    $date = date('d-m-Y H:i:s', time());
    
    $query = mysqli_query($conn, "UPDATE fikstur SET
        takim_1 = '$takim1',
        takim_2 = '$takim2',
        tarih = '$tarih',
        saat = '$saat',
        lig = '$lig',
        hakem = '$hakem',
        yardimci_hakem_1 = '$yardimci1',
        yardimci_hakem_2 = '$yardimci2',
        gozlemci = '$gozlemci',
        stadyum = '$stadyum'
        WHERE id = '$id'
    ");
    if ($query) {
        $text = 'Karşılaşma güncellendi. ('.$takim1.' - '.$takim2.')';
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '4')");

        echo "success+Karşılaşma başarılı bir şekilde güncellenmiştir+" . $id;
    } else {
        echo "danger+Bir sorun ile karşılaşıldı. Lütfen tekrar deneyin.";
    }
}

if ($command == "takim-sil") {
    $id = $_POST['id'];
    $takim_adi = $_POST['takim_adi'];

    $query = mysqli_query($conn, "DELETE FROM takimlar WHERE id = '$id'");
    if ($query) {
        $text = 'Takım silindi. ('.$takim_adi.')';
        $date = date('d-m-Y H:i:s', time());
        $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
            VALUES('$text', '$username', '$date', '3')");

        echo true;
    } else {
        echo "hata";
    }
}