

<html>
    <body>
    <?php


// Create connection
$conn =mysqli_connect('tsmsweb.clkgrrfzqfem.us-west-2.rds.amazonaws.com', 'teamone', 'tsmsweb12', 'tsmsdb', 3306);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT teams.Tname as teamname, teams.institution as institution, projects.projectname as pname,projects.category as ptype, projects.description as pdesc  FROM teams,projects";
$result = $conn->query($sql);
$data = array();

    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

//echo '<h1>'; print_r($data); echo '</h1>';

$json_array = json_encode($data);
$conn->close();
?>
        <script>
        function renderCards() {
    
  var data = <?php echo $json_array; ?>;
  console.log("RENDERING");
  var division;
  $.each(data, function(key, value) {
   division = document.createElement("div");

    division.className = 'card transition';

   division.innerHTML= '<h2 class="d transition">'+value.institution +'</h2>\
    <p class="c">'+value.pdesc +'</p>\<div class="cta-container transition"><a href="#" class="cta"> Vote </a>/</div><div class="card_circle transition"></div>/';
    
 document.getElementById("toggle-container").append(division);
   
  });
}</script>
    </body>
</html>
