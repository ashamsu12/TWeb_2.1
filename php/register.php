<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Register</title>
 
    
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
            document.getElementById("eventname").innerHTML =  event["name"];
            document.getElementById("form").setAttribute("action","../php/registrationDB.php?eventid="+ <?php echo $_GET["eventid"]; ?> +"&eventname=" + event["name"]);
    
        }</script>
    
<body onload="funct()">
   
    <main>
        <header>
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
                            <a href="#" class="menu__link">Contact</a>
                                            
                        
                    </ul>
                </nav>
            </div>
        </div>
        </header>
        <section class="reg-text">
            <div class="container">
                <div class="row reg-head">
                    <div class="col-lg-12 text-center">
                        <h1>Registeration</h1>
                    </div>
                </div>
                <form id="form"  method="post">
                <div class="well">
                    <div class="row reg-wrap1">
                        <div class="col-lg-4">
                            <div class="row coke">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h2> Event</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <img src="../images/dum.jpg">
                                        </div>
                                        <div class="col-lg-9">
                                            <p id="name">Name: shamsu</p>
                                            <p id="date">Date: 01-01-2010</p>
                                            <p id="loc"> Location: Dubai Marina</p>
                                            <p  id="desc"> Description: I like to judge as often as possible </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-lg-push-1 text-center">
                            <div class="reg-sec1">
                                <h2>Mentor details</h2>
                                <fieldset class="form-horizontal "> 
                                    <div class="form-group form-group-lg">
                                        
                                        <div class="col-sm-8">
                                            <input  required="true" name="mname" class="form-control" type="text" id="formGroupInputLarge" placeholder="Mentor Name">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-lg">
                                
                                        <div class="col-sm-8">
                                            <input required="true" name="memail" class="form-control" type="email" id="formGroupInputLarge" placeholder="Mentor's email">    
                                        </div>    
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <div class="reg-sec1" id="reg-sec2">
                                <fieldset class="form-horizontal "> 
                                    <div class="form-group">
                                        <h2>Team details</h2>
                                        <?php
                                          if(isset($_GET["err"]) and $_GET["err"] == "E400"){
                                              echo "<p style='color:indianred;font-weight:600'>Sorry!Your Team name has already been selected.</p>";
                                          }
                                        ?>
                                        <div class="col-sm-8">
                                            <input required="true" name="teamName" class="form-control" type="text" id="formGroupInputLarge" placeholder="Team name">
                                        </div>
                                    </div>
                                 
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                            <input required="true" name="puni" class="form-control" type="text" id="formGroupInputLarge" placeholder="Institution">
                                        </div>
                                          
                                    </div>
                                    
                                    <div class="form-group">
                                   
                                        <div class="col-sm-8">
                                            <input required="true" name="pname" class="form-control" type="text" placeholder="Project Name">
                                            
                                        </div>    
                                    </div>
                                       <div class="form-group">
                                    
                                        <div class="col-sm-8">
                                            <select required="true" name="pcat" class="form-control" type="text" placeholder="Category">
                                                <option>Computer Science</option>
                                                <option>Engineering</option>
                                                <option>MIS</option>
                                            </select>
                                        </div>    
                                    </div>
                                        <div class="form-group">
                                   
                                        <div class="col-sm-8">
                                            <input name="pdesc" class="form-control" type="text"
                                            required="true"    maxlength="200" placeholder="Project Description">
                                        </div>    
                                    </div>
                                    </fieldset>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="reg-sec1" id="reg-sec2">
                                <fieldset class="form-horizontal "> 
                                    <div class="form-group">
                                        <h2>Team members</h2>
                                       
                                        <div class="col-sm-8">
                                            <input required="true" name="student1"class="form-control" type="text" id="formGroupInputLarge" placeholder="Student Name">
                                        </div>
                                        <div class="form-group form-group-lg">
                                  
                                          
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    
                                        <div class="col-sm-8">
                                            <input required="true" name="student2" class="form-control" type="text" placeholder="Student Name">
                                        </div> 
                                       <div class="form-group form-group-lg">
                                   
                                           
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                   
                                        <div class="col-sm-8">
                                            <input name="student3" class="form-control" type="text" placeholder="Student Name">
                                        </div>  
                                        <div class="form-group form-group-lg">
                                   
                                           
                                    </div>
                                    </div>
                                    
                                     <div class="form-group">
                                   
                                        <div class="col-sm-8">
                                            <input name="student4" class="form-control" type="text" placeholder="Student Name">
                                           

                                        </div>  
                                        <div class="form-group form-group-lg">
                                   
                                        
                                    </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="reg-sec1" id="reg-sec2">
                                <fieldset class="form-horizontal " id="requestform"> 
                                    <div class="form-group">
                                        <h2>Special requests</h2>
                                       
                                      </div>
                                   
                                </fieldset>
                                                <label class="col-sm-4 control-label" for="textarea">Request:</label>
                                                
                                               <input class="form-control" rows="4" co
                                                         ls="50" name="comment" placeholder="/requests">
                                                <input id="eventname" name="eventname"  hidden="true"  >
                             
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            
                            <input type="submit" class="submit" >
                        </div>
                    </div>
                </div>
                    </form>
            </div>
        </section>
    </main>
S
</body>
</html>
