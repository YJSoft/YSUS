<?php
require("include.php");

$title = $str['list'] . ' - ' . $str['servicename'];
?><!doctype HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<?php
	$mode = 'list';
	@include('header.php');
	?>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="site.min.css">
	<script src="jquery.js"></script>
	<script src="bootstrap.min.js"></script>
	<style type="text/css">
		@font-face {
			font-family: 'Open Sans';
			font-style: normal;
			font-weight: 400;
			src: local('Open Sans'), local('OpenSans'), url(./open_sans.woff2) format('woff2');
			unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
		}
		.navbar-brand {
			color: white !important;
		}
		body {
			background-color: #f0f0f0;
		}
		div.main {
			margin-top: 65px;
		}
		.footer {
			background-color: #FFF;
			padding: 10px 15px 10px 15px;
			width: 100%;
			position: relative;
		}
	</style>
</head>
<body>
	<!--[if lte IE 8]><script>alert('<?php echo $str['err_noie']; ?>');</script><![endif]-->
	<?php
	$mode = 'list';
	@include('menu.php');
	?>
	<div class="container main">
		<div class="panel content">
			<div class="list-group"><?php
				$result = getFileList(1);
				while($data = mysql_fetch_row($result)) {
					$metadata = unserialize($data[5]);
                    $download_param = array('linkval'=>$data[1]);
                    $download_url = getUrl('download.php',$download_param);

					if ($metadata['filename'] === '') $metadata['filename'] = $str['hiddenfilename'] . ' (' . human_filesize($metadata['filesize']) . ', ' . str_replace('%d', date($str['dateformat'], strtotime($data[7])), $str['until']) . ')';
					else $metadata['filename'] .= ' (' . human_filesize($metadata['filesize']) . ', ' . str_replace('%d', date($str['dateformat'], strtotime($data[7])), $str['until']) . ')';
					echo '				<a href="' . $str['link'] . $download_url . '" class="list-group-item" hreflang="' . $_SESSION['lang'] . '">
					<h4 class="list-group-item-heading">' . htmlspecialchars($metadata['filename']) . '</h4>
					<p class="list-group-item-text">' . $str['link'] . $download_url . '</p>
				</a>
';
}?>			</div>
		</div>
	</div>
	<?php @include('footer.php'); ?>
</body>
</html>