

        <html >
<head>
  <meta charset="UTF-8">
  <title>Thank You</title>
    
    
      <link rel="stylesheet" href="../css/style.css">
<script src='http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
      <link rel="stylesheet" href="../css/reset.min.css">
    <link href = "../images/Header.png" rel="icon" type="image/png" >
  
</head>

<body>
    <?php
$servername = "localhost";
$username = "root";
$password = "TSMSWeb";
$db = "tsmsdb";

//Data
$uni = $_POST["puni"];
$mentor = $_POST["mname"];
$email = $_POST["memail"];
    
//students
$stu1 = $_POST["student1"];
$stu2 = $_POST["student2"];
$stu3 = $_POST["student3"];
$stu4 = $_POST["student4"];


//project details
$pname = $_POST["pname"];
$cat = $_POST["pcat"];
$desc = $_POST["pdesc"];
$event = $_GET["eventname"];
$prequest = $_POST["comment"];
$eventid = $_GET["eventid"];
    
// Create connection


$tname = "Team " . $uni;
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
$sql = "INSERT INTO teams (Tname, mentor, Institution, Event, pname, pcat, pdesc, memail)
VALUES ('$tname', '$mentor', '$uni','$event','$pname','$cat','$desc','$email')";
    if ($conn->query($sql) === TRUE) {
   // echo "New record created successfully";
} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "INSERT INTO students (name, team, eventid)
VALUES ('$stu1', '$tname', '$eventid')";
    if ($conn->query($sql) === TRUE) {
  //  echo "New record created successfully";
} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "INSERT INTO students (name, team, eventid)
VALUES ('$stu2', '$tname', '$eventid')";
    if ($conn->query($sql) === TRUE) {
  //  echo "New record created successfully";
} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "INSERT INTO students (name, team, eventid)
VALUES ('$stu3', '$tname', '$eventid')";
    if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "INSERT INTO students (name, team, eventid)
VALUES ('$stu4', '$tname', '$eventid')";
    if ($conn->query($sql) === TRUE) {
   // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

    if(!empty($prequest)){
$sql = "INSERT INTO request (team, email, request, event, status )
VALUES ('$tname', '$email','$prequest','$event','pending')";
    if ($conn->query($sql) === TRUE) {
    //echo "Req created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    }
$conn->close();


?>
          <div id="header" class="l-header">
            <div class="wrap">
                <header class="logo">
                    <h1 class="logo__title">
                        <a href="../index.php" class="logo__link">
                        <img src="../images/TSMSWeb.png" width="200" height="80" alt="TSMS Logo">

                        </a>
                    </h1>
                </header>
                <nav class="menu">
                    <ul class="menu__list">
                        <li class="menu__item">
                            <a href="../index.php" class="menu__link">Home</a>
                        </li><li class="menu__item">
                            <a href="../php/Projects.php" class="menu__link">Events</a>
                        </li><li class="menu__item">
                        <a href="#" class="menu__link">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

       <main class="l-main">
            <div class="wrap">
                           <main class="l-main">
            <div class="wrap">
                  <div class="divcenter">
        <h2 style="color:#000;margin-top:15px;margin-bottom:15px;text-align: center;font-size:30px; ">Thank You for registering!</h2>
                      <h3 style="color:#000;margin-top:15px;margin-bottom:15px;text-align: center;font-size:25px; ">Please check your email for the invoice to show at the university cashier!</h3>
     
          
      </div>
            </div>
  
        </main>