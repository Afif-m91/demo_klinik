<?php
class pdf {
 
    function __construct() {
        include_once APPPATH . '/third_party/fpdf181/fpdf.php';
        include_once APPPATH . '/third_party/TCPDF-6.2.26/tcpdf.php';
    }
}
?>