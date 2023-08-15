<?php

return [
    'color' => ['required', new \Azuriom\Rules\Color()],
    'header_description' => 'nullable|string',
    'footer_description' => 'nullable|string',
    'footer_links' => 'nullable|array',
];
