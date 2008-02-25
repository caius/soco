<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" version="-//W3C//DTD XHTML 1.1//EN" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="generator" content="Soco" /> <!-- leave this for stats -->

	<title><?php $this->Title() ?></title>

	<link rel="stylesheet" href="<?php $this->Base_plus_dir("css/"); ?>core.css" type="text/css" media="screen" title="Main Stylesheet" charset="utf-8" />
	
	<script src="<?php $this->Base_plus_dir("javascript/") ?>select_text.js" type="text/javascript" charset="utf-8"></script>

</head>
<body>

	<!-- I hate using non-breaking spaces for background positioning -->
	<span id="background">&nbsp;</span>

	<div id="header">
		<?php $this->Header() ?>
	</div><!-- end #header -->

	<div id="page">
		<div id="content">
			<?php $this->Content() ?>
		</div><!-- end #content -->

		<div id="sidebar">
			<?php $this->Sidebar() ?>
		</div><!-- end #sidebar -->

		<div id="footer">
			<?php $this->Footer() ?>
		</div><!-- end #footer -->
	</div><!-- end #page -->


</body>
</html>
