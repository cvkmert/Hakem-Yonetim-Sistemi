<?php
	include "connect.php";
	session_start();
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	if (!empty($username) or !empty($password)) {
		$getuser = mysqli_query($conn, "SELECT * FROM admin WHERE admin_username = '$username'");
		if (mysqli_num_rows($getuser) > 0) {
			while ($rowuser = mysqli_fetch_array($getuser)) {
				if ($username != $rowuser['admin_username'] or $password != $rowuser['admin_password']) {
					header('location: giris');
				}
				else {
					$admin_id = $rowuser['admin_id'];
					$admin_phone = $rowuser['admin_phone'];
					$admin_email = $rowuser['admin_email'];
					$admin_image = $rowuser['admin_image'];
					$admin = $rowuser['admin_admin'];
					$def_image = "/hys/assets/media/users/default.jpg";
				}
			}
		} else {
			header('location: giris');
		}
	} else {
		header('location: giris');
	}
	include 'function.php';
	date_default_timezone_set('Europe/Istanbul');
	$getsiteinformations = mysqli_query($conn, "SELECT * FROM siteinformation");
	while ($rowsiteinformations = mysqli_fetch_array($getsiteinformations)) {
		$site_name = $rowsiteinformations['site_name'];
		$site_description = $rowsiteinformations['site_description'];
		$site_keywords = $rowsiteinformations['site_keywords'];
		$site_logo = $rowsiteinformations['site_logo'];
		$site_favicon = $rowsiteinformations['site_logo_en'];
		$site_domain = $rowsiteinformations['site_domain'];
		$domain = "/";
	}
?>
<!DOCTYPE html>

<html lang="tr">

	<!--begin::Head-->
	<head>
		<base href="<?php echo $domain.'hys/';?>">
		<meta charset="utf-8" />
		<title><?php echo $site_name; ?> | Yönetici Paneli</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="<?php echo $domain;?>" />

		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

		<!--end::Fonts-->

		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="<?php echo $domain.'hys/';?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Page Vendors Styles-->

		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="<?php echo $domain.'hys/';?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $domain.'hys/';?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $domain.'hys/';?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $domain.'hys/';?>assets/css/style.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles-->

		<!--begin::Layout Themes(used by all pages)-->
		<link href="<?php echo $domain.'hys/';?>assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $domain.'hys/';?>assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $domain.'hys/';?>assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $domain.'hys/';?>assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />

		<!--end::Layout Themes-->
    	<link href="<?php echo $site_favicon; ?>" rel="shortcut icon">
    	<link href="<?php echo $domain;?>hys/assets/css/font-awesome.css" rel="stylesheet">
    	<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
		<script src="<?php echo $domain.'hys/';?>ckeditor/ckeditor.js"></script>
		<link rel="apple-touch-icon" sizes="57x57" href="../img/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="../img/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="../img/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="../img/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="../img/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="../img/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="../img/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="../img/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="../img/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="../img/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="../img/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
		<link rel="manifest" href="../img/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="../img/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">


		<style>
			.popup {
				position: fixed;
				display: none;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				max-width: 100vw;
				max-height: 100vh;
				min-width: 100vw;
				min-height: 100vh;
				z-index: 99;
				}

				.popup .bg {
				position: fixed;
				display: none;
				flex-direction: row;
				align-items: center;
				justify-content: center;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				max-width: 100vw;
				max-height: 100vh;
				min-width: 100vw;
				min-height: 100vh;
				background-color: #00000090;
				z-index: 999999;
				overflow: hidden;
				}

				.popup .close {
				width: 30px;
				height: 30px;
				position: absolute;
				display: flex;
				color: #00000060;
				flex-direction: row;
				align-items: center;
				justify-content: center;
				top: 10px;
				right: 13px;
				z-index: 7;
				font-size: 30px;
				cursor: pointer;
				}

				.popup .close:hover {
				color: #000000cc;
				}
			@media (min-width: 1000px) {
				.popup .alert {
					position: relative;
					display: none;
					flex-direction: column;
					align-items: center;
					justify-content: space-evenly;
					background-color: #fff;
					width: fit-content;
					margin: 10vw;
					padding: 30px;
					border-radius: 20px;
					color: #00000090;
					line-height: 20px;
					font-size: 16px;
					z-index: 9999999;
				}

				.popup .alert h1 {
					font-size: 20px;
					text-align: center;
				}

				.popup .alert h2 {
					margin-top: 15px;
					font-size: 16px;
					text-align: center;
				}

				.popup .danger,
				.popup .success {
					height: 80px;
					display: none;
				}
			}
			@media (max-width: 999px) {
				.popup .alert {
					position: relative;
					display: none;
					flex-direction: column;
					align-items: center;
					justify-content: space-evenly;
					background-color: #fff;
					width: calc(90vw - 60px);
					padding: 30px;
					border-radius: 20px;
					color: #00000090;
					line-height: 20px;
					font-size: 16px;
					z-index: 9999999;
				}

				.popup .alert h1 {
					font-size: 18px;
					text-align: center;
				}

				.popup .alert h2 {
					margin-top: 15px;
					font-size: 16px;
					text-align: center;
				}

				.popup .danger,
				.popup .success {
					height: 70px;
					display: none;
				}
			}
			.i {
				height: 40px;
				width: 40px;
				display: flex;
				flex-direction: row;
				justify-content: center;
				align-items: center;
				background-color: #3F4254;
				border-radius: 5px;
			}
			i {
				color: #fff;
			}
		</style>
	</head>

	<!--end::Head-->

	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

	<div class="popup" style="z-index:999999">
			<div class="bg" id="bg">
			</div>
			<div class="alert" style="min-width: 400px">
				<div class="close">×</div>
				<img src="../img/danger.svg" class="danger">
				<img src="../img/success.svg" class="success">
				<h1 id="alert-title"></h1>
				<h2 id="alert-message" style="line-height: 25px;"></h2>
			</div>
		</div>
		<script>
			$(".close").click(function() {
				document.getElementById("alert-title").innerHTML = "";
				document.getElementById("alert-message").innerHTML = "";
				$('.bg').css("display", "none");
				$('.popup').css("display", "none");
				$('.alert').css("display", "none");
			});
		</script>
		<?php include("layout.php"); ?>

		<?php include("partials/_extras/offcanvas/quick-user.php"); ?>

		<?php include("partials/_extras/offcanvas/quick-panel.php"); ?>

		<?php include("partials/_extras/scrolltop.php"); ?>

		<!--begin::Global Config(global config for global JS scripts)-->
		<script>
			var KTAppSettings = {
				"breakpoints": {
					"sm": 576,
					"md": 768,
					"lg": 992,
					"xl": 1200,
					"xxl": 1400
				},
				"colors": {
					"theme": {
						"base": {
							"white": "#ffffff",
							"primary": "#3699FF",
							"secondary": "#E5EAEE",
							"success": "#1BC5BD",
							"info": "#8950FC",
							"warning": "#FFA800",
							"danger": "#F64E60",
							"light": "#E4E6EF",
							"dark": "#181C32"
						},
						"light": {
							"white": "#ffffff",
							"primary": "#E1F0FF",
							"secondary": "#EBEDF3",
							"success": "#C9F7F5",
							"info": "#EEE5FF",
							"warning": "#FFF4DE",
							"danger": "#FFE2E5",
							"light": "#F3F6F9",
							"dark": "#D6D6E0"
						},
						"inverse": {
							"white": "#ffffff",
							"primary": "#ffffff",
							"secondary": "#3F4254",
							"success": "#ffffff",
							"info": "#ffffff",
							"warning": "#ffffff",
							"danger": "#ffffff",
							"light": "#464E5F",
							"dark": "#ffffff"
						}
					},
					"gray": {
						"gray-100": "#F3F6F9",
						"gray-200": "#EBEDF3",
						"gray-300": "#E4E6EF",
						"gray-400": "#D1D3E0",
						"gray-500": "#B5B5C3",
						"gray-600": "#7E8299",
						"gray-700": "#5E6278",
						"gray-800": "#3F4254",
						"gray-900": "#181C32"
					}
				},
				"font-family": "Poppins"
			};
		</script>

		<!--end::Global Config-->

		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?php echo $domain.'hys/';?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo $domain.'hys/';?>assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="<?php echo $domain.'hys/';?>assets/js/scripts.bundle.js"></script>

		<!--end::Global Theme Bundle-->

		<!--begin::Page Vendors(used by this page)-->
		<script src="<?php echo $domain.'hys/';?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>

		<!--end::Page Vendors-->

		<!--begin::Page Scripts(used by this page)-->
		<script src="<?php echo $domain.'hys/';?>assets/js/pages/widgets.js"></script>

		<!--end::Page Scripts-->		
		
