<div id="kt_header" class="header header-fixed">

	<div class="container-fluid d-flex align-items-stretch justify-content-between">

		<div class="topbar">
		</div>


		<div class="topbar">

			<div class="topbar-item">
				<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
					<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Merhaba,</span>
					<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?php echo strtoupper($username); ?></span>
					<span>
						<?php 
							if ($admin_image != "") {
								echo '<img src="'.$domain.'/'.$admin_image.'" style="height: 35px; width: 35px; object-fit: cover; object-position: top;">';
							}
							else {
								echo '<img src="'.$def_image.'" style="height: 35px; width: 35px; object-fit: cover; object-position: top;">';
							}
						?>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>