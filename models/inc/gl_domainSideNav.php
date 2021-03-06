<article class="col-sm-12 col-md-8 col-sm-first col-md-last">
	<?php
	$cats = array_reverse($cats);
	foreach($cats as $domainEntry){
		if($domainEntry["domain"]-1 == $domain_page){
			$empty_flag=False;
	?> 
			<div class="resourceEntry col-sm-12 row">
                <div class="col-sm-12 col-md-3">
				<?php 
				if(isset($domainEntry["image-catagory"])){
					switch($domainEntry["image-catagory"]){
						case 1:
							echo "<img class='resourcetype' src='assets/img/01image-catagory.png' >";
							break;
						case 2:
							echo "<img class='resourcetype' src='assets/img/02image-catagory.png' >";
							break;
						case 3:
							echo "<img class='resourcetype' src='assets/img/03image-catagory.png' >";
							break;
						case 4:
							echo "<img class='resourcetype' src='assets/img/04image-catagory.png' >";
							break;
						case 5:
							echo "<img class='resourcetype' src='assets/img/05image-catagory.png' >";
							break;
						case 6:
							echo "<img class='resourcetype' src='assets/img/06image-catagory.png' >";
							break;
					}

				}
				echo $domainEntry["pic"];
				?>
                </div>
                <div class="col-sm-12 col-md-9">
                    <h2><a class="points_resources" target="_blank" href="<?php echo $domainEntry["link"];?>"> <?php echo $domainEntry["link-text"];?></a></h2>
                    <p> <?php echo $domainEntry["content"]; ?></p>
                </div>
			</div>
	<?php
		} //if
	}//for
	if($empty_flag){
		echo lang("RESOURCE_NONE");
	}
	?>
</article>

<aside class="sidenav col-sm-12 col-md-3 col-sm-last col-md-first">
	<h4>My Resources</h4>
	<ul class="domains">
		<li>
			<img class="sideImages" src="assets/img/00-domain.png">
			<a href="resources.php?nav=resources-0" class="<?php echo  $domain_on["resources-0"] ?>"><?php echo lang("RESOURCE_CREATIVITY") ?></a>
		</li>
		<li>
			<img class="sideImages" src="assets/img/01-domain.png">
			<a href="resources.php?nav=resources-1" class="<?php echo   $domain_on["resources-1"]?>"><?php echo lang("RESOURCE_LIFESTYLE") ?></a></li>
		<li>
			<img class="sideImages" src="assets/img/02-domain.png">
			<a href="resources.php?nav=resources-2" class="<?php echo   $domain_on["resources-2"]?>"><?php echo lang("RESOURCE_SOCIAL") ?></a></li>
		<li>
			<img class="sideImages" src="assets/img/03-domain.png">
			<a href="resources.php?nav=resources-3" class="<?php echo   $domain_on["resources-3"]?>"><?php echo lang("RESOURCE_STRESS") ?></a></li>
		<li>
			<img class="sideImages" src="assets/img/04-domain.png">
			<a href="resources.php?nav=resources-4" class="<?php echo  $domain_on["resources-4"] ?>"><?php echo lang("RESOURCE_EMOTIONS") ?></a></li>
		<li>
			<img class="sideImages" src="assets/img/05-domain.png">
			<a href="resources.php?nav=resources-5" class="<?php echo  $domain_on["resources-5"] ?>"><?php echo lang("RESOURCE_SELF") ?></a></li>
		<li>
			<img class="sideImages" src="assets/img/06-domain.png">
			<a href="resources.php?nav=resources-6" class="<?php echo  $domain_on["resources-6"] ?>"><?php echo lang("RESOURCE_PHYSICAL") ?></a></li>
		<li>
			<img class="sideImages" src="assets/img/07-domain.png">
			<a href="resources.php?nav=resources-7" class="<?php echo   $domain_on["resources-7"]?>"><?php echo lang("RESOURCE_PURPOSE") ?></a></li>
		<li>
			<img class="sideImages" src="assets/img/08-domain.png">
			<a href="resources.php?nav=resources-8" class="<?php echo  $domain_on["resources-8"] ?>"><?php echo lang("RESOURCE_FINANCIAL") ?></a></li>
		<li>
			<img class="sideImages" src="assets/img/09-domain.png">
			<a href="resources.php?nav=resources-9" class="<?php echo  $domain_on["resources-9"]?>"><?php echo lang("RESOURCE_RELIGION") ?></a></li>
	</ul>
</aside>



<style>
.resourceEntry{
	background-color: #f2f2f2;
	margin:10px 0;
    padding:10px 0;
	border-radius: 10px;
	overflow:hidden;
}

.resourcetype{
    max-width:80%;
}
ul,li{
	list-style: none;
	padding-left: 0;
}
.sideImages{
	max-height: 40px;
	max-width: 40px;
	display:inline-block;
}
.sidenav{
	width: 300px;;
	z-index: 1;
	left:0;
	overflow-x:hidden;
}

.sidenav a{
	font-size:16px;
	color:black;
	display:inline-block;
	width:65%;
	padding-left:8px;
}
.sidenav a.on,
.sidenav a:hover{
	background-color: #f2f2f2;
	border-radius:5px;
}
.sidenav li {
	margin-bottom:15px; 
}


article{

	width:70%;
	float:right;
	text-align: center;
}



.event_img{
	float:left;
	display:inline-block;
	max-width:126px;
	max-height:126px;
	margin:10px;
}
h4{
	color:chocolate;
	text-align:left;
	font-size: 150%;
}
</style>