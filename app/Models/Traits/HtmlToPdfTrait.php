<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Traits;

use \App\Http\Interfaces\HtmlToPdf;
/**
 * Description of HtmlToPdf
 *
 * @author Jesonilton Pontes
 */
trait HtmlToPdfTrait
{
    public function toPdf(HtmlToPdf $html)
    {
        return $html->generatePdf();
    }

    public function allToPdf(HtmlToPdf $html)
    {
        return $html->generatePdf();
    }

}
