
<?php

    function showMainNavMenu(){
        global $connection;

        $queryMenu = "SELECT * FROM menu";
        $result = $connection -> query($queryMenu)->fetchAll();
        $output = "<ul>";
            foreach($result as $li){
                $output.="<li><a href=\"$li->path\">$li->title</a></li>";
            }
            if(isset($_SESSION['user']) && $_SESSION['user']->id_role == 2){
                $customer = $_SESSION['user'];
                $output.="<li><a href=\"models/logout.php\">Logout</a></li>";
                $output.="<li><a href=\"#\" class=\"korisnikIme\">CUSTOMER</a></li>";
            }else{
                $output.="<li><a href=\"index.php?page=register\">Register</a></li>";
            $output.="<li><a href=\"index.php?page=login\">Login</a></li>";
            }
            $output.="</ul>";
            return $output;
    }

    function getSocialMedia(){
        return executeQuery("SELECT * FROM social_media");
    }

    function markLogged($id, $email){
        @$open=fopen(LOGGED_CUSTOMERS_FILE,"a");
        $unos=$id."\t".$email."\t".date('d-m-Y H:i:s')."\n";
        @fwrite($open,$unos);
        @fclose($open);
    }
       
    function countLogged(){
        return count(file(LOGGED_CUSTOMERS_FILE));
    }
       
    function deleteLogged($id){
        $id=(int)$id;
        $unos="";
        @$file=file(LOGGED_CUSTOMERS_FILE);
        if(count($file)){
            foreach($file as $i){
                $iId=trim((int)$i);
    
                if($iId!=$id){
                    $unos.=$iId."\n";
                }
            }
        }
    
        @$open=fopen(LOGGED_CUSTOMERS_FILE,"w");
        @fwrite($open,$unos);
        @fclose($open);
    }
    
?>