<div class="message-container" id="message-container">
		</div>
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
<script>
	function urlc(textString) {
		textString = textString.replace(/ /g, "-");
		textString = textString.replace(/</g, "");
		textString = textString.replace(/>/g, "");
		textString = textString.replace(/"/g, "");
		textString = textString.replace(/é/g, "");
		textString = textString.replace(/!/g, "");
		textString = textString.replace(/’/, "");
		textString = textString.replace(/£/, "");
		textString = textString.replace(/^/, "");
		textString = textString.replace(/#/, "");
		textString = textString.replace(/$/, "");
		textString = textString.replace(/\+/g, "");
		textString = textString.replace(/%/g, "");
		textString = textString.replace(/½/g, "");
		textString = textString.replace(/&/g, "");
		textString = textString.replace(/\//g, "");
		textString = textString.replace(/{/g, "");
		textString = textString.replace(/\(/g, "");
		textString = textString.replace(/\[/g, "");
		textString = textString.replace(/\)/g, "");
		textString = textString.replace(/]/g, "");
		textString = textString.replace(/=/g, "");
		textString = textString.replace(/}/g, "");
		textString = textString.replace(/\?/g, "");
		textString = textString.replace(/\*/g, "");
		textString = textString.replace(/@/g, "");
		textString = textString.replace(/€/g, "");
		textString = textString.replace(/~/g, "");
		textString = textString.replace(/æ/g, "");
		textString = textString.replace(/ß/g, "");
		textString = textString.replace(/;/g, "");
		textString = textString.replace(/,/g, "");
		textString = textString.replace(/`/g, "");
		textString = textString.replace(/|/g, "");
		textString = textString.replace(/\./g, "");
		textString = textString.replace(/:/g, "");
		textString = textString.replace(/İ/g, "i");
		textString = textString.replace(/I/g, "i");
		textString = textString.replace(/ı/g, "i");
		textString = textString.replace(/ğ/g, "g");
		textString = textString.replace(/Ğ/g, "g");
		textString = textString.replace(/ü/g, "u");
		textString = textString.replace(/Ü/g, "u");
		textString = textString.replace(/ş/g, "s");
		textString = textString.replace(/Ş/g, "s");
		textString = textString.replace(/ö/g, "o");
		textString = textString.replace(/Ö/g, "o");
		textString = textString.replace(/ç/g, "c");
		textString = textString.replace(/Ç/g, "c");
		textString = textString.replace(/–/g, "-");
		textString = textString.replace(/—/g, "-");
		textString = textString.replace(/—-/g, "-");
		textString = textString.replace(/—-/g, "-");

		return textString.toLowerCase();
	}
</script>

	</body>

	<!--end::Body-->
</html>