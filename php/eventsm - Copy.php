<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Home</title>
 
    
    <script src='http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'></script>  
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">-->
      <link rel="stylesheet" href="../css/style.css">
<!-- <link rel="stylesheet" href="../css/reset.min.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
  
</head>

<body onload="funct()">

<section >    
          <div id="header" class="l-header head">
            <div class="wrap">
                <header class="logo">
                    <h1 class="logo__title">
                        <a href="index.php" class="logo__link">
                           TSMSWeb
                        </a>
                    </h1>
                </header>
                <button class="btn menu-btn">Menu</button>
                 <nav class="menu">
                    <ul class="menu__list">
                        <li class="menu__item">
                            <a href="index.php" class="menu__link">Home</a>
                        </li><li class="menu__item">
                            <a href="Projects.php" class="menu__link">Projects</a>
                        </li><li class="menu__item">
                            <a href="Registration.php" class="menu__link">Registration</a>
                        </li><li class="menu__item">
                        <a href="#" class="menu__link">About</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
</section>
    <section>
        <div class="container">
            <div class="row margin-top">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="left" >
                        <img src="../images/dum.jpg">
                        <p id="name">Name: shamsu</p>
                        <p id="date">Date: 01-01-2010</p>
                        <p id="loc"> Location: Dubai Marina</p>
                        <p  id="desc"> Description: I like to judge as often as possible </p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-xs-12">
                    <div class="right">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                                <div class="conw">
                                <button id="reg1"> Register</button>
                                    </div>
                            </div>
                        </div>
                        <div class="row margin-top">
                            <div class="col-lg-12  col-md-12 col-xs-12 ">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h3> Registered Team</h3>
                                        </div>
                                    </div>
                                    <div id="plot" class="row margin-top">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>
      <script>
     
  function funct(){
    
       var event =   <?php
            require_once 'dbConnect.php';

            $ID = $_GET["eventid"];
           $_POST["eventid"] = $ID;
                if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                        }
                
                $stmt = $conn->prepare("SELECT ID, Name,Type, BeginDate,time,creator,address FROM events e WHERE ID = ? ");
					$stmt->bind_param("s",$ID);
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
								'begindate' => $begindate,
								'time'=>$time,
								'creator'=> $creator,
								'address'=> $address
									);
									$index = "event" . $count;
									$ev[$index] = $readevent; 
									
									$count++;
						
                            }
                        $response = array();
						$response['error'] = false; 
					   $response['message'] = 'Events loaded successfully'; 	
						$response['ev'] = $readevent;
                        
                        echo json_encode($readevent) ;
					}
                     
                    $stmt->close();
    ?> ;
            document.getElementById("name").innerHTML = event["name"];
            document.getElementById("date").innerHTML =  event["begindate"];
            document.getElementById("loc").innerHTML =  event["address"];
            document.getElementById("desc").innerHTML =  event["type"];
            
    
       
        var teams =
        <?php
            require_once 'dbConnect.php';
            $event = $_GET["eventid"];
       $stmt = $conn->prepare("SELECT Tname, Institution,pname, pcat, pdesc FROM teams WHERE Event in (SELECT Name from events where ID = ? )");
					$stmt->bind_param("i",$event);
					$result = $stmt->execute();
					$stmt->store_result();
					$teams = array();
					$readevent; 
					$count = 0;
					
					//if the event already exist in the database 
					if($stmt->num_rows > 0){
						$stmt->bind_result($tname, $institution, $pname, $pcat, $pdesc);
							
							
							while($stmt->fetch())
									{
    
								$team = array(
							
								'tname'=>$tname, 
				                'institution' => $institution,
								'pname'=> $pname,
								'pcat'=> $pcat,
                                'pdesc' => $pdesc
									);
									$index = "team" . $count;
									array_push($teams, $team); 
									
									$count++;
									}
						$response['error'] = false; 
					   $response['message'] = 'Teams loaded successfully'; 	
						$response['teams'] = $teams;
                         echo json_encode($teams);
					}
                   
                    $stmt->close();
					
					
        ?>;
        
       
        var section = document.getElementById("plot");
        for(var i = 0; i < teams.length; i++) {
    var div, div2;
    div = document.createElement("div");
    div.className = "col-lg-4 col-md-4 text-center";

             div2 = document.createElement("div");
    div2.className = "carden";
      div3 = document.createElement("div");
    div3.className = "card tooltiptext";
    div3.innerHTML = teams[i].pdesc;
   
     
    var x = document.createElement("div");
            x.className = "circle";
    var y = document.createElement("span");
            y.className = "initials";
        y.innerHTML =  teams[i].institution.substr(0,1);  
        x.appendChild(y);
    div2.appendChild(x);



//   division.innerHTML= '<h2 class="d transition">'+value.institution +'</h2>\
//    <p class="c">'+value.pdesc +'</p>\<div class="cta-container transition"><a href="#" class="cta"> Vote </a>/</div><div class="card_circle transition"></div>';

    
    var project = document.createElement("p");
    project.innerHTML = teams[i].pname;
    project.className = "d transition";        

       
    var uni = document.createElement("p");
    uni.innerHTML = teams[i].institution;
    uni.className = "d transition";        

  
    var cat = document.createElement("p");
    cat.innerHTML = teams[i].pcat;
        
  
    var desc = document.createElement("p");
    desc.innerHTML = teams[i].pdesc;
       
    var btn = document.createElement("button");
      
    var t = document.createTextNode("VOTE");       // Create a text nod
    btn.appendChild(t); 
    btn.setAttribute("id","reg");
   
    //btn.setAttribute("onclick","return btntest_onclick("+events[i].id+")");
    var tr = document.createElement("div");
    tr.className = "card_circle transition";      
     div2.appendChild(project);
     div2.appendChild(uni);
     div2.appendChild(cat);
     div2.appendChild(desc);
     div2.appendChild(div3);
      div.appendChild(div2);
    
    
    section.appendChild(div);
}
     }

    </script>
</html>