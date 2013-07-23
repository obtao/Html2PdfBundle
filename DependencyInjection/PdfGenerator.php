<?php

namespace Obtao\Bundle\Html2PdfBundle\DependencyInjection;

use Obtao\Bundle\Html2PdfBundle\lib\HTML2PDF;

class PdfGenerator{
	
	protected $font = 'Arial';
	protected $format = 'P';
	protected $language = 'en';
	protected $size = 'A4';

	public function getGeneratedPdf($content, array $options = array()){
		$this->setDefaultOptions($options);

		try
	    {
	    	$html2pdf = $this->createPdf($content);
	        return $html2pdf;
	    }
	    catch(HTML2PDF_exception $e) {
	        throw new \Exception($e->getMessage());
	    }
	}

	public function generateFile($content, $filename, array $options = array()){
		$this->setDefaultOptions($options);

		try
	    {	    	
	        $html2pdf = $this->createPdf($content);
	        $html2pdf->Output($filename);
	    }
	    catch(HTML2PDF_exception $e) {
	        throw new \Exception($e->getMessage());
	    }
	}

	public function outputPdf($content, array $options = array()){
		$html2pdf = $this->getGeneratedPdf($content, $options);
		$html2pdf->Output('');
	}

	protected function createPdf($content){
		// replace the <html> tags by <page> tags
    	$content = str_replace('<html>', '<page>', $content);
    	$content = str_replace('</html>', '</page>', $content);

		$html2pdf = new HTML2PDF($this->format, $this->size, $this->language);	
        $html2pdf->setDefaultFont($this->font);
        $html2pdf->writeHTML($content);

        return $html2pdf;
	}

	protected function setDefaultOptions(array $options){
		$properties = get_object_vars($this);

		foreach($properties as $key=>$value){
			if(isset($options[$key])){
				$this->$key = $options[$key];
			}
		}
	}

}