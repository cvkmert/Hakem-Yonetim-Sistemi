<?php
include "connect.php";
session_start();
if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
if (!empty($_SESSION['password'])) {
    $password = $_SESSION['password'];
}
if (!empty($username) or !empty($password)) {
    $getuser = mysqli_query($conn, "SELECT * FROM admin WHERE admin_username = '$username'");
    if (mysqli_num_rows($getuser) > 0) {
        while ($rowuser = mysqli_fetch_array($getuser)) {
            if ($username == $rowuser['admin_username'] and $password == $rowuser['admin_password']) {
                $date = date('d-m-Y H:i:s', time());
                $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
                VALUES('Panele giriş Yapıldı.', '$username', '$date', '6')");
                echo "<script>window.location.href='/hys/';</script>";
            }
        }
    }
}
include 'function.php';
date_default_timezone_set('Europe/Istanbul');

if (isset($_POST['login-button'])) {
    if (!empty($_POST['username']) and !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5(sha1(crc32($password)));
        $getuser = mysqli_query($conn, "SELECT * FROM admin WHERE admin_username = '$username'");
        if (mysqli_num_rows($getuser) > 0) {
            while ($rowuser = mysqli_fetch_array($getuser)) {
                if ($username == $rowuser['admin_username'] and $password == $rowuser['admin_password']) {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $date = date('d-m-Y H:i:s', time());
                    $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
                     VALUES('Panele giriş Yapıldı.', '$username', '$date', '6')");
                    echo "<script>window.location.href='/hys/';</script>";
                } else {
                    echo '
                         <script>
                             $(document).ready(function() {
                                 document.getElementsByClassName("alert-text2")[0].innerHTML = "Girdiğiniz şifre yanlış!";
                                 $(".failed").removeClass("disabled-message");
                             });
                         </script>';
                    $date = date('d-m-Y H:i:s', time());
                    $addactivity = mysqli_query($conn, "INSERT INTO activities(activity_name, activity_user, activity_created, activity)
                         VALUES('Hatalı giriş yapıldı!', '$username', '$date', '3')");
                }
            }
        } else {
            echo '
                 <script>
                     $(document).ready(function() {
                         document.getElementsByClassName("alert-text2")[0].innerHTML = "Böyle bir kullanıcı bulunamadı!";
                         $(".failed").removeClass("disabled-message");
                     });
                 </script>';
        }
    } else {
        echo '
             <script>
                 $(document).ready(function() {
                     document.getElementsByClassName("alert-text3")[0].innerHTML = "Gerekli alanları doldurun!";
                     $(".warning").removeClass("disabled-message");
                 });
             </script>';
    }
}
$getsiteinformations = mysqli_query($conn, "SELECT * FROM siteinformation");
while ($rowsiteinformations = mysqli_fetch_array($getsiteinformations)) {
    $site_name = $rowsiteinformations['site_name'];
    $site_description = $rowsiteinformations['site_description'];
    $site_keywords = $rowsiteinformations['site_keywords'];
    $site_logo = $rowsiteinformations['site_logo'];
    $site_favicon = $rowsiteinformations['site_logo_en'];
    $domain = "/";
}
?>
<!DOCTYPE html>

<html lang="tr">

<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <title><?php echo $site_name; ?> | Yönetici Paneli</title>
    <!-- End Google Tag Manager -->
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="<?php echo $domain; ?>" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="<?php echo $domain . 'hys/'; ?>assets/css/pages/login/classic/login-5.css?v=7.2.8" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?php echo $domain . 'hys/'; ?>assets/plugins/global/plugins.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
    <link href="<?php echo $domain . 'hys/'; ?>assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
    <link href="<?php echo $domain . 'hys/'; ?>assets/css/style.bundle.css?v=7.2.8" rel="stylesheet" type="text/css" />
    <link href="<?php echo $domain . 'hys/'; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?php echo $domain . 'hys/'; ?>assets/css/themes/layout/header/base/light.css?v=7.2.8" rel="stylesheet" type="text/css" />
    <link href="<?php echo $domain . 'hys/'; ?>assets/css/themes/layout/header/menu/light.css?v=7.2.8" rel="stylesheet" type="text/css" />
    <link href="<?php echo $domain . 'hys/'; ?>assets/css/themes/layout/brand/dark.css?v=7.2.8" rel="stylesheet" type="text/css" />
    <link href="<?php echo $domain . 'hys/'; ?>assets/css/themes/layout/aside/dark.css?v=7.2.8" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="<?php echo $site_favicon; ?>" />
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <!-- Hotjar Tracking Code for keenthemes.com -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 1070954,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!-- Google Tag Manager (noscript) -->

    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(assets/media/bg/bg-2.jpg);">
                <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <img src="../img/logo.svg" class="max-h-75px" alt="" />
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <form class="form" method="POST" id="kt_login_signin_form" action="login.php">
                            <div class="form-group">
                                <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" id="username" type="text" placeholder="Kullanıcı Adı" name="username" />
                                <span class="valid-message1 disabled-message" style="color:red;">Kullanıcı adı gerekli!</span>
                            </div>
                            <div class="form-group">
                                <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" id="password" type="password" placeholder="Şifre" name="password" />
                                <span class="valid-message2 disabled-message" style="color:red;">Şifre gerekli!</span>
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                </div>
                            </div>
                            <div class="form-group text-center mt-10">
                                <input type="submit" id="kt_login_signin_submit" name="login-button" class="btn btn-pill btn-primary opacity-90 px-15 py-3" value="Giriş Yap">
                            </div>
                        </form>
                    </div>
                    <!--end::Login Sign in form-->
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
    <script src="<?php echo $domain . 'hys/'; ?>assets/plugins/global/plugins.bundle.js?v=7.2.8"></script>
    <script src="<?php echo $domain . 'hys/'; ?>assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.2.8"></script>
    <script src="<?php echo $domain . 'hys/'; ?>assets/js/scripts.bundle.js?v=7.2.8"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="<?php echo $domain . 'hys/'; ?>assets/js/pages/custom/login/login-general.js?v=7.2.8"></script>
    <!--end::Page Scripts-->
    <div class="message-container">
        <div class="message success disabled-message">
            <div class="alert alert-custom alert-success fade show" role="alert">
                <div class="alert-icon">
                    <i class="far fa-check-circle"></i>
                </div>
                <div class="alert-text1">
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="message failed disabled-message">
            <div class="alert alert-custom alert-danger fade show" role="alert">
                <div class="alert-icon">
                    <i class="flaticon-warning"></i>
                </div>
                <div class="alert-text2">
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="message warning disabled-message">
            <div class="alert alert-custom alert-warning fade show" role="alert">
                <div class="alert-icon">
                    <i class="flaticon-warning"></i>
                </div>
                <div class="alert-text3">
                </div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
<!--end::Body-->

</html>