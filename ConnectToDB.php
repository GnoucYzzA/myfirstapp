<!DOCTYPE html>
<html>
<body>

<h1>DATABASE CONNECTION</h1>

<?php
ini_set('display_errors', 1);
echo "Hello Cloud computing class 0818!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-50-19-114-27.compute-1.amazonaws.com;port=5432;user=frijqdnjxfhyul;password=130311cc8090b0896c3819681b48a78ead392871f2eb7c1cfae33400bb08bb04;dbname=d4dkf9j5cvjgh4",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "SELECT * FROM student ORDER BY stuid";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>Students information:</p>';
foreach ($resultSet as $row) {
	echo $row['stuid'];
        echo "    ";
        echo $row['fname'];
        echo "    ";
        echo $row['email'];
        echo "    ";
        echo $row['classname'];
        echo "<br/>";
}

?>
</body>
</html>
