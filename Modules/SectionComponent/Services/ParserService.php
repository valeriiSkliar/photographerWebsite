<?php

namespace Modules\SectionComponent\Services;

class ParserService
{
    const FIELD_PATTERN = "/{{'editable:(\w+):(\w+)'}}/";

    public function extractEditableFields($templateContent)
    {
        preg_match_all(self::FIELD_PATTERN, $templateContent, $matches, PREG_SET_ORDER);
        $fields = [];
        foreach ($matches as $match) {
            $fields[] = ['name' => $match[1], 'type' => $match[2]];
        }
        return $fields;
    }
}
