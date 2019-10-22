<?php

namespace App\Http\Traits;

trait Message
{
    //Mensagens
    public static function message($model, $message="", $exception="", $dados = "")
    {
        if(!empty($exception)){
            return (Object)['bol_success' => false, 'msg' => $message, 'exception' => ''.$model.'. ERROR: '.$exception];
        }else{
            return  (Object)['bol_success' => true, 'model' => $model,'msg' => $message, 'dados' => $dados];
        }           
    }

}
