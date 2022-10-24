<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use HeadlessChromium\BrowserFactory;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HtmlToPdfController extends Controller {

    private $browserFactory;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->browserFactory = new BrowserFactory();
    }

    public function generatePdf($name, $url) {
        $type = '.pdf';
        $headers = ['Content-Type' => $type];
        $path = 'pdf/' . $name . '.pdf';
        $response = null;
        try {
            $browser = $this->browserFactory->createBrowser();
            $page = $browser->createPage();
            $page->navigate($url)->waitForNavigation();
            $page->pdf(['printBackground' => false])->saveToFile($path);
            $response = new BinaryFileResponse($path, 200 , $headers);
        } finally {
            $browser->close();
        }

        return $response;
    }

}
