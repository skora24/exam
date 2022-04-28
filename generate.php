<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "exam";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();

for ($i =0; $i < 20; $i++){
    $random = rand(1, 1000);
    $ure = "https://picsum.photos/id/".$random."/info";
    $json = file_get_contents($ure);
    $json = json_decode($json, true);
    $picsum_id = $json['id'];
    $picsum_author = $json['author'];
    $picsum_w = $json['width']; 
    $picsum_h = $json['height'];
    $timestamp = date("Y-m-d-h-i-sa");
    $name = $faker->name(2);
    $path = 'images/'.$name.'.png';
    echo $json;
    $in = file_get_contents($json['download_url']);
    file_put_contents($path, $in);

    $sql = "INSERT INTO images (name, picsum_id, imagefile, author, width, height, added_at)
    VALUES ( '$name' , '$picsum_id' , '$name' , '$name', '$picsum_w', '$picsum_h', '$timestamp')";

    if (mysqli_query($conn, $sql)){
        echo 'git';
    }
    else{
        echo mysqli_error($conn);
    }
}d
mysqli_close($conn);
?>
