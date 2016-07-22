<?php

class C_Solicitudes extends Controller {

    private $MldSolicitour=null;

 function __construct() {
    $this->MldSolicitour = $this->loadModel("MldSolicitour");
    // $this->listarActivas();
    // exit();
}

    public function INDEX() {
        if (isset($_SESSION["nombre"])) {
            require APP . 'view/_templates/Adm/HeaderAdm.php';
            require APP . 'view/contenido/Solicitudes/Solicitudes.php';
            require APP . 'view/_templates/Adm/footerAdm.php';
        } else {

            require APP . 'view/_templates/Login/HeaderAdmLogin.php';
            require APP . 'view/contenido/ContenidoAdmLogin.php';
            require APP . 'view/_templates/Login/footerAdmLogin.php';
        }      
    }

    public function Cantidad()
    {
        $cantidad= "" ;
        foreach ($this->MldSolicitour->CantidadSolicitudes() as  $value) {
            $cantidad.= $value;
        }
        echo json_encode( $cantidad);
    }

    public function listarActivas()
    {
     $datos = ["data"=>[]];
     $EstadosPosibles = array('Activo' => 1, 'Inactivo'=>0 );
     foreach ($this->MldSolicitour->ListarActivas() as  $value) {
         $datos ["data"][]=[
          $value->IdSolicitud,
          $value->nombre,
          $value->apellido,
          $value->Email,
          $value->Fecha,
          $value->Hora,
          $value->CantidadPersonas,
          "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>
  Launch demo modal
</button>"
         ];
     }
     echo json_encode($datos);
    }


  
}
