<?php

namespace App\Handlers;

class ControlDeskHandlers
{
    public function getInformationJsonParsed(array|object $information): array|object
    {
        try {
            if(is_array($information) && count($information)){
                foreach ($information as $register) {
                    $this->registerJsonParse($register);
                }
            }
            else{
                $this->registerJsonParse($information);
            }
            return $information;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function registerJsonParse(object $register): object
    {
        if(isset($register->control_information)) $register->control_information = json_decode($register->control_information);
        if(isset($register->image)) $register->image = json_decode($register->image);
        return $register;
    }
}
