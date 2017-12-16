<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Events</title>
 <meta http-equiv="Cache-control" content="no-cache">
   
      <link rel="stylesheet" href="../css/reset.min.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'></script>  
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">-->
      <link rel="stylesheet" href="../css/style.css">
<!-- <link rel="stylesheet" href="../css/reset.min.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href = "../images/Header.png" rel="icon" type="image/png" >
    

 
</head>

<script>
    function load(){
        var events =
        <?php
            require_once 'dbConnect.php';
        $stmt = $conn->prepare("SELECT ID, Name,Type, BeginDate,time,creator,address FROM events");
				
					$result = $stmt->execute();
					$stmt->store_result();
					$ev = array();
					$readevent; 
					$count = 0;
					
					//if the event already exist in the database 
					if($stmt->num_rows > 0){
						$stmt->bind_result($id, $name, $type, $begindate, $time, $creator, $address);
							
							
							while($stmt->fetch())
									{
    

								$readevent = array(
								'id'=> $id,
								'name'=>$name, 
								'type'=>$type,
								'date' => $begindate,
								'time'=>$time,
								'creator'=> $creator,
								'address'=> $address
									);
									$index = "event" . $count;
									array_push($ev, $readevent); 
									
									$count++;
									}
						$response['error'] = false; 
					   $response['message'] = 'Events loaded successfully'; 	
						$response['ev'] = $ev;
                        echo json_encode($ev);
					}
                    
                     
                    $stmt->close();
                    
					
					
        ?>;
        var section = document.getElementById("contain");
        for(var i = 0; i < events.length; i++) {
    var div1, div2, div3, div4, div5, div6, div01, div02, div03, div04;
    div1 = document.createElement("div");
    div1.className = "event-wrap";

      div2 = document.createElement("div");
    div2.className = "row";
            
      div3 = document.createElement("div");
    div3.className = "col-md-12";
            
      div4 = document.createElement("div");
    div4.className = "row";
            
     div5 = document.createElement("div");
    div5.className = "col-md-12";
    
     div6 = document.createElement("div");
    div6.className = "photo";
    var x = document.createElement("div");
            x.className = "circle";
    var y = document.createElement("span");
            y.className = "initials";
        y.innerHTML =  events[i].name.substr(0,1);  
        x.appendChild(y);
     div6.appendChild(x);

        
    
  
        var div04 = document.createElement("div");
        div04.setAttribute("class","col-md-2 text-center");    
        var div004 = document.createElement("div");
        div004.setAttribute("class", "but");
            
          var btn = document.createElement("button");
          
        t = document.createTextNode("ENTER");       // Create a text nod
        btn.appendChild(t); 
            btn.setAttribute("id","reg");
            btn.setAttribute("onclick","return btntest_onclick("+events[i].id+")");
            
            div004.appendChild(btn);
            div04.appendChild(div004);
            
    div01 = document.createElement("div");
    div01.className = "row";
      div02 = document.createElement("div");
    div02.className = "col-md-10";
             div03 = document.createElement("div");
    div03.className = "event-text";
            
     
    var title = document.createElement("h2");
    title.innerHTML = events[i].name;
            title.setAttribute("style","color:white;");
    div03.appendChild(title);
    var p = document.createElement("p");
    p.setAttribute("style","color:white;");
    p.innerHTML = events[i].type;
     var p1 = document.createElement("p");
    p1.innerHTML = events[i].address;
            p1.setAttribute("style","color:white;");
    var p2 = document.createElement("p");
    p2.innerHTML = events[i].date + " at " + events[i].time;
       p2.setAttribute("style","color:white;");

            div03.appendChild(p);
            div03.appendChild(p1);
            div03.appendChild(p2);
   div5.appendChild(div6);
    div4.appendChild(div5);
    div3.appendChild(div4);
    div2.appendChild(div3);
    div1.appendChild(div2);
            div02.appendChild(div03);
    div01.appendChild(div02);
    div01.appendChild(div04);
    div3.appendChild(div01);   
            
 
 
    
            section.appendChild(div1);
}

        
    }
    function btntest_onclick(id) 
{
    window.location.href = "./eventsm.php?eventid="+id;
}

function myFunction() {
  // Declare variables 
  var input, filter, container, tr, td, i;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("contain");
  tr = table.getElementsByClassName("event-wrap");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
      document.getElementById("myCarousel").style.display = "none";
    
    td = tr[i].querySelectorAll("div.event-text");
    var text = td[0].getElementsByTagName("h2")[0]; 
    if (text) {
      if (text.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
          
      }
    } 
  }

}

    </script>
<body onload="load()">
<section>    
            
            <div id="header" class="l-header">
            <div class="wrap">
                <header class="logo">
                    <h1 class="logo__title">
                        <a href="../index.php" class="logo__link">
                           <img src="../images/TSMSWeb.png" width="200" height="80" alt="TSMS Logo">
                        </a>
                    </h1>
                      
                </header>
                   <div class="box">
                    <div class="container-1">
                        <span class="icon"><i class="fa fa-search"></i></span>
                        <input type="search"  id="search" onkeyup="myFunction()" placeholder="Search..." />
                                </div>
                    </div>
                <button class="btnn menu-btnn">Menu</button>
                <nav class="menu">
                    <ul class="menu__list">
                        <li class="menu__item">
                            <a href="../index.php" class="menu__link">Home</a>
                        </li><li class="menu__item">
                            <a href="./events.php" class="menu__link">Events</a>
                        </li><li class="menu__item">
                            <a href="./contact.php" class="menu__link">Contact</a>
                                            
                        
                    </ul>
                </nav>
            </div>
        </div>
       
</section>
<!--
    <section class="banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
-->
                    <div id="myCarousel" class="carousel slide mycar" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-wrap">
                            <div class="carousel-inner">
                              <div class="item active">
                                <img class="img-responsive center-block" img src="../images/image3.png" style="width:75%;">
                              </div>

                              <div class="item">
                                <img class="img-responsive center-block" img src="../images/image2.png" style="width:45%;">
                              </div>

                              <div class="item">
                                <img class="img-responsive center-block" img src="../images/image1.png"  style="width:45%;">
                              </div>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right"></span>
                          <span class="sr-only">Next</span>
                        </a>
                        
                    </div>
<!--
                </div>
            </div>
        </div>
    
        
    </section>
-->
    <section id="section1" class="events-sec1">
        <div id="contain" class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1> Events</h1>
                </div>
            </div>
            
                    </div>
            </section>  
    
      <script src="../js/index.js"></script>
    <script src="../js/menu.js"></script>
</body>
</html>
