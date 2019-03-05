	<?php include_once("gl_socialfoot.php") ?>
    </div>
</div>
<div id="dialog" class="">
    <div class="dialog_inner">

    </div>
</div>
<style>
#dialog.show{
    opacity:1;
    top:50%;
    z-index:500;
}
#dialog {
    position: fixed;
    top:40%;
    left:50%;
    width: 500px;
    margin-left: -250px;
    height: 350px;
    margin-top: -175px;
    background: honeydew url(assets/img/icon_apple_teacher.png) 0 100% no-repeat;
    background-size:40%;
    border:1px solid darkgrey;
    border-radius: 5px;
    box-shadow: 0 0 10px darkgreen;
    text-align:center;
    opacity:0;
    z-index:-999;
    transition:.5s opacity, .3s top ease-in-out;
}
#dialog .dialog_inner{
    margin:50px auto;
    padding:0 50px;
}
#dialog.celebrate:before{
    content:"";
    width: 35%;
    height: 100%;
    background: url(assets/img/bg/bg_frame_poppers.png) no-repeat;
    position: absolute;
    top:20px;
    left: -35%;
    background-size: 203%;
}
#dialog.celebrate:after{
    content:"";
    width: 35%;
    height: 100%;
    background: url(assets/img/bg/bg_frame_poppers.png) 98% 0 no-repeat;
    position: absolute;
    top:20px;
    left: 100%;
    background-size: 203%;
}
#dialog .btn {
    margin-right:5px;
}

