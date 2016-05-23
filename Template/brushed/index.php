<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if (IE 9)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Art Attack::The Designing Toolkit</title>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<!--[if vml]><style>vml\:* {behavior: url(#default#VML);}</style><![endif]-->
<script type="text/javascript" src="./jsgl.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"  type="text/javascript"></script>


<meta name="description" content="Insert Your Site Description" />

<!-- Mobile Specifics -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="HandheldFriendly" content="true"/>
<meta name="MobileOptimized" content="320"/>

<!-- Mobile Internet Explorer ClearType Technology -->
<!--[if IEMobile]>  <meta http-equiv="cleartype" content="on">  <![endif]-->

<!-- Bootstrap -->
<link href="_include/css/bootstrap.min.css" rel="stylesheet">

<!-- Main Style -->
<link href="_include/css/main.css" rel="stylesheet">

<!-- Supersized -->
<link href="_include/css/supersized.css" rel="stylesheet">
<link href="_include/css/supersized.shutter.css" rel="stylesheet">

<!-- FancyBox -->
<link href="_include/css/fancybox/jquery.fancybox.css" rel="stylesheet">

<!-- Font Icons -->
<link href="_include/css/fonts.css" rel="stylesheet">

<!-- Shortcodes -->
<link href="_include/css/shortcodes.css" rel="stylesheet">

<!-- Responsive -->
<link href="_include/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="_include/css/responsive.css" rel="stylesheet">

<!-- Supersized -->
<link href="_include/css/supersized.css" rel="stylesheet">
<link href="_include/css/supersized.shutter.css" rel="stylesheet">

<!-- Google Font -->
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>

<!-- Fav Icon -->
<link rel="shortcut icon" href="#">

<link rel="apple-touch-icon" href="#">
<link rel="apple-touch-icon" sizes="114x114" href="#">
<link rel="apple-touch-icon" sizes="72x72" href="#">
<link rel="apple-touch-icon" sizes="144x144" href="#">

<!-- Modernizr -->
<script src="_include/js/modernizr.js"></script>

<!-- Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'Insert Your Code']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>





<!-- End Analytics -->

</head>


<body>

<!-- This section is for Splash Screen -->
<!-- <div class="ole">
<section id="jSplash">
	<div id="circle"></div>
</section>
</div> -->
<!-- End of Splash Screen -->

<!-- Homepage Slider -->



    <div id="panel" style="width: 100%; height: 480px">
       <canvas id="drawing" style="width: 98%; height: 98%; margin: auto ; border:5px solid #c3c3c3;" >  </canvas>
    </div>




        <script type="text/javascript">
          /* Instantiate JSGL Panel. */
          myPanel = new jsgl.Panel(document.getElementById("panel"));
          myGroup = myPanel.createGroup();
          myPanel.addElement(myGroup);
          // $(document).ready(function(){
        // setInterval(function() {
            // $("#drawing").load("index.php");
        // }, 10000);
    // });
          var stroke = new jsgl.stroke.SolidStroke();
		  stroke.setColor('#036');
		  stroke.setWeight(5);
		  var fill = new jsgl.fill.SolidFill();
          fill.setColor('#cdf');
          /* Start drawing! */
          function circle(x,y,radius,temp){
          /* Create circle and modify it */
          console.log("Hello");
          temp = myPanel.createCircle();
          temp.setCenterLocationXY(x,y);
          temp.setRadius(radius);
          temp.getStroke().setWeight(5);
          temp.getStroke().setColor("rgb(255,0,0)");
          myPanel.addElement(temp);
     	  }
     
     	  function ellipse(x,y,width,height,temp,scolor,fcolor){
     		temp = myPanel.createEllipse();
     		temp.setCenterLocationXY(x,y);
     		temp.setSizeWH(width,height);
     		temp.getStroke().setWeight(5);
     		temp.getStroke().setColor(scolor)     			
     		temp.setRotation(45);
     		temp.getFill().setColor(fcolor);
     		temp.addClickListener(function(mouseEvent){  				
     		var angle = Math.atan2(mouseEvent.getY()-temp.getCenterY(), mouseEvent.getX()-temp.getCenterX());
    			temp.setRotation(180*angle/Math.PI);
     			}); 
     			myPanel.addElement(temp);
     		     }
     	  function rectangle(x,y,width,height,temp,scolor,fcolor){
     	  	temp = myPanel.createRectangle();
     	  	temp.setLocationXY(x,y);
          var myAnimator = new jsgl.util.Animator();
          myAnimator.setStartValue(0);
          myAnimator.setEndValue(360);
     		temp.setSizeWH(width,height);
     		temp.getStroke().setWeight(5);
     		temp.getStroke().setColor(scolor);
        myAnimator.addStepListener(function(t) {
        temp.setRotation(t);
       });
    temp.addClickListener(function() {
    myAnimator.rewind();
    myAnimator.play();
  });     			
     		// temp.setRotation(45);
     		temp.getFill().setColor(fcolor);
     		myPanel.addElement(temp);
     		}	
     		
          function line(startx,starty,endx,endy,temp,scolor,fcolor){
            temp = myPanel.createLine();
            temp.setStartPointXY(startx,starty);
            temp.setEndPointXY(endx,endy);
            temp.getStroke().setWeight(10);
            // var myStroke = new jsgl.stroke.SolidStroke();
            // myStroke.setColor(scolor);
            temp.getStroke().setColor(scolor);           
            // temp.setRotation(45);
            //temp.getFill().setColor(fcolor);
            myPanel.addElement(temp);
            }
          function polygon(){
          polygon = myPanel.createPolygon();
          polygon.addPointXY(50,50);
          polygon.addPointXY(110,50);
          polygon.addPointXY(150,80);
          polygon.addPointXY(110,110);
          polygon.addPointXY(50,110);
          polygon.getStroke().setWeight(5);
          polygon.getStroke().setColor("rgb(0,0,255)");
          polygon.getFill().setColor("rgb(0,255,0)");
          polygon.getFill().setOpacity(0.5);
          myGroup.addElement(polygon);
          }
          function label(x,y,text,temp){
          temp = myPanel.createLabel();
          temp.setText(text);
          temp.setLocationXY(x,y);
          temp.setBold(true);
          temp.setFontFamily("sans-serif");
          temp.setFontSize(24);
          myPanel.addElement(temp);
        }
         function person(x,y,temp){
         	var headCircle = myPanel.createCircle();
          temp = myPanel.createGroup();
          myPanel.addElement(temp);
          var myAnimator = new jsgl.util.Animator();
          myAnimator.setStartValue(x);
myAnimator.setEndValue(x+200);
myAnimator.addStepListener(function(t) {
    temp.setX(t);
  });
 
myAnimator.setDuration(1000);
 
temp.addClickListener(function() {
    myAnimator.rewind();
    myAnimator.play();
  });


headCircle.setCenterLocationXY(0, -30);
headCircle.setRadius(15);
headCircle.setStroke(stroke);
headCircle.setFill(fill);
temp.addElement(headCircle);
 
// create a rectangle for body
var bodyRect = myPanel.createRectangle();
bodyRect.setHorizontalAnchor(jsgl.HorizontalAnchor.CENTER);
bodyRect.setVerticalAnchor(jsgl.VerticalAnchor.TOP);
bodyRect.setLocationXY(0, -10);
bodyRect.setSizeWH(50, 50);
bodyRect.setStroke(stroke);
bodyRect.setFill(fill);
temp.addElement(bodyRect);
 
// create a line for hands
var handsLine = myPanel.createLine();
handsLine.setStartPointXY(-50, 0);
handsLine.setEndPointXY(50, 0);
handsLine.setStroke(stroke);
handsLine.setZIndex(-1);
temp.addElement(handsLine);
 
// create a polyline for legs
var legsPolyline = myPanel.createPolyline();
legsPolyline.addPointXY(-20, 70);
legsPolyline.addPointXY(-20, 55);
legsPolyline.addPointXY(0, 0);
legsPolyline.addPointXY(20, 55);
legsPolyline.addPointXY(20, 70);
legsPolyline.setStroke(stroke);
legsPolyline.setZIndex(-1);
temp.addElement(legsPolyline);
 
// move the entire group to the panel's center
temp.setLocationXY(x,y);
         }

        <?php
         // $url1=$_SERVER['REQUEST_URI'];
        // header("Refresh: 10; URL=$url1");
    mysql_connect('localhost','root','');
    mysql_select_db("art");
    $query="select * from draw";
    $res=mysql_query($query);
    echo "ellipse(500,200,200,300,'30','orange','red')\n";
    echo "rectangle(950,100,200,200,'40','purple','black')\n";
    echo "person(200,300,'46')\n";
     echo "person(400,300,'47')\n";
    echo "line(100,200,200,200,'45','purple','yellow')\n";
    while($row=mysql_fetch_array($res))
     {
      if($row['shape']=="circle"){
        $x=$row['xco'];
        $y=$row['yco'];
        $rad=$row['radius'];
        $sno=$row['S.no'];
        $temp=str_shuffle("HelloWorld");
          echo "circle($x,$y,$rad,'$sno')";
          echo "\n";
        }

      else if($row['shape']=="label"){
          $sno=$row['S.no'];
          echo "label($row[xco],$row[yco],'$row[text]','$sno')";
          echo "\n";
         }
         //


    }
    if(isset($_POST['clear'])){
      $query = "delete from draw where 1";
      if($res=mysql_query($query)){

      }
      else {
        
        echo mysql_error();
      }
    }

    ?>

         </script>


<!-- End Homepage Slider -->

<!-- Header -->
<header>
    <div class="sticky-nav">
    	<a id="mobile-nav" class="menu-nav" href="#menu-nav"></a>

        <!-- <div id="logo">
        	<a id="goUp" href="#home-slider">Art Attack</a>
        </div> -->

        <nav id="menu">

        	<ul id="menu-nav">

            	<li><a href="#home-slider">Home</a></li>
                <li><a href="#work">Our Work</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><form method="POST"><input class="btn-danger" type="submit" value="Clear" name="clear"></input></form></li>

            </ul>
        </nav>

    </div>
</header>
<!-- End Header -->

<!-- Our Work Section -->
<div id="work" class="page">
	<div class="container">
    	<!-- Title Page -->
        <div class="row">
            <div class="span12">
                <div class="title-page">
                    <h2 class="title">Art Attack</h2>
                    <h3 class="title-description"> <a href="#">The Designing Toolkit</a></h3>
                </div>

                <h3><a href="#">OVERVIEW</a></h3>
                <h4>An acquisitive drawing toolkit. The toolkit will render various shapes and lines on an android application, given input from a text file.</h4>.

                <h3><a href="#">OBJECTIVE</a></h3>
                <h4>In this project we are designing a new language which will be used for creating artistic shapes and animations in android application. The language will consist of different new methods to draw different shapes of varying size and colour, graphics and animation. We’ll create new keywords, data types, identifiers which will be first passed to get the total count of tokens. These tokens will further be fed to get the parsed form of the code in java.</h4>


            </div>
        </div>




      </div>
    </div>
        <!-- End Title Page -->


<!-- About Section -->
<div id="about" class="page-alternate">
<div class="container">
    <!-- Title Page -->
    <div class="row">
        <div class="span12">
            <div class="title-page">
                <h2 class="title">About Us</h2>
                <h3 class="title-description"><a href="#">Learn About our Team &amp; Culture</a></h3>
            </div>
        </div>
    </div>
    <!-- End Title Page -->








    <!-- People -->
    <div class="row">

        <!-- Start Profile -->
    	<div class="span3 profile">
        	<div class="image-wrap">
                <div class="hover-wrap">
                    <span class="overlay-img"></span>
                    <span class="overlay-text-thumb">Java Mobile APP</span>
                </div>
                <img src="_include/img/profile/anip.jpg" alt="John Doe">
            </div>
            <h3 class="profile-name"> <a href="#">Anip Mehta</a></h3>
            <p class="profile-description">13103630</p>


        </div>
        <!-- End Profile -->


                <!-- Start Profile -->
            	<div class="span3 profile">
                	<div class="image-wrap">
                        <div class="hover-wrap">
                            <span class="overlay-img"></span>
                            <span class="overlay-text-thumb">PHP And Design</span>
                        </div>
                        <img src="_include/img/profile/siddharth.jpg" alt="John Doe">
                    </div>
                    <h3 class="profile-name"> <a href="#">Siddharth Uppal</a></h3>
                    <p class="profile-description">13103622</p>


                </div>
                <!-- End Profile -->

                        <!-- Start Profile -->
                    	<div class="span3 profile">
                        	<div class="image-wrap">
                                <div class="hover-wrap">
                                    <span class="overlay-img"></span>
                                    <span class="overlay-text-thumb">Database And Parse</span>
                                </div>
                                <img src="_include/img/profile/avantika.jpg" alt="John Doe">
                            </div>
                            <h3 class="profile-name"> <a href="#">Avantika Verma</a></h3>
                            <p class="profile-description">13103625</p>


                        </div>
                        <!-- End Profile -->

                                <!-- Start Profile -->
                            	<div class="span3 profile">
                                	<div class="image-wrap">
                                        <div class="hover-wrap">
                                            <span class="overlay-img"></span>
                                            <span class="overlay-text-thumb">Website and Hosting</span>
                                        </div>
                                        <img src="_include/img/profile/kriti.jpg" alt="John Doe">
                                    </div>
                                    <h3 class="profile-name"> <a href="#">Kriti Agarwal</a></h3>
                                    <p class="profile-description">13103644</p>


                                </div>
                                <!-- End Profile -->





    </div>
    <!-- End People -->
</div>
</div>
<!-- End About Section -->


<!-- Contact Section -->
<div id="contact" class="page">
<div class="container">
    <!-- Title Page -->
    <div class="row">
        <div class="span12">
            <div class="title-page">
                <h2 class="title">Get in Touch</h2>
                <h3 class="title-description"><a href="#">Help Us In Improving Our Project</a></h3>
            </div>
        </div>
    </div>
    <!-- End Title Page -->

    <!-- Contact Form -->
    <div class="row">
    	<div class="span9">

        	<form id="contact-form" class="contact-form" action="#">
            	<p class="contact-name">
            		<input id="contact_name" type="text" placeholder="Full Name" value="" name="name" />
                </p>
                <p class="contact-email">
                	<input id="contact_email" type="text" placeholder="Email Address" value="" name="email" />
                </p>
                <p class="contact-message">
                	<textarea id="contact_message" placeholder="Your Message" name="message" rows="15" cols="40"></textarea>
                </p>
                <p class="contact-submit">
                	<a id="contact-submit" class="submit" href="#">Send Your Email</a>
                </p>

                <div id="response">

                </div>
            </form>

        </div>

        <div class="span3">
        	<div class="contact-details">
        		<h3>Contact Details</h3>
                <ul>
                    <li><a href="#">Anip Mehta</a>  <br>
                      hello@anip.xyz</li>

                      <li><a href="#">Siddharth Uppal</a>  <br>
                        sid_uppal@hotmail.com</li>

                        <li><a href="#">Avantika Verma</a>  <br>
                          vrmavantika@gmail.com</li>

                          <li><a href="#">Kriti Agarwal</a>  <br>
                            kriti.agarwal@gmail.com</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Contact Form -->
</div>
</div>
<!-- End Contact Section -->

<!-- Footer -->
<footer>
	<p class="credits"><a href="#">Compiler Project</a> Submitted To  <a href="#" >Ms Dhanlexmi</a></p>
</footer>
<!-- End Footer -->

<!-- Back To Top -->
<a id="back-to-top" href="#">
	<i class="font-icon-arrow-simple-up"></i>
</a>
<!-- End Back to Top -->


<!-- Js -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> <!-- jQuery Core -->
<script src="_include/js/bootstrap.min.js"></script> <!-- Bootstrap -->
<script src="_include/js/supersized.3.2.7.min.js"></script> <!-- Slider -->
<script src="_include/js/waypoints.js"></script> <!-- WayPoints -->
<script src="_include/js/waypoints-sticky.js"></script> <!-- Waypoints for Header -->
<script src="_include/js/jquery.isotope.js"></script> <!-- Isotope Filter -->
<script src="_include/js/jquery.fancybox.pack.js"></script> <!-- Fancybox -->
<script src="_include/js/jquery.fancybox-media.js"></script> <!-- Fancybox for Media -->
<script src="_include/js/jquery.tweet.js"></script> <!-- Tweet -->
<script src="_include/js/plugins.js"></script> <!-- Contains: jPreloader, jQuery Easing, jQuery ScrollTo, jQuery One Page Navi -->
<script src="_include/js/main.js"></script> <!-- Default JS -->
<!-- End Js -->

</body>
</html>
