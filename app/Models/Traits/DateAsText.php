<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Traits;

/**
 * Description of DateAsText
 *
 * @author Jesonilton Pontes
 */
trait DateAsText
{
    private function getDataComoTexto($dataPar)
    {
        $mes = [1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho",
            7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro"];

        if (str_contains($dataPar, "/")) {
            $dataTmp = explode("/", $dataPar);
        } else {
            $dataTmp = explode("-", $dataPar);
        }

        $data["ano"] = $dataTmp[2];
        $data["mes"] = $mes[(int) $dataTmp[1]];
        $data["dia"] = $dataTmp[0];

        return (Object)$data;
    }
}
