				<p align="center"><font face="Arial" size="1" color="#538608">Copyright * 2022 *<a href="http://127.0.0.1/ldtcsgmtfleet2020/"><img src="images/favicon.png" width="16" height="16" border="0"  /> LDTCS GMT Fleet Maintenance</font><br><img src="images/logo_small.png" width="204" height="64" border="0"  /></a>
			<!-- Add footer template above here -->
			<div class="clearfix"></div>
			<?php if(!Request::val('Embedded')) { ?>
				<div style="height: 70px;" class="hidden-print"></div>
			<?php } ?>

		</div> <!-- /div class="container" -->
		<?php if(!defined('APPGINI_SETUP') && is_file(__DIR__ . '/hooks/footer-extras.php')) { include(__DIR__ . '/hooks/footer-extras.php'); } ?>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/lightbox.min.js"></script>
	</body>
</html>