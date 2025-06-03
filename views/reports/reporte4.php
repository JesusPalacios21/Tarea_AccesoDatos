<?php
require_once '../../vendor/autoload.php'; // Autoload de composer
require_once __DIR__ . '/../../app/models/Propietario.php'; // Modelo de la entidad Propietario

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    // Cambiamos Mascota por Propietario
    $propietario = new Propietario(); // Instancia del modelo Propietario
    $listaPropietarios = $propietario->getAll(); // Llamamos al método getAll del modelo

    ob_start();
    include_once '../contents/content-reporte4.php'; // Tu archivo HTML del reporte de propietarios
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('L', 'A4', 'es', true, 'UTF-8', array(20, 15, 15, 15));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->output('propietarios.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
