<?php
//Este archivo funciona como un motor de renderizado
//Input (HTML) > procesar >PDF
//require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once '../../vendor/autoload.php'; //Cargamos el autoload de composer

require_once '../../app/models/Mascota.php'; //Modelo de la entidad Mascota

use Spipu\Html2Pdf\Html2Pdf; //Core = nucleo de la libreria
use Spipu\Html2Pdf\Exception\Html2PdfException; //Identificacion de excepciones
use Spipu\Html2Pdf\Exception\ExceptionFormatter;//Formateador de excepciones

try {

    $mascota = new Mascota(); //Instancia del modelo Mascota
    $listaMascotas = $mascota->getAll(); //Llamamos al metodo Listar del modelo Mascota
    ob_start();
    //include_once '../../public/css/estilos_reporte.html'; //Archivo CSS que contiene los estilos del reporte
    include_once '../contents/content-reporte3.php'; //Archivo HTML que contiene el contenido del reporte
    $content = ob_get_clean();

    //El ultimo valor son los margenes
    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(20, 15, 15, 15));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->output('mascotas.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}