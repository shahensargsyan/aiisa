<style>
img{
  width:100%;
  display:block;
}
/* portafolio */
#portfolio li img{
 
}
ul#portfolio{
  float:left;
  list-style:none;
  margin-left:0;
  width:99%;
}
ul#portfolio li{
  font-size:18px;
  float:left;
  margin:10px;
  padding:0px;
  width:25%;
  list-style:none;
  text-align:center;
  background:#FFF;
  color:#5282BE;
  /*box-shadow*/
  -webkit-box-shadow:0 1px 2px #292E31;
  -moz-box-shadow:0 1px 2px #292E31;
  box-shadow:0 1px 2px #292E31;
  z-index:2;
}
#pager li{
	width:auto !important;
	display:inline-block;
	box-shadow:none !important;
	margin:auto !important;
}
#pager a{
	display: inline-block;
  border: 1px solid #E4EBEB;
  padding: 0.3em 0.8em 0 0.8em;
  color: #00afda !important;
  font-family: 'Proxima N W15 Smbd';
  font-style: normal;
  font-size: 0.7em;
  text-transform: uppercase;
  border-radius: 3px;
  margin: 0.5em 0 0 0;
}
ul#portfolio a{
  display:block;
  color:#444444;
  font-size:15px;
  font-style:italic;
  text-decoration:none;
  position:relative;
}
ul#portfolio a:hover{
  text-decoration:underline;
}
ul#portfolio img{
  width:100%;
  display:block;
  position:relative;
  overflow:hidden;
  z-index:1;
  /*border-radius*/
  -webkit-border-radius:0px;
  -moz-border-radius:0px;
  border-radius:0px;
}
ul#portfolio img{
  /*transition*/
  -webkit-transition:top 1s ease, left 1s ease;
  -moz-transition:top 1s ease, left 1s ease;
  -o-transition:top 1s ease, left 1s ease;
  transition:top 1s ease, left 1s ease;
}
.gall_title{
	position:absolute;
	bottom:7px;
	right:0px;
	padding:7px;
	text-shadow: 0px 0px 3px #000;
	background:rgba(59,152,204,0.8);
	z-index:1;
	color:#ffffff;
}
</style>
<ul id="portfolio">
<?php
$conn = mysqli_connect("localhost","aiisa","aiisa129","chathamhouse");


if(isset($_GET['folder'])){
	
	extract($_GET);
	$sql = "SELECT * FROM galleries WHERE folder = '$folder'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<h2>".$row['title']."</h2>";
		}
	}
	
	$gallery_link = "gallery/".$folder;
    // Include the UberGallery class
    include('resources/UberGallery.php');

    // Initialize the UberGallery object
    $gallery = new UberGallery();

    // Initialize the gallery array
    $galleryArray = $gallery->readImageDirectory($gallery_link);

    // Define theme path
    if (!defined('THEMEPATH')) {
        define('THEMEPATH', $gallery->getThemePath());
    }

    // Set path to theme index
    $themeIndex = $gallery->getThemePath(true) . '/index.php';

    // Initialize the theme
    if (file_exists($themeIndex)) {
        include($themeIndex);
    } else {
        die('ERROR: Failed to initialize theme');
    }
}
?>
</ul>
<ul id="portfolio" style="border-top: 5px solid #00afda;">
<h1>Photo Albums</h1>
<?php
$sql = "SELECT * FROM galleries";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo'
		    <li class="cms design portfolio-item" style=" overflow:hidden; text-overflow:ellipsis;">
				<a href="?folder='.$row['folder'].'">
				<img src="../gallery/main_images/'.$row['main_image'].'" class="superbox-img"/>
				<span class="gall_title">
					'.$row['title'].'
				</span>
				</a>
			</li>
		';
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</ul>


