<?php

namespace Modules\SectionComponent\Services;

class AdminTemplateGenerator
{

    public function generateInputFields($fields)
    {
        $htmlContent = "";
        $htmlContent .= html()->span()->text('Hello world!');
        $htmlContent .= html()->img()->src('https://cdn.cookielaw.org/logos/889c435d-64b4-46d8-ad05-06332fe1d097/4353a07c-5b48-453a-b5ab-e8498c172697/IMG-ReBrand-Blue.png');
        foreach ($fields as $field) {
            switch ($field['type']) {
                default :
                    $htmlContent .= "<input type='text' name='{$field['name']}'>";
                    break;
            }
        }
        return $htmlContent;
    }
}
