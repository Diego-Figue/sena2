<?php

require "conexion.php";
class modeloJuego{

    public static function mdlCrearJuego($usuario,$codigo){

        session_start();

        $registro="";

        $_SESSION["partida"]=$codigo;
        $_SESSION["usuario"]=$usuario;

        $objIngreso= conexion::conectar()->prepare("INSERT into partida(codigoPartida,estado,ganador) values (:c,:e,g)");
        $objIngreso->bindParam(":c",$codigo,PDO::PARAM_STR);
        $objIngreso->bindParam(":e","Espera",PDO::PARAM_STR);
        $objIngreso->bindParam(":e","",PDO::PARAM_STR);

        if($objIngreso->execute()){

            $objIngreso= conexion::conectar()->prepare("SELECT idPartida from partida where codigoPartida=:c");
            $objIngreso->bindParam(":c",$codigo,PDO::PARAM_STR);
            $objIngreso->execute();
            $idPartida=$objIngreso->fetch();




          
            $registro = modeloJuego::IngresarNombredeUsuario($usuario,$idPartida);



        }

        return $registro;





    







    }

    public static function IngresarNombredeUsuario($usuario,$codPartida){

        $mensaje="";

        $objInsertarUsuario=conexion::conectar()->prepare("INSERT INTO usuarioPartida(nombre,idPartida,turno) values (:n,:id,:t) ");
        $objInsertarUsuario->bindParam(":n",$usuario,PDO::PARAM_STR);
        $objInsertarUsuario->bindParam(":id",$codPartida,PDO::PARAM_INT);
        $objInsertarUsuario->bindParam(":t","",PDO::PARAM_STR);

        if($objInsertarUsuario->exeute()){

            $mensaje="Partida Creada";



        }else{

            $mensaje="No se ha podido crear partida";
        }


    }



}

