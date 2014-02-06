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

Then register it normally in you app/AppKernel.php :
```php
  // ...
  new Obtao\Bundle\Html2PdfBundle\ObtaoHtml2PdfBundle(),
```

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
	$pdfData = $this->get('obtao.pdf.generator')->outputPdf($content,array('font'=>'Georgia','format'=>'L'));

	$response = new Response($pdfData);
	$response->headers->set('Content-Type', 'application/pdf');

	return $response;
}
```

The HTML2PDF library needs some rules to be respected :

- No <header> tag
- The <html> tag should be replaced by <page> (the bundle handles it)
- Style needs to be defined directly in the page (and every css rules are not supported...)
- The assets path need to be adapted (see below)

Here is an example :

```html
<page>
	<style type="text/css">
		#hello{
			color: #002549;
			font-family: Helvetica, sans-serif;
			text-align:center;
			font-size: 40px;
		}
	</style>

	<div id="hello">

		<div style="position:absolute;top:0;left:0;z-index:1;opacity:0.6;">
			Hello you!
			<img style="opacity:0.6;" src="{{ web_path~asset('/bundles/obtaosomebundle/images/greet.png') }}" alt="background" />
		</div>

	</div>
</page>
```

Note: the web_path variable is defined in the app/config/config.yml file :

```yaml
twig:
    globals:
        web_path: %kernel.root_dir%/../web
```



## Credits

Html2PdfBundle has been originally developed by [Obtao](http://obtao.com).
