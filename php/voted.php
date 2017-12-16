
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">-->
      <link rel="stylesheet" href="../css/style.css">
<!-- <link rel="stylesheet" href="../css/reset.min.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script onload="vote()">
    
    
 
function vote(){
var arr =    <?php

    require_once 'dbConnect.php';
            $event = $_GET["eventid"]; 
            $vote = $_REQUEST['vote'];
    $filename = "./poll_result.txt";
    $content = file($filename); 
    $v = 1;
    
      $stmt = $conn->prepare("SELECT count(Tname) FROM teams WHERE Event in (SELECT Name from events where ID = ? )");
					$stmt->bind_param("i",$event);
					$result = $stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($count);
                    $stmt->fetch(); 
             
                    echo "this is count :".$count;
					
					
    $stmt = $conn->prepare("SELECT  AID, votes FROM tally WHERE EID = ? ");
					$stmt->bind_param("s", $event);
					$stmt->execute();
					$stmt->store_result();
    
					
					//if the user already exist in the database 
					if($stmt->num_rows > 0){
					 $stmt = $conn->prepare("UPDATE tally set votes = votes + 1 WHERE EID = ? AND AID = ?");
					$stmt->bind_param("ss", $event, $vote);
					$stmt->execute();
				
					}else{
                    for($x = 0; $x < $count; $x++) {   
                 $stmt = $conn->prepare("INSERT into tally (EID,AID,votes) VALUES (?, ? , ?)");
					$stmt->bind_param("sss" ,$event, $x, $v );
					$stmt->execute();
                    }
                 $stmt = $conn->prepare("UPDATE tally set votes = votes + 1 WHERE EID = ? AND AID = ?");
					$stmt->bind_param("ss", $event, $vote);
					$stmt->execute();
                        }
$stmt = $conn->prepare("SELECT  AID, votes FROM tally WHERE EID = ? ");
					$stmt->bind_param("s",$event);
					$result = $stmt->execute();
					$stmt->store_result();
					$ev = array();
					$insertvote = "";
					$count = 0;
					
                    
    
    
					//if the event already exist in the database 
					if($stmt->num_rows > 0){
						$stmt->bind_result($aid, $vo);
							
							
							while($stmt->fetch())
									{
    

								$vote = array(
								'aid'=> $aid,
								'votes'=>$vo 
									);
								array_push($ev,$vo);
								$insertvote = $insertvote.$vo."||";	
									$count++;
									}
                          
						$fp = fopen($filename,"w");
                        fputs($fp,$insertvote); 
                        
                   fclose($fp); 
                   $content = file($filename); 
					}
                     
                    $stmt->close();



//get content of textfile


//put content in array
$array = explode("||", $content[0]);


for($x = 0; $x < count($array); $x++){
    if($vote == $array[$x]){
        $array[$x] = $array[x] + 1;
    }
}
//insert votes to txt file
$insertvote = "";

for($x = 0; $x < count($array); $x++){
    if($vote == $array[$x]){
      
     $insertvote = $insertvote.$array[$x]."||";
        echo 'alert("' + $insertvote + '")';
       
    }
}
echo json_encode($array);
$total = 0;

for($x = 0; $x < count($array); $x++){
    
    $total += (int) $array[$x];
    
}
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>;


}
    
    
    }
     
</script>



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
									
									
                                $total = 0;
                               for($x = 0; $x < count($ev); $x++){
                                   $total += $ev[$x];
                               }
                                $percentage = (100*round($ev[$count]/($total),2));
                                    
                                $count++;
                                echo '<li class="col-lg-4 col-md-4  text-center">
                                            <div class="carden">
                                            <div class="card tooltiptext">'.$pdesc.'</div>
                                            <div class="circle"><span class="initials">'.substr($tname, 0, 1).'</div>
                                                
                                                <p class="d transition">'.$institution.'</p>
                                                <p class="d transition">'.$pcat.'/p>
                                                <p class="d transition">'.$pdesc.'</p>
                                                <img src="poll.gif"
                                                 width="'.$percentage.'"
                                                 height="10px" margin-bottom="10px">                                                 '.$percentage.'
                                            </div>
                                        </li> ';
									}
						$response['error'] = false; 
					   $response['message'] = 'Teams loaded successfully'; 	
						$response['teams'] = $teams;
                       // echo json_encode($teams);
                        
                        
                        
					}
                   
              
                    $stmt->close();
					
					
        ?>   
