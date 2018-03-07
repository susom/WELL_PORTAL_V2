<!doctype html>
<article>
	<?php
	$empty_flag = True; 
	foreach($cats as $domainEntry){
		if($domainEntry["domain"]-1 == $domain_page){
			$empty_flag=False;
	?> 
			<div class = "resourceEntry">
				<figure>
					<?php echo $domainEntry["pic"];?>
				</figure>
				<p> <?php echo $domainEntry["content"]; ?></p>
				<a href="<?php echo $domainEntry["link"];?>">LINK</a>
			</div>
	<?php
		} //if
	}//for
	if($empty_flag){
		echo "No current resources";
	}
	?>
</article>

<aside class = "sidenav">
	<ul>
		<li>
			<img class = "sideImages" src = "assets/img/00-domain.jpg">
			<a href="resources.php?nav=resources-0">Exploration and Creativity</a>
		</li>
		<li>
			<img class = "sideImages" src = "assets/img/01-domain.jpg">
			<a href="resources.php?nav=resources-1">Lifestyle Behaviors</a></li>
		<li>
			<img class = "sideImages" src = "assets/img/02-domain.jpg">
			<a href="resources.php?nav=resources-2">Social Connectedness</a></li>
		<li>
			<img class = "sideImages" src = "assets/img/03-domain.jpg">
			<a href="resources.php?nav=resources-3">Stress and Resilience</a></li>
		<li>
			<img class = "sideImages" src = "assets/img/04-domain.jpg">
			<a href="resources.php?nav=resources-4">Experience of Emotions</a></li>
		<li>
			<img class = "sideImages" src = "assets/img/05-domain.jpg">
			<a href="resources.php?nav=resources-5">Sense of Self</a></li>
		<li>
			<img class = "sideImages" src = "assets/img/06-domain.jpg">
			<a href="resources.php?nav=resources-6">Physical Health</a></li>
		<li>
			<img class = "sideImages" src = "assets/img/07-domain.jpg">
			<a href="resources.php?nav=resources-7">Purpose and Meaning</a></li>
		<li>
			<img class = "sideImages" src = "assets/img/08-domain.jpg">
			<a href="resources.php?nav=resources-8">Financial Security</a></li>
		<li>
			<img class = "sideImages" src = "assets/img/09-domain.jpg">
			<a href="resources.php?nav=resources-9">Spirituality and Religion</a></li>
	</ul>
</aside>



<style>
.resourceEntry{
	display:block;
	width:100%;
	height:70px;
	font-size: 13px;
}

ul,li{
	list-style: none;
	padding-left: none;
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

}
.sidenav a:hover{
	background-color: #f2f2f2;

}
.sidenav li {
	margin-bottom:15px; 
}


article{

	width:70%;
	float:right;
	text-align: center;
}

a{
	display:inline-block;
	padding:5px;

}

figure{
	float:left;
	display:inline-block;
}

</style>