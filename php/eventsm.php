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

    <script>
        function btntest_onclick() 
{
    var id = <?php echo $_GET["eventid"];
                        ?>;
    
    window.location.href = "./register.php?eventid="+id;
}
    </script>
  
</head>

<body onload="funct()">

<section >    
           <div id="header" class="l-header">
            <div class="wrap">
                <header class="logo">
                    <h1 class="logo__title">
                        <a href="../index.php" class="logo__link">
                           TSMSWeb
                        </a>
                    </h1>
                      
                </header>
                   <div class="box">
                    
                    </div>
                <button class="btnn menu-btnn">Menu</button>
                <nav class="menu">
                    <ul class="menu__list">
                        <li class="menu__item">
                            <a href="../index.php" class="menu__link">Home</a>
                        </li><li class="menu__item">
                            <a href="../php/events.php" class="menu__link">Events</a>
                        </li><li class="menu__item">
                            <a href="#" class="menu__link">Download</a>
                                            
                        
                    </ul>
                </nav>
            </div>
        </div>
</section>
    <section id="ppf">
        <div class="container">
            <div class="row margin-top">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="left" >
                        <img src="../images/dum.jpg">
                        <p id="name">Name: Test</p>
                        <p id="date">Date: 01-01-2010</p>
                        <p id="loc"> Location: Dubai Marina</p>
                        <p  id="desc"> Description: test description </p>
                    </div>
                </div>
                <div  class="col-lg-8 col-md-8 col-xs-12">
                    <div class="right">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                                <div class="conw">
                                <button id="reg1" onclick="return btntest_onclick()" >  Register</button>
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
                                    <form id="ppp">
                                      <ul id="plot" class="row margin-top">
                                    
                                    </ul>
                                        </form>
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
    div = document.createElement("li");
    //div.setAttribute("onclick", "getVote(this.value)");
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
       
    var btn = document.createElement("input");
    
       var t = document.createElement("label");  
        t.className = "lcontainer";
        t.setAttribute("for","opt" + i);
        t.innerHTML = "vote";
      
  
  
    btn.setAttribute("type","radio");
    btn.setAttribute("name","vote");
    btn.setAttribute("value",i);
    btn.setAttribute("id","opt" + i);
    btn.setAttribute("onClick","getVote(this.value)");
 
    var span = document.createElement("span");
        span.className = "checkmark";
        
    t.appendChild(btn);
    t.appendChild(span);
    var tr = document.createElement("div");
    tr.className = "card_circle transition";      
     div2.appendChild(project);
     div2.appendChild(uni);
     div2.appendChild(cat);
     div2.appendChild(desc);
     div2.appendChild(t);
     div2.appendChild(div3);
     div.appendChild(div2);
    
    
    
    section.appendChild(div);
}
     }
        

    </script>
    <script>
function getote(int) {
  
    xmlhttp=new XMLHttpRequest();
  
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
       $("#ppp").html(this.responseText);
 
    }
 
  }
  var id = <?php echo $_GET["eventid"]?>;
  xmlhttp.open("GET","voted.php?eventid="+id+"&vote="+int,true);
  xmlhttp.send()
}
function getVote(int) {
     var id = <?php echo $_GET["eventid"]?>; 
    $("#plot").html('<div class="loader"></div>');
     
    jQuery.get("http://localhost/TWeb/php/voted.php?eventid="+id+"&vote="+int,
                 function(data, status){
             $("#plot").html(data);
    });
}
</script>

</html>