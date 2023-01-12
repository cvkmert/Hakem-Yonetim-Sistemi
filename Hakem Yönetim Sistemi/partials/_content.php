<?php
	date_default_timezone_set('Europe/Istanbul');
	$date = date('d-m-Y', time());
	$query = mysqli_query($conn, "SELECT * FROM hakemler");
	$hakem = mysqli_num_rows($query);
	$query = mysqli_query($conn, "SELECT * FROM gozlemciler");
	$gozlemci = mysqli_num_rows($query);
	$query = mysqli_query($conn, "SELECT * FROM takimlar");
	$takim = mysqli_num_rows($query);
	$query = mysqli_query($conn, "SELECT * FROM stadyumlar");
	$stadyum = mysqli_num_rows($query);
	$query = mysqli_query($conn, "SELECT * FROM fikstur");
	$karsilasma = mysqli_num_rows($query);
	$query = mysqli_query($conn, "SELECT * FROM egitimler");
	$egitim = mysqli_num_rows($query);
	$query = mysqli_query($conn, "SELECT * FROM antrenmanlar");
	$antrenman = mysqli_num_rows($query);
	$query = mysqli_query($conn, "SELECT * FROM toplantilar");
	$toplanti = mysqli_num_rows($query);
?>
<div class="d-flex flex-column-fluid">
	<div class="container" style="margin-top: -50px;">
		<div class="row">
			<div class="col-xl-3">
				<a href="hakemler">
					<div class="card card-custom bgi-no-repeat bg-success card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url(/metronic/theme/html/demo1/dist/assets/media/svg/shapes/abstract-1.svg)">
						<div class="card-body">
							<span class="svg-icon svg-icon-2x svg-icon-white">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24"/>
										<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
										<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
									</g>
								</svg>
							</span>
							<span class="card-title font-weight-bolder text-white font-size-h1 mb-0 mt-6 d-block"><?php echo $hakem; ?></span>
							<span class="text-white font-size-h5">Hakem Sayısı</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-3">
				<a href="gozlemciler">
					<div class="card card-custom bg-info card-stretch gutter-b">
						<div class="card-body">
							<span class="svg-icon svg-icon-2x svg-icon-white">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"/>
										<path d="M12.8434797,16 L11.1565203,16 L10.9852159,16.6393167 C10.3352654,19.064965 7.84199997,20.5044524 5.41635172,19.8545019 C2.99070348,19.2045514 1.55121603,16.711286 2.20116652,14.2856378 L3.92086709,7.86762789 C4.57081758,5.44197964 7.06408298,4.00249219 9.48973122,4.65244268 C10.5421727,4.93444352 11.4089671,5.56345262 12,6.38338695 C12.5910329,5.56345262 13.4578273,4.93444352 14.5102688,4.65244268 C16.935917,4.00249219 19.4291824,5.44197964 20.0791329,7.86762789 L21.7988335,14.2856378 C22.448784,16.711286 21.0092965,19.2045514 18.5836483,19.8545019 C16.158,20.5044524 13.6647346,19.064965 13.0147841,16.6393167 L12.8434797,16 Z M17.4563502,18.1051865 C18.9630797,18.1051865 20.1845253,16.8377967 20.1845253,15.2743923 C20.1845253,13.7109878 18.9630797,12.4435981 17.4563502,12.4435981 C15.9496207,12.4435981 14.7281751,13.7109878 14.7281751,15.2743923 C14.7281751,16.8377967 15.9496207,18.1051865 17.4563502,18.1051865 Z M6.54364977,18.1051865 C8.05037928,18.1051865 9.27182488,16.8377967 9.27182488,15.2743923 C9.27182488,13.7109878 8.05037928,12.4435981 6.54364977,12.4435981 C5.03692026,12.4435981 3.81547465,13.7109878 3.81547465,15.2743923 C3.81547465,16.8377967 5.03692026,18.1051865 6.54364977,18.1051865 Z" fill="#000000"/>
									</g>
								</svg>
							</span>
							<span class="card-title font-weight-bolder text-white font-size-h1 mb-0 mt-6 d-block"><?php echo $gozlemci; ?></span>
							<span class="text-white font-size-h5">Gözlemci Sayısı</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-3">
				<a href="takimlar">
					<div class="card card-custom bg-danger card-stretch gutter-b">
						<div class="card-body">
							<span class="svg-icon svg-icon-2x svg-icon-white">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24"/>
										<rect fill="#000000" opacity="0.3" x="2" y="3" width="7" height="14" rx="1"/>
										<path d="M16.6236387,13.0538007 C18.8273383,13.8579339 20.1826034,13.7956508 21,14 C21.5844894,14.1461224 22.1049236,14.4525789 22.5613025,14.9193695 C22.8220479,15.1860635 23.0030223,15.5203564 23.0837834,15.8844876 C23.3229559,16.9628548 22.6426541,18.0309317 21.5642858,18.2700997 C20.2740329,18.5562665 18.7433451,18.7531138 16.9722222,18.8606416 C13.9910551,19.0416332 8.86226533,19.0463278 1.5858528,18.8747253 C1.26005876,18.867042 0.999953435,18.6007302 0.999953435,18.2748455 L1,18.2748455 C1,15.4124758 1,13.3451074 1,12.0727406 C5.24980707,11.6622656 8.09783699,10.5071287 9.54408978,8.60732991 C9.56481367,8.58010699 9.58782802,8.55470651 9.6128812,8.53140618 C9.85553488,8.30572983 10.2351914,8.31949268 10.4608598,8.56215378 C10.8762386,9.00878105 11.2674202,9.41538104 11.6344046,9.78195376 C11.6101853,9.81416566 11.5876475,9.84819014 11.5669873,9.8839746 L10.0669873,12.4820508 C9.79084492,12.9603434 9.95472008,13.5719338 10.4330127,13.8480762 C10.9113053,14.1242186 11.5228957,13.9603434 11.7990381,13.4820508 L13.1335582,11.1705941 C13.630492,11.5858319 14.0581948,11.8865474 14.4166667,12.0727406 C14.5381042,12.1358162 14.6576898,12.1965218 14.7754507,12.2549561 L14.0669873,13.4820508 C13.7908449,13.9603434 13.9547201,14.5719338 14.4330127,14.8480762 C14.9113053,15.1242186 15.5228957,14.9603434 15.7990381,14.4820508 L16.6236387,13.0538007 Z" fill="#000000"/>
									</g>
								</svg>
							</span>
							<span class="card-title font-weight-bolder text-white font-size-h1 mb-0 mt-6 d-block"><?php echo $takim; ?></span>
							<span class="text-white font-size-h5">Takım Sayısı</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-3">
				<a href="stadyumlar">
					<div class="card card-custom bg-primary card-stretch gutter-b">
						<div class="card-body">
							<span class="svg-icon svg-icon-2x svg-icon-white">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"/>
										<path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>
									</g>
								</svg>
							</span>
							<span class="card-title font-weight-bolder text-white font-size-h1 mb-0 mt-6 d-block"><?php echo $stadyum; ?></span>
							<span class="text-white font-size-h5">Stadyum Sayısı</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-3">
				<a href="stadyumlar">
					<div class="card card-custom bg-warning card-stretch gutter-b">
						<div class="card-body">
							<span class="svg-icon svg-icon-2x svg-icon-white">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"/>
										<path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000"/>
										<path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3"/>
									</g>
								</svg>
							</span>
							<span class="card-title font-weight-bolder text-white font-size-h1 mb-0 mt-6 d-block"><?php echo $karsilasma; ?></span>
							<span class="text-white font-size-h5">Karşılaşma Sayısı</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-3">
				<a href="egitimler">
					<div class="card card-custom bg-dark card-stretch gutter-b">
						<div class="card-body">
							<span class="svg-icon svg-icon-2x svg-icon-white">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24"/>
										<path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#000000"/>
									</g>
								</svg>
							</span>
							<span class="card-title font-weight-bolder text-white font-size-h1 mb-0 mt-6 d-block"><?php echo $egitim; ?></span>
							<span class="text-white font-size-h5">Eğitimler</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-3">
				<a href="antrenmanlar">
					<div class="card card-custom bg-info card-stretch gutter-b">
						<div class="card-body">
							<span class="svg-icon svg-icon-2x svg-icon-white">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"/>
										<path d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z" fill="#000000"/>
										<path d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z" fill="#000000" opacity="0.3"/>
									</g>
								</svg>
							</span>
							<span class="card-title font-weight-bolder text-white font-size-h1 mb-0 mt-6 d-block"><?php echo $antrenman; ?></span>
							<span class="text-white font-size-h5">Antrenmanlar</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xl-3">
				<a href="toplantilar">
					<div class="card card-custom bg-success card-stretch gutter-b">
						<div class="card-body">
							<span class="svg-icon svg-icon-2x svg-icon-white">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"/>
										<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
										<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
										<rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
										<rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
									</g>
								</svg>
							</span>
							<span class="card-title font-weight-bolder text-white font-size-h1 mb-0 mt-6 d-block"><?php echo $toplanti; ?></span>
							<span class="text-white font-size-h5">Toplantılar</span>
						</div>
					</div>
				</a>
			</div>
		</div>
		

		<div class="row">
			<div class="col-xl-12">
				<div class="card card-custom card-stretch gutter-b">
					<div class="card-header align-items-center border-0 mt-4">
						<h3 class="card-title align-items-start flex-column">
							<span class="font-weight-bolder text-dark">Son İşlemler</span>
							<?php
							$count = mysqli_query($conn, "SELECT count(*) as top FROM activities");
							$data = mysqli_fetch_assoc($count);
							echo '<span class="text-muted mt-3 font-weight-bold font-size-sm">Toplam: ' . $data["top"] . ' işlem</span>';
							?>
						</h3>
					</div>
					<div class="card-body" style="padding-top: 0 !important;">
						<?php
						$iterator = 0;
						$getactivities = mysqli_query($conn, "SELECT * FROM activities ORDER BY activity_created DESC LIMIT 5");
						$current_date = date("d-m-Y");
						while ($rowactivities = mysqli_fetch_array($getactivities)) {
							if ($iterator <= 10) {
								$activity_name = $rowactivities['activity_name'];
								$activity_username = $rowactivities['activity_user'];
								$activity_created = explode(" ", $rowactivities['activity_created']);
								$activity_date = $activity_created[0];
								$activity_time = explode(":", $activity_created[1]);
								$activity_type = $rowactivities['activity'];
								if ($activity_type == 1) {
									$color = "text-success";
								} else if ($activity_type == 2) {
									$color = "text-warning";
								} else if ($activity_type == 3) {
									$color = "text-danger";
								} else if ($activity_type == 4) {
									$color = "text-info";
								} else if ($activity_type == 5) {
									$color = "text-dark";
								} else if ($activity_type == 6) {
									$color = "text-primary";
								}
								if ($activity_date != $current_date) {
									echo '<h5 class="activity-title">' . $activity_date . '</h5>';
								}
								echo '
															<div class="timeline timeline-6 mt-3">
																<div class="timeline-item align-items-start">
																	<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">' . $activity_time[0] . ':' . $activity_time[1] . '</div>
																	<div class="timeline-badge">
																		<i class="fa fa-genderless ' . $color . ' icon-xl"></i>
																	</div>
																	<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">' . $activity_name . '</div>
																	<div class="timeline-user font-weight-bolder text-dark-75 font-size-lg">' . $activity_username . '</div>
																</div>
															</div>
															';
								$current_date = $activity_date;
							}
							$iterator += 1;
						}
						?>
						<br>
						<div style="text-align: center;">
							<a href="tum-aktiviteler" class="btn btn-light btn-text-primary btn-hover-text-primary font-weight-bold" style="text-align: center;">Tümünü Gör</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		


	</div>
</div>