<?php
// This file contains the layout for the Moodle frontpage.

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$knownregionpre = $PAGE->blocks->is_known_region('side-pre');
$knownregionpost = $PAGE->blocks->is_known_region('side-post');

$regions = bootstrap_grid($hassidepre, $hassidepost);
$PAGE->set_popup_notification_allowed(false);
if ($knownregionpre || $knownregionpost) {
	theme_bootstrap_initialise_zoom($PAGE);
}
$setzoom = theme_bootstrap_get_zoom();

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
	<head>
		<title><?php echo $OUTPUT->page_title(); ?></title>
		<link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
		<?php echo $OUTPUT->standard_head_html(); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui">
	</head>

	<body <?php echo $OUTPUT->body_attributes($setzoom); ?>>
		<?php echo $OUTPUT->standard_top_of_body_html() ?>

		<nav role="navigation" class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo $CFG->wwwroot;?>"><?php echo $SITE->shortname; ?></a>
				</div>
				<div id="moodle-navbar" class="navbar-collapse collapse">
					<?php echo $OUTPUT->user_menu(); ?>
				</div>
			</div>
		</nav>
		
		<header class="moodleheader">
			<div class="container-fluid">
				<?php echo $OUTPUT->page_heading(); ?>
			</div>
		</header>

		<div id="page" class="container-fluid">
			<div id="page-content" class="row">
				<div id="region-main" class="<?php echo $regions['content']; ?>">
					<?php echo $OUTPUT->main_content(); ?>
				</div>

				<?php
				if ($knownregionpre) {
						echo $OUTPUT->blocks('side-pre', $regions['pre']);
				}?>
				<?php
				if ($knownregionpost) {
						echo $OUTPUT->blocks('side-post', $regions['post']);
				}?>
			</div>

			<footer id="page-footer">
				<?php
				echo $OUTPUT->login_info();
				echo $OUTPUT->home_link();
				?>
			</footer>
		</div>
	</body>
</html>
