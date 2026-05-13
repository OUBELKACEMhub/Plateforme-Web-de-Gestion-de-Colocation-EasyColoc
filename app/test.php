


   <?php


   interface Notifiable{
    
   public function envoyer(string $message): void;
    
   }

   abstract class Utilisateur{

   protected $nom;
   protected $email;

   public function __construct($nom,$email){
     $this->nom=$nom;
     $this->email=$email;
   }

   }


   class Colocataire  extends Utilisateur implements  Notifiable{
        
     
     public function __construct($nom,$email){
     parent::__construct($nom,$email);
   }

   public function envoyer(string $message):void{
    echo $message;
   }


   }

$obj=new Colocataire("ahmed","ahmed@mail.com"); 
$obj->envoyer("ahmed");


