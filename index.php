<?php
require_once('config/bazadate.php');

$bd=new BazaDate();
$pdo=$bd->conectare();

if($_SERVER['REQUEST_METHOD']=="GET"){
    $sql="SELECT * FROM clienti";
    $stmt=$pdo->query($sql);
    $clienti=$stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($clienti);
}
elseif($_SERVER['REQUEST_METHOD']=="POST"){
    if($_GET['url']=="auth"){
     $post_body=file_get_contents("php://input");
     $nume=$_REQUEST['nume'];
     $prenume=$_REQUEST['prenume'];
     $telefon=$_REQUEST['telefon'];
     $email=$_REQUEST['email'];
     $adresa=$_REQUEST['adresa'];
     $localitate=$_REQUEST['localitate'];
     $tara=$_REQUEST['tara'];

     $sql="INSERT INTO clienti(nume,prenume,telefon,email,adresa,localitate,tara) 
     VALUES(:nume,:prenume,:telefon,:email,:adresa,:localitate,:tara)";
     $stmt=$pdo->prepare($sql);

     $stmt->bindParam(':nume',$nume);
     $stmt->bindParam(':prenume',$prenume);
     $stmt->bindParam(':telefon',$telefon);
     $stmt->bindParam(':email',$email);
     $stmt->bindParam(':adresa',$adresa);
     $stmt->bindParam(':localitate',$localitate);
     $stmt->bindParam(':tara',$tara);

     $stmt->execute();
     echo '{"mesaj":{"text": "Client adaugat"}}';
 }
}elseif($_SERVER['REQUEST_METHOD']=="PUT"){

    $id=$_GET['id'];
        $post_body=file_get_contents("php://input");
       // parse_str($post_body,$_PUT);
        
        $nume=$_REQUEST['nume'];
        $prenume=$_REQUEST['prenume'];
        $telefon=$_REQUEST['telefon'];
        $email=$_REQUEST['email'];
        $adresa=$_REQUEST['adresa'];
        $localitate=$_REQUEST['localitate'];
        $tara=$_REQUEST['tara'];
   
        $sql="UPDATE clienti SET 
        nume=:nume,
        prenume=:prenume,
        telefon=:telefon,
        email=:email,
        adresa=:adresa,
        localitate=:localitate,
        tara=:tara
        WHERE id=$id
        ";
        $stmt=$pdo->prepare($sql);
   
        $stmt->bindParam(':nume',$nume);
        $stmt->bindParam(':prenume',$prenume);
        $stmt->bindParam(':telefon',$telefon);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':adresa',$adresa);
        $stmt->bindParam(':localitate',$localitate);
        $stmt->bindParam(':tara',$tara);
   
        $stmt->execute();
        echo '{"mesaj":{"text": "Client modificat"}}';
    
}elseif($_SERVER['REQUEST_METHOD']=="DELETE"){
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $sql="DELETE FROM clienti WHERE id=$id";
        $stmt=$pdo->query($sql);
        $stmt->execute();
        echo '{"mesaj": {"text": "Client sters"  }}';
    }
}else{
    echo "eroare";
    http_response_code(405);
}

?>