<?php

namespace Tests\Unit;

use App\GeneratePdf\Php\HtmlToPdf;
use PHPUnit\Framework\TestCase;

class GeneratePdfFromHtmlPageTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_generate_pdf_file()
    {
        //Given
        $htmlCode = new HtmlToPdf();
        $status = $htmlCode->buildPdf();
        $this->assertTrue($status);
    }


}