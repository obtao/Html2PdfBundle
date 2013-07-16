<?php

namespace Obtao\Bundle\Html2PdfBundle\DependencyInjection;

use Obtao\Bundle\Html2PdfBundle\lib\HTML2PDF;

class PdfGenerator{
	
	public function generateHtml($content){
		try
	    {
	    	$content = str_replace('<html>', '<page>', $content);
	    	$content = str_replace('</html>', '</page>', $content);
	        $html2pdf = new HTML2PDF('P', 'A4', 'fr');	
	        $html2pdf->setDefaultFont('Arial');
	        $html2pdf->writeHTML($content);
	        $html2pdf->Output('');
	    }
	    catch(HTML2PDF_exception $e) {
	        throw new \Exception($e->getMessage());
	    }
	}
}