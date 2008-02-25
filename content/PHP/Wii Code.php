<h2>Wii Code</h2>

<p>This php-script/web-page shows your wii number, and allows other people to enter their wii number for you to add them in return.  It is error checked, so you won't get any spam through it, and it emails their wii number straight to your inbox for you to add to your wii manually.  <em>Annoyingly you can't automate the adding to your wii :-(</em></p>

<?php

$source = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>My Wii number</title>

	<link rel="stylesheet" type="text/css" href="style_wii.css" media="screen">
	
</head>
<body>
	<div id="my_num">
		<p>My <a href="http://wii.com/" title="Nintendo Wii">Wii</a> number is</p>
		<p id="number">6328 3044 1710 7780</p>
	</div>
	
	<hr />
	
	<div id="your_num">
	<?php
	
	if ($_POST) {
		# form was submitted
		$num = $_POST[\'your_number\'];
		
		if (preg_match("/^\s*\d{16}\s*$/", $num) || 
preg_match("/^\s*\d{4}\s+\d{4}\s+\d{4}\s+\d{4}\s*$/", $num)) {
			# code matches
			
			# email myself
			$email = array(
				\'to\' => "wii@caius.name",
				"subject" => "Wii code to be added",
				"message" => "Someone added you to their wii, please add them back.\n{$num}"
				);
			
			mail($email["to"], $email["subject"], $email["message"]);
			
			echo "Code entry successful, I\'ll add you on my wii!";
		} else {
			echo "Code entry error. Are you sure that was a wii code?!";
		}
		
		
	} else {
		# Form wasn\'t submitted
		?>
		
			<form action="<?php echo $_SERVER[\'PHP_SELF\'] ?>" method="post" accept-charset="utf-8">
				<label for="your_number">Your Wii\'s number:</label>
				<br />
				<input type="text" name="your_number" value="xxxx xxxx xxxx xxxx" id="your_num" 
/>

				<p><input type="submit" value="Continue &rarr;"></p>
			</form>
		<?php
	}
	
	?>
	</div>
	
</body>
</html>';
$lang = "html4strict";
$cap = "wii.php";
$this->geshi->Render($source, $lang, $cap);
?>

<p>Copy/Paste to wii.php, edit your wii number &amp; email address and you're good to go!</p>