<?php
//settings
$cache_ext  = '.html'; //file extension
$cache_time     = 3600;  //Cache file expires afere these seconds (1 hour = 3600 sec)
$cache_folder   = 'cache/'; //folder to store Cache files
$ignore_pages   = array('', '');

$dynamic_url    = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']; // requested dynamic page (full url)
$cache_file     = $cache_folder.md5($dynamic_url).$cache_ext; // construct a cache file
$ignore = (in_array($dynamic_url,$ignore_pages))?true:false; //check if url is in ignore list

if (!$ignore && file_exists($cache_file) && time() - $cache_time < filemtime($cache_file)) { //check Cache exist and it's not expired.
    ob_start('ob_gzhandler'); //Turn on output buffering, "ob_gzhandler" for the compressed page with gzip.
    readfile($cache_file); //read Cache file
    echo '<!-- cached page - '.date('l jS \of F Y h:i:s A', filemtime($cache_file)).', Page : '.$dynamic_url.' -->';
    ob_end_flush(); //Flush and turn off output buffering
    exit(); //no need to proceed further, exit the flow.
}
//Turn on output buffering with gzip compression.
ob_start('ob_gzhandler'); 
?>
   <?php
		$conn=mysqli_connect('localhost','root','','ifsc');
		$name=$_GET['bank_name'];
		$pieces=strtoupper($name);
	        $piece2=explode("-",$pieces);
	        $piece3=implode($piece2," ");
	?>
<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
$('#state').change(function(){
$('#form2').submit();
});
$("#find").click(function(){
var value=$('#ifsc_micr').val();
if(value=='')
{
alert("PLEASE INSERT IFSC/MICR CODE TO GET DETAILS");
return false;
}
else
{
  $('#filter').submit();
}
});
});
</script>
<style>
.container
{
width: 58%;
margin: 0px auto 0px 21%;
border: 1px solid silver !important;
box-shadow: 2px 2px 22px 2px silver;
padding-left: 0px;
padding-right: 0px;
}
p
{
padding-top:6px;
font-size:12px
}
strong
{
font-size:12px;
}
select
{
  width: 76%;
height: 35px;
margin-top: 12px !important;
border-radius: 7px;
border: 2px solid silver;
}
a
{
font-size: 12px;
line-height: 2;
color: #2b9208;
}
.above
{
     margin-top: 8px !important;
    width: 100%;
    border: 1px solid silver;
    text-align: center;
    border-bottom: 3px dashed rgba(43, 200, 226, 0.44) !important;
}
#filter
{
float:right;
}
.below
{
border-top:none !important;
border:1px solid silver;
}
.homer
{
margin-right: 7px;
height: 25px;
width: 56px;
padding-top: 4px;
border-radius: 7px;
font-size: 12px;
}
</style>
<title><?php echo $piece3;?> IFSC Code List Contact Number</title>
<meta content="noodp, noydir" name="robots">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta content="<?php echo $_GET['bank_name'];?> IFSC Code. Find IFSC Code List, branch address, contact phone number." name="description">
<meta content="<?php echo $_GET['bank_name'];?> IFSC Code,<?php echo $_GET['bank_name'];?>,<?php echo $_GET['bank_name'];?> branches,IFSC Code" name="keywords">
<meta name="country" content="IN">
</head>
<body>
<div class="col-lg-12">
 <div class="col-lg-12" style="background-color:#1f8eef;height:51px;padding-right:0px">
   <div class="col-lg-6">
		<h2 style="color:#ffffff;">Get IFSC Code</h2>
	  </div>
      <div class="col-lg-6" style="padding-top:20px;padding-right:0px">
     <form action="ifc_micrfinder.php" method="post" id="filter">
       <a href="index.php" class="btn btn-default homer"><b>Home</b></a><input style="border: 2px solid silver;" type="text" name="ifsc_micr" placeholder="IFSC / MICR CODE" id="ifsc_micr">
       <button id="find"><img src="images/8.png"></button>
       
     </form>
   </div>
 </div>
 <div class="col-lg-3" style="padding-top:35px;padding-right:0px">
	  <strong>What is <?php echo $piece3;?> IFSC Code?</strong>
      <p style="text-align:justify">Indian Financial System Code (IFSC) is a eleven digit code provided by the Reserve Bank of India (RBI) for identifying bank branches in India individually. This code is used for NEFT and RTGS.<br>
	  The code consists of 11 characters. The first part is the first four alphabet characters represent the Bank. Next character is zero(0), which is reserved for use in the future. The last six characters are the branch code.</p>
      <strong>What is <?php echo $piece3;?> MICR Code?</strong>
      <p style="text-align:justify">Magnetic Ink Character Recognition (MICR) is a printing technology that is used to print alpha-numeric details. MICR Code is printed on cheques and they allow the cheque to be processed easily.</p>
	  <h3 style="color:#015198;font-size:14px;"><?php echo $piece3;?> IFSC Code</h3>
	  <p style="text-align:justify"><?php echo $piece3;?> has Branches. This bank has branches in the following states. States list as follows {statelist}. Find Indian Financial System Code, Magnetic Ink Character Recognition, SWIFT Code, Address and Contact number of all Abhyudaya Co-op Bank Ltd branches.</p>
 </div>
 <div class="col-lg-6" style="padding-top:28px">
  <div class="col-lg-12 above">
		<h1 style="color:#015198;margin-bottom: 22px;font-size:22px;"><?php echo $piece3;?> IFSC Code List Contact Number</h1>
		<h2 style="color:#015198;margin-bottom: 22px;font-size:15px;">Find <?php echo $piece3;?> IFSC Code, Address list of all <?php echo $piece3;?> branches</h2>
		<p align="justify">First select your bank from the following drop-down list then select your state, now select your district and finally select the branch of your bank to find <b>IFSC Code</b/>.</p>  
		<span style="color:#015198;float: left;font-size: 11px;">Select bank name > Select State</span><br>
   <?php
		echo '<form id="form2" method="get" action="imtermediate2.php">';
		echo '<img src="images/3.png"><select name="bank_name">';
		echo '<option value="'.$name.'">'.$piece3.'</option>';
		echo '</select><img src="images/4.png"><br>';
		$sql="SELECT DISTINCT state FROM `TABLE 6` WHERE bank_name='$piece3' ORDER BY state ";
		echo '<img src="images/2.png"><select name="state" id="state"><option>Select State Name</option>';
		$res=mysqli_query($conn,$sql);
		print_r($res);
		while($r=mysqli_fetch_array($res))
		{
		  echo '<option>'.$r['state'].'</option>';
		}
		echo '</select><img src="images/5.png"><br>';
		echo '<img src="images/2.png" style="margin-left:-28px"><select><option>District</option></select><br>';
		echo '<img src="images/2.png" style="margin-left:-28px"><select><option>Branch</option></select><br>';
		echo '</form>';
      ?>  
   
  </div>
  <div class="col-lg-12 below">
  <?php
  $sql2a="SELECT DISTINCT state FROM `TABLE 6` WHERE bank_name='$piece3' ORDER BY state";
  $res2a=mysqli_query($conn,$sql2a);
  $counter=mysqli_num_rows($res2a);
  ?>
   <h4 style="text-align:center;color:rgb(1, 81, 152);"><?php echo $piece3;?> Bank is in <?php echo $counter;?> States</h4>
   <h2 style="text-align:center;color:#015198;margin-bottom: 22px;font-size:15px;">State wise list of all <?php echo $piece3;?> - NEFT (IFSC) enabled branch / branches</h2>
   <?php
    echo '<div id="detail">';
	$sql2="SELECT DISTINCT state FROM `TABLE 6` WHERE bank_name='$piece3' ORDER BY state";
	$res2=mysqli_query($conn,$sql2);
	while($p=mysqli_fetch_array($res2))
	{
	$state=$p['state'];
	$name3=explode(" ",$state);
        $name4=implode($name3,"-");

	echo '<a href="'.$name.'/'.$name4.'"><img src="images/6.png">&nbsp;'.$p['state'].'</a><br>';
	}
	echo '</div>';
  ?>
   </div>      
 </div>
    <div class="col-lg-3" style="padding-top:35px;padding-right:0px">
		<strong>What is <?php echo $piece3;?> RTGS?</strong>
      <p style="text-align:justify">Real Time Gross Settlement (RTGS) is a fund transfer mechanism which is used to transfer money from one bank to another. This gross basis transfer happens in realtime, hence the name. Minimum amount that can be transferred through RTGS is Rs. 2,00,000. Fees to process RTGS will be  applicable.</p>
	  <strong>What is <?php echo $piece3;?> NEFT?</strong>
      <p style="text-align:justify">National Electronic Fund Transfer (NEFT) is an online money transfer system which is supported by RBI. NEFT is used for medium and small amount transfer between accounts and banks. There is no minimum amount limit to send money via NEFT.</p>
	  <h4 style="color:#015198;font-size:12px;"><?php echo $piece3;?> Home Loans</h4>
	  <h4 style="color:#015198;font-size:12px;"><?php echo $piece3;?> Personal Loans</h4>
	  <h4 style="color:#015198;font-size:12px;"><?php echo $piece3;?> Car Loans</h4>
	</div>
    <div class="col-lg-12" style="background-color: rgb(31, 142, 239);padding-top: 9px;margin-bottom:-20px">
    <div class="col-lg-6" align="center">
      <ul class=gain>
        <li><a href="index.php">Home</a></li>
        <li><a href="search.php">Search by IFSC / MICR</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="help.php">Help</a></li>
        <li><a href="disclaimer.php">Disclaimer</a></li>
        <li style="border-right:none !important"><a href="privacy.php">Privacy</a></li>
      </ul>
      <style>
        ul.gain 
        {
        padding-left:0px;
        list-style-type:none;
        }
        ul.gain li{
        display: inline-block;
        margin-right: 18px;
        border-right: 2px solid white !important;
        padding-right: 5px;
        margin-right:5px;
        }
        ul.gain li a{color:white;}
        ul li a:hover{color:black;}
      </style>
    </div>
	<div class="col-lg-6" align="center">
		&copy; Copyright. <a href="/" style="color:blue;">Get IFSC Code</a>
	</div>
</div>
</body>
</html>
<?php

if (!is_dir($cache_folder)) { //create a new folder if we need to
    mkdir($cache_folder);
}
if(!$ignore){
    $fp = fopen($cache_file, 'w');  //open file for writing
    fwrite($fp, ob_get_contents()); //write contents of the output buffer in Cache file
    fclose($fp); //Close file pointer
}
ob_end_flush(); //Flush and turn off output buffering

?>