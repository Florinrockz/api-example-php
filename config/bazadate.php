<?php
class BazaDate{
    //parametrii bazei de date
    private $host='localhost';
    private $bd='api';
    private $utilizator='root';
    private $parola='';
    private $con;
    //conectare la baza de date
    public function conectare(){
        $this->con=null;
        try{
            $this->con=new PDO('mysql:host='.$this->host.';dbname='.$this->bd,$this->utilizator,$this->parola);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Eroare conexiune: ".$e->getMessage();
        }
        return $this->con;
    }
}

?>