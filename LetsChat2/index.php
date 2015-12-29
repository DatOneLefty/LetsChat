
<head>  <title>  
    </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<?php
if ($_GET['ID'] == "") {
 ?>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Username Plz!</h4>
        </div>
        <div class="modal-body">
          <p>You need a username.</p>
            <p>add &ID=USERNAME_YOUR_CHOOSING to the end of the address, change USERNAME_YOUR_CHOOSING to what you want</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<script>
    function loadRun() {
$("#myModal").modal();
    }
    setInterval(loadRun, 1);
</script>
<?php
}
?>
<body onload="getChat(); setInterval(getChat, 2500);">
        <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">LetsChat</a>
        <a class="navbar-brand" href="#">Version 2.1.2 Alpha</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">room <?php echo $_GET['PID']; ?></a></li>
          <li class="active"><a href="#">signed in as <?php echo $_GET['ID']; ?></a></li>
      </ul>
    </div>
  </div>
</nav>
    <br>
    <br>
    <br>
<?php
$username = $_GET['ID'];
$room = $_GET['PID'];
$file = "Room/".$_GET['PID'];
$toadd =  $_POST['texttoadd'];
//checker
 if (strpos($toadd,'>') != false) {
    $deny = true;
}
if (strpos($toadd,'<') != false) {
    $deny = true;
} 
    if ($toadd == "@cls") {
    file_put_contents($file, $username . " cleared the chat and put it in a <img src='https://cdn01.gitter.im/_s/ce5803b/images/emoji/package.png' style='width:12px;height:12px;'></img><br>\n");
        $deny = true;
}
    if (strlen($toadd) > 150) {
        $deny = true;
    }
// end checker
// emoji finder
$toadd = str_replace(":package:", "<img src='https://cdn01.gitter.im/_s/ce5803b/images/emoji/package.png' style='width:12px;height:12px;'></img>", $toadd);

$toadd = str_replace(":cake:", "<img src='https://cdn01.gitter.im/_s/ce5803b/images/emoji/cake.png' style='width:12px;height:12px;'></img>", $toadd);

$toadd = str_replace(":)", "<img src='https://cdn01.gitter.im/_s/ce5803b/images/emoji/smile.png' style='width:12px;height:12px;'></img>", $toadd);

$toadd = str_replace(":(", "<img src='https://cdn01.gitter.im/_s/ce5803b/images/emoji/worried.png' style='width:12px;height:12px;'></img>", $toadd);

$toadd = str_replace(":fire:", "<img src='https://cdn01.gitter.im/_s/ce5803b/images/emoji/fire.png' style='width:12px;height:12px;'></img>", $toadd);

$toadd = str_replace(":cactus:", "<img src='https://cdn01.gitter.im/_s/ce5803b/images/emoji/cactus.png' style='width:12px;height:12px;'></img>", $toadd);

$toadd = str_replace(":poop:", "<img src='https://cdn01.gitter.im/_s/ce5803b/images/emoji/poop.png' style='width:12px;height:12px;'></img>", $toadd);
//end finder
$toadd = "   ". $username . ": " . $toadd;
if ($deny != true) {
file_put_contents($file, file_get_contents($file). date("h:i:s"). $toadd ."<br>\n");
}
else
{ 
    echo "Error on input";
}
?>
    <script>
function getChat() {
window.scrollTo(0,document.body.scrollHeight);
jQuery.get('<?php echo "Room/".$_GET['PID']; ?>', function(data) {
    document.getElementById("chatbox").innerHTML = data;
});
}
</script>
<p id="chatbox"></p>
<form action="index.php?PID=<?php echo $_GET['PID']. "&ID=" . $_GET['ID']; ?>" method="post">

<div class="form-group">
      <label for="pwd"></label>
      <input type="text" class="form-control" placeholder="Chat to send" name="texttoadd">
    </div>
<center><button type="submit" class="btn btn-default">Chat</button></center>
</form>
    To make your own room, change the value PID to what you want<br>
    Example: datonelefty.gwiddle.co.uk/LetsChat2?PID=mychatname&ID=yourusername
</body>