<?php namespace KosmosKosmos\ContentEmailObfuscator\Components;

use Cms\Classes\ComponentBase;

class Obfuscator extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Obfuscate E-Mail',
            'description' => 'Make E-Mail Adresses unreadable'
        ];
    }

}