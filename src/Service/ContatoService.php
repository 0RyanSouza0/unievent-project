<?php

namespace src\Service;
class ContatoService{

    public static function validarEmail($email):bool{

        if (preg_match('/^[a-zA-Z0-9._%+-]+@fatec\.sp\.gov\.br$/', $email)) {
            echo "E-mail válido da FATEC.";
            return true;
        } else {
            echo "E-mail inválido.";
            return false;   
            
        }
}
}
?>