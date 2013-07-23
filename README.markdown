# Html2PdfBundle

This bundle makes it very easy (and fun?) to generate PDF files in your Symfony2 project.
This bundle is based on the version 4.03 of the [HTML2PDF library](http://html2pdf.fr/en) which
uses the version 5.0.002 of the [TCPDF library](http://www.tcpdf.org/)


The **Bundle is heavy** but it already contains HTML2PDF and TCPDF libraries which are heavy.
If you can install whatever you want on your server, **we suggest you use the [KnpSnappyBundle](https://github.com/KnpLabs/KnpSnappyBundle)** which is light and nice, but it requires the
wkhtmltopdf library to be installed on your server.

Moreover, the HTML2PDF library **is not perfect** and some css rules are not supported. So,
whenever possible, **consider using the great KnpSnappyBundle**.

[![Build Status](https://api.travis-ci.org/obtao/Html2PdfBundle.png?branch=master)](http://travis-ci.org/obtao/Html2PdfBundle)

## Installation using [Composer](http://getcomposer.org/)

Add to your `composer.json`:

```json
{
    "require" :  {
        "obtao/html2pdf-bundle": "master-dev"
    }
}
```

## Usage

```php
<?php

// in a controller
public function generatePdfAction(){

	// ... some code

	$content = $this->renderView('ObtaoSomeBundle:Pdf:template.html.twig');
	$pdfData = $this->get('obtao.pdf.generator')->outputPdf($content);

	/* You can also pass some options.
	   The following options are available :
	   		protected $font = 'Arial'
			protected $format = 'P'
			protected $language = 'en'
			protected $size = 'A4'
	   Here is an example to generate a pdf with a special font and a landscape orientation
	*/
	$pdfData = $this->get('obtao.pdf.generator')->outputPdf($content,array('font'=>'Georgia',format'=>'L'));

	$response = new Response($pdfData);
	$response->headers->set('Content-Type', 'application/pdf');

	return $response;
}
```

## Credits

Html2PdfBundle has been originally developed by [Obtao](http://obtao.com).