#dialog.apple{
    position: fixed;
    top:40%;
    left:50%;
    width: 500px;
    margin-left: -250px;
    height: 350px;
    margin-top: -175px;
    background: honeydew url(assets/img/icon_apple_teacher.png) 0 100% no-repeat;
    background-size:40%;
    border:1px solid darkgrey;
    border-radius: 5px;
}
#dialog.apple li, #dialog.apple h3 {
    text-align:left;
}
#dialog.apple button{
    float: right;
    margin-top: 100px;
}
</style>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<!-- Bootstrap -->
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
<script src="assets/js/charts/sparkline/jquery.sparkline.min.js"></script>
<script src="assets/js/charts/flot/jquery.flot.min.js"></script>
<script src="assets/js/charts/flot/jquery.flot.tooltip.min.js"></script>
<script src="assets/js/charts/flot/jquery.flot.spline.js"></script>
<script src="assets/js/charts/flot/jquery.flot.pie.min.js"></script>
<script src="assets/js/charts/flot/jquery.flot.resize.js"></script>
<script src="assets/js/charts/flot/jquery.flot.grow.js"></script>
<script src="assets/js/charts/flot/demo.js"></script>
<script src="assets/js/calendar/bootstrap_calendar.js"></script>
<script src="assets/js/calendar/demo.js"></script>
<script src="assets/js/app.plugin.js"></script> 
<script src="assets/js/jquery.visible.min.js"></script>
<script src="assets/js/jquery.simpleWeather.js"></script>
<script src="assets/js/weather.js"></script>
<script src="assets/js/roundslider.js"></script>
<script src="assets/js/verify.notify.min.js"></script>
<script src="assets/js/underscore-min.js"></script>
</body>
</html>
<script>
$(document).ready(function(){
    <?php
    foreach($game_points as $point_type => $values){
        $vals = json_decode($values,1);
        if(!empty($vals)){
            echo "var " .$point_type." = " . $values . ";\n";
        }
    }
    ?>

    //CHECK SESSION BEFORE SCORING
    // .resourceEntry a
    // .resource_links figcaption a

    // .points_mini_challenge
    // .core_supp a

    //ANY LINK GETS 1 POINT PER SESSION EXCEPT
    //points_none
    $("a:not(.points_none)").click(function(){
        var clicked     = $(this).attr("href");

        var minic_      = $(this).hasClass("points_mini_challenge");
        var survey_     = $(this).hasClass("points_survey");
        var resources_  = $(this).hasClass("points_resources");

        var click_val   = parseInt(gamify_pts_any.value);
        var persist_pts = "";
        if(minic_){
            persist_pts = "&persist=" + parseInt(gamify_pts_minichallenge.value);
        }else if(survey_){
            persist_pts = "&persist=" + parseInt(gamify_pts_survey.value);
        }else if(resources_){
            persist_pts = "&persist=" + parseInt(gamify_pts_resources.value);
        }

        console.log("action=session_points&value="+click_val+"&link="+clicked + persist_pts);

        $.ajax({
            url : "ajax_handler.php",
            type: 'POST',
            data: "action=session_points&value="+click_val+"&link="+clicked + persist_pts,
            datatype: 'JSON',
            success:function(result){
                console.log(result);
                //update the points box
                var result = JSON.parse(result);
                if(result.hasOwnProperty("points_added")){
                    var curpoints = parseInt($("#global_points a").text());
                    curpoints = curpoints + parseInt(result.points_added);
                    $("#global_points a").text(curpoints);
                }
            }
        });
    });

    //OPEN MINI CHALLENGE
    $("#dialog").on("click",".btn",function(e){
        $("#dialog").removeClass("show").removeClass("celebrate");
        if($(this).data("action") == "openmini"){
            var minihref= $(this).attr("href");
            window.open(minihref, "_blank");
        }

        e.preventDefault();
    });

    //RECORD POINTS FOR MINI C
    $(".mini_challenges a").on("click",function(e){
        var minihref= $(this).attr("href");

        $("#dialog .dialog_inner").empty();
        var title   = $("<h3>").html("Mini Challenge");
        var p1      = $("<p>").html("You will recieve points and a background as reward for completing Mini-Challenges. View your rewards on the <a href='rewards.php'>Rewards Page</a>.");
        var p2      = $("<p>").text("Click to continue to the mini-challenge.");
        var btn     = $("<a>").html("Go to Mini-Challenge").data("action","openmini").addClass("btn-success").addClass("btn").attr("href",minihref);
        var cancel  = $("<button>").addClass("btn btn-danger").addClass("btn btn-danger").html("Cancel");
        $("#dialog .dialog_inner").append(title);
        $("#dialog .dialog_inner").append(p1);
        $("#dialog .dialog_inner").append(p2);
        $("#dialog .dialog_inner").append(btn);
        $("#dialog .dialog_inner").append(cancel);
        $("#dialog").addClass("show");


        var dataurl = "&mini_clicked=" + $(this).parent("li").attr("class");
        $.ajax({
            url:  "index.php",
            type:'POST',
            dataType: "JSON",
            data: dataurl,
            success:function(result){
                console.log(result);
            }
        });

        e.preventDefault();
    });

    <?php
        if( $one_off_wof_unlocked ){
            ?>
            var gamehref = "game.php";
            $("#dialog .dialog_inner").removeClass("celebrate").empty();
            var title   = $("<h3>").html("Congrats, You've unlocked <br>The WELL OF FORTUNE game");
            var p1      = $("<p>").html("You will now be able to use the WELL points that you have earned to play <a href='game.php'>WELL OF FORTUNE</a> and earn more prizes!");
            var btn     = $("<a>").html("Go to WELL OF FORTUNE").data("action","openmini").addClass("btn-success").addClass("btn").attr("href",gamehref);
            var cancel  = $("<button>").addClass("btn btn-danger").addClass("btn btn-danger").html("Cancel");
            $("#dialog .dialog_inner").append(title);
            $("#dialog .dialog_inner").append(p1);
            $("#dialog .dialog_inner").append(btn);
            $("#dialog .dialog_inner").append(cancel);
            $("#dialog").addClass("show").addClass("celebrate");
            <?php
        }
    ?>
});


$(document).on('click', function(event) {
    if ($(event.target).not("[target='blank']").closest('.alert').length && !$(event.target).closest("#confirm_email").length) {
        $(".alert").fadeOut("fast",function(){
          $(".alert").remove();
        });
    }

    if (typeof(Storage) !== "undefined" && window.sessionStorage) {
        // CHECK FOR sessionStorage
        if(sessionStorage.getItem("resumeUploads")){
            var something = JSON.parse(localStorage.getItem("resumeUploads"));
        }else{

        }
    }
});

$("a.disabled").click(function(){
  return false;
});

// this will wait to show alert boxes until after page loads
$(".alert").css("opacity",1);
</script>
