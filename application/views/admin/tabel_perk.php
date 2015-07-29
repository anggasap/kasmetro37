<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
foreach($output->css_files as $css_files)
{
	?>
	<link type="text/css" rel="stylesheet" href="<?php echo $css_files; ?>" />

	<?php
}?>
<?php
foreach($output->js_files as $js_files)
{
	?>

	<script src="<?php echo $js_files; ?>">
	</script>
	<?php
}?>

<div id="main-content">
	<div class='title'>
		Daftar Perkiraan
	</div>
	<div class="">
		<?php echo $output->output; ?>
	</div>
</div>

