?php

$host		="localhost";
$username	="root";
$password	="";
$database	="ajengdb";

$koneksi = new mysqli($host, $username, $password, $database);
if ($koneksi){
	echo "database terkoneksi";
}else{
	echo "database tidak terkoneksi";
}

?>