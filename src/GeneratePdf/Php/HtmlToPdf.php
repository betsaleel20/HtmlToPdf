<?php
namespace App\GeneratePdf\Php;

use mikehaertl\wkhtmlto\Pdf;

class HtmlToPdf extends PDF
{

    public function buildPdf(): bool
    {
        $name = "htmlToPdf_".date('d_m_Y')."_" . time() . ".pdf";

        ob_start();
        require realpath('/opt/lampp/htdocs/crinaserver/WkHtmlToPdf/src/GeneratePdf/sections/header.html');
        $header = ob_get_clean();

        ob_start();
        require realpath('/opt/lampp/htdocs/crinaserver/WkHtmlToPdf/src/GeneratePdf/sections/content.html');

        $content = ob_get_clean();

        ob_start();
        require realpath('/opt/lampp/htdocs/crinaserver/WkHtmlToPdf/src/GeneratePdf/sections/footer.html');

        $footer = ob_get_clean();

        $pdfOptions1 = [
            'enable-local-file-access' => true,
            'orientation' => 'Landscape',
            'user-style-sheet' => "file:///opt/lampp/htdocs/crinaserver/WkHtmlToPdf/src/GeneratePdf/Css/style.css",
            'outline' => true,
            'header-html' => 'file:///opt/lampp/htdocs/crinaserver/WkHtmlToPdf/src/GeneratePdf/sections/header.html',
            'header-spacing' => 10,
            'footer-font-size' => 14,
            'footer-html' => 'file:///opt/lampp/htdocs/crinaserver/WkHtmlToPdf/src/GeneratePdf/sections/header.html',
            'footer-left' => 'the footer'
            ];

        $pdfOptions2 = [
            'enable-local-file-access' => false,
            'orientation' => 'Landscape',
            'user-style-sheet' => "file:///opt/lampp/htdocs/crinaserver/WkHtmlToPdf/src/GeneratePdf/Css/style.css",
            'outline' => true,
            'header-spacing' => 10,
            'footer-font-size' => 14,
            'footer-left' => 'the footer'
        ];

        $footerHtml = 'file:///opt/lampp/htdocs/crinaserver/WkHtmlToPdf/src/GeneratePdf/sections/header.html';

        $option1 = [
            'header-right' => 'I am the Header put on the right',
            'title' => 'Title of the generated File',
            'page-size' => 'A4',
            'orientation'      => 'Landscape',
            'page-offset' => 2,
            'footer-left' => 'the footer(font: 10px)',
            'footer-font-size' => 10,
            'user-style-sheet' => "file:///opt/lampp/htdocs/crinaserver/WkHtmlToPdf/src/GeneratePdf/Css/style.css",
        ];

        $pdf = new Pdf();
        $pdf->addToc();
        $pdf->setOptions($option1);
        $pdf->addPage($content);
        $state = $pdf->saveAs($name);

        if(!$state){
            die(var_dump($pdf->_error));
        }

        return $pdf->_isCreated;
    }

}