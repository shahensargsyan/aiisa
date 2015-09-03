<style>
.library_list li { 
    padding-left: 1em; 
    text-indent: -.7em;
	list-style:none !important;
}
.library_list li a::first-letter {
    font-size: 200%;
    color: #8A2BE2;
}
.library_list li:before {
    content: "• ";
    color: #00afda; /* or whatever color you prefer */
}
.library_list li:after {
    content: url('http://aiisa.am/img/down.png');
}

</style>
<section class="page-content-level column page-content-main " id="page-content-main">
    <header class="page-content-container main-title" id="main-title">
        <h1> Library</h1>
    </header>
    <section class="page-content-container main-content library_list" id="main-content">
    	<ul>
    	<?php





if (!empty($libraries)) {
    // output data of each row
    foreach ($libraries as $key => $value) {
        echo "<li><a href='/research/download_file/".$value['Library']["id"]."'>".$value['Library']["title"]." </a> </li> ";
    }
} else {
    echo "0 results";
}

?>
</ul>
    </section>
</section>