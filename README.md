Html2PdfBundle
==============

This bundle makes it very easy (and fun) to generate PDF files in your Symfony2 project.
This bundle is based on the version 4.03 of the HTML2PDF library (http://html2pdf.fr/en) which
uses the version 5.0.002 of the library TCPDF (http://www.tcpdf.org/)


The **Bundle is heavy** but it already contains HTML2PDF and TCPDF libraries which are heavy.
If you can install whatever you want on your server, **we suggest you use the KnpSnappyBundle**
(https://github.com/KnpLabs/KnpSnappyBundle) which is light and nice, but it requires the
wkhtmltopdf library to be installed on your server.

Moreover, the HTML2PDF library **is not perfect** and some css rules are not supported. So,
whenever possible, **consider using the great KnpSnappyBundle**.

Installation
------------

Installation by Composer
~~~~~~~~~~~~~~~~~~~~~~~~

Coming soon

Usage
-----

Access the service
~~~~~~~~~~~~~~~~~~

  // in a controller
  $this->container->get('obtao.pdf.generator');

Generate a pdf from a template
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The pdf file is displayed in the browser and is not saved on the server.

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

Generate a pdf file
~~~~~~~~~~~~~~~~~~~

The pdf file is saved on the server.

Comming soon