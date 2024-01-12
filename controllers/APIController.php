<?php

namespace Controller;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController 
{
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar() {

        //-> Almacena la Cita y retorna el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        //-> Almacena los Servicios con el ID de la Cita
        $id = $resultado['id'];
        $idServicios = explode( ",", $_POST['servicios'] );
        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        //-> Retornamos el ID de la Cita y un booleano
        echo json_encode( ['resultado' => $resultado] );
    }

    public static function eliminar() {
        if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
        }
    }
}