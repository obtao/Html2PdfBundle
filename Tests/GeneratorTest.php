<?php

namespace Obtao\Bundle\Html2PdfBundle\Tests;

use Obtao\Bundle\Html2PdfBundle\DependencyInjection\PdfGenerator;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testOutputPdf()
    {
        // Set something, else the tcpdf library cannot set the $kPathUrl variable
        $_SERVER['HTTP_HOST'] = 'something';

        $generator = new PdfGenerator();
        ob_start();
        $generator->outputPdf('<html>foo</html>',array('format'=>'L'));
        $pdfData = ob_get_contents();
        ob_end_clean();

        $this->assertTrue(preg_match('/PDF/', $pdfData) == 1 && preg_match('/EOF/', $pdfData));
    }

}