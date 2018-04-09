<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
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
td
{
width:40% !important;
}
</style>
<title><?php echo $_POST['ifsc_micr'];?></title>
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
 <div class="col-lg-3" style="padding-top:35px;padding-right:0px"><strong>What is IFSC Code?</strong>
 <p style="text-align:justify">IFSC code (Indian Financial System Code) is a unique 11 digit code to identify a bank branch, participating in NEFT (National Electronic Funds Transfer) and RTGS (Real Time Gross Settlement).</p>
 <strong>What is MICR Code?</strong>
 <p style="text-align:justify">MICR code (Magnetic Ink Character Recognition Code) is 9 character long code printed on bottom of the cheque. It could include information like document type, bank code, bank account number, cheque number, cheque amount etc.</p>
 <strong>What is SWIFT Code?</strong>
 <p style="text-align:justify">SWIFT (Society for Worldwide Interbank Financial Telecommunication) code, known as BIC is a unique identification code for financial and non-financial institutions approved by the International Organization for Standardization (ISO). This code is used for inter bank/financial institution for money and messages transferring.</p>
 </div>
 <div class="col-lg-6" style="padding-top:28px">
  <div class="col-lg-12 above">
  <h4 style="color:black;margin-bottom: 22px;">Search Bank IFSC, MICR and SWIFT Code</h4>
  <h4 style="color:#015198;margin-bottom: 22px;">Details for IFSC/MICR Code: <?php echo $_POST['ifsc_micr'];?></h4><br>
   <?php
		$ifsc=$_POST['ifsc_micr'];
	$conn=mysqli_connect('localhost','root','','ifsc');
	$sql="SELECT bank_name FROM `TABLE 6` WHERE ifsc_code='$ifsc'";
	$res=mysqli_query($conn,$sql);
	$count=$res->num_rows;

	$sql2="SELECT bank_name FROM `TABLE 6` WHERE micr_code='$ifsc'";
	$res2=mysqli_query($conn,$sql2);
	$count2=$res2->num_rows;
	echo '<div  class="table-responsive">';
	if($count>0)
	{
	  $sql3="SELECT * FROM `TABLE 6` WHERE ifsc_code='$ifsc'";
	  $res3=mysqli_query($conn,$sql3);
	  echo '<table class="table">';
	  while($r=mysqli_fetch_array($res3))
	  {
		 echo '<tr><td>Bank Name</td><td>'.$r['bank_name'].'</td></tr>';
		 echo '<tr><td>Branch Name</td><td>'.$r['branch_name'].'</td></tr>';
		 echo '<tr><td>IFSC Code</td><td>'.$r['ifsc_code'].'</td></tr>';
		 echo '<tr><td>MICR Code</td><td>'.$r['micr_code'].'</td></tr>';
		 echo '<tr><td>City</td><td>'.$r['city'].'</td></tr>';
		 echo '<tr><td>District</td><td>'.$r['district'].'</td></tr>';
		 echo '<tr><td>State</td><td>'.$r['state'].'</td></tr>';
		 echo '<tr><td>Address</td><td>'.$r['bank_address'].'</td></tr>';
		 echo '<tr><td>Contact</td><td>'.$r['contact_number'].'</td></tr>';
		 
	  }
	  echo '</table>';
	}
	else if($count2>0)
	{
	  $sql3="SELECT * FROM `TABLE 6` WHERE micr_code='$ifsc'";
	  $res3=mysqli_query($conn,$sql3);
	  echo '<table class="table">';
	  while($r=mysqli_fetch_array($res3))
	  {
		 echo '<tr><td>Bank Name</td><td>'.$r['bank_name'].'</td></tr>';
		 echo '<tr><td>Branch Name</td><td>'.$r['branch_name'].'</td></tr>';
		 echo '<tr><td>IFSC Code</td><td>'.$r['ifsc_code'].'</td></tr>';
		 echo '<tr><td>MICR Code</td><td>'.$r['micr_code'].'</td></tr>';
		 echo '<tr><td>City</td><td>'.$r['city'].'</td></tr>';
		 echo '<tr><td>District</td><td>'.$r['district'].'</td></tr>';
		 echo '<tr><td>State</td><td>'.$r['state'].'</td></tr>';
		 echo '<tr><td>Address</td><td>'.$r['bank_address'].'</td></tr>';
		 echo '<tr><td>Contact</td><td>'.$r['contact_number'].'</td></tr>';
		 
	  }
	  echo '</table>';
	}
	else
	{
	  echo "Not a valid entry";
	}
    echo '</div>'

      ?>  
   
  </div>
      
 </div>
    <div class="col-lg-3" style="padding-top:35px;padding-right:0px">
		<div class="col-lg-12">
		abcdabcdabcd abcdabcdabcd abcdabcdabcd abcdabcdabcd abcdabcdabcd abcdabcdabcd
		</div>
		<div class="col-lg-12">
		123412341234 123412341234 123412341234 123412341234 123412341234 123412341234
		</div>
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