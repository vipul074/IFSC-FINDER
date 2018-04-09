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
$bank_name=$_GET['bank_name'];
$bank2a=strtoupper($bank_name);
$bank2=explode("-",$bank2a);
$bank3=implode($bank2," ");
$state=$_GET['state'];
$state2=explode("-",$state);
$state3=implode($state2," ");
$district=$_GET['district'];
$district2=explode("-",$district);
$district3=implode($district2," ");
$branch=$_GET['branch_name'];
$branch2=explode(" ",$branch);
$branch3=implode($branch2,"-");
$sql="SELECT ifsc_code FROM `TABLE 6`  WHERE bank_name='$bank3' and state='$state3' and district='$district3' and branch_name='$branch'";
$res=mysqli_query($conn,$sql);
while($r=mysqli_fetch_array($res))
{?>
<script>
var name="<?php echo $_GET['bank_name'];?>";
var name2="<?php echo $_GET['state'];?>";
var name3="<?php echo $_GET['district'];?>"
var name4="<?php echo $branch3;?>";
var name5="<?php echo $r['ifsc_code'];?>";
window.location="./"+name+"/"+name2+"/"+name3+"/"+name4+"-"+name5;
</script>
<?php
}
//echo $result;
?>
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