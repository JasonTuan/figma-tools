<?php
namespace Jasontuan\FigmaImport;

require_once "../vendor/autoload.php";

use Jasontuan\FigmaImport\Services\DataService;
use Jasontuan\FigmaImport\Services\Utility;
use Jasontuan\FigmaImport\Services\Constants;

$exportFile = "../exports/MudBlazor.tokens.json";

// https://design-tokens.github.io/community-group/format/
// ---------------------------------------------------------------
$paletteDataService =  new DataService("../data/Palette.txt");
$paletteLight = [];
$paletteDark = [];
foreach ($paletteDataService->readDataByLine() as $line) {
    if (!preg_match(Constants\PATTERN_PALETTE, $line)) {
        continue;
    }
    preg_match(Constants\PATTERN_PALETTE, $line, $parts);
    $value = Utility::formatColor(trim($parts[1]));
    $value2 = Utility::formatColor(trim($parts[2]));
    $alias = trim($parts[3]);

    switch (true)
    {
        case preg_match(Constants\PATTERN_NUMBER_VALUE, $value):
            $paletteLight[$alias] = [
                "\$type" => "number",
                "\$value" => (float)$value,
            ];
            break;
        default:
            $paletteLight[$alias] = [
                "\$type" => "color",
                "\$value" => $value,
            ];
            break;
    }
}

// ---------------------------------------------------------------
$shadowsDataService =  new DataService("../data/Shadows.txt");
$shadows = [];
foreach ($shadowsDataService->readDataByLine() as $line) {
    if (!preg_match(Constants\PATTERN_SHADOWS, $line)) {
        continue;
    }
    preg_match(Constants\PATTERN_SHADOWS, $line, $parts);
    $value = trim($parts[1]);
    $alias = trim($parts[2]);
    $shadows[$alias] = [
        "\$type" => "string",
        "\$value" => $value,
    ];
}

// ---------------------------------------------------------------
$layoutPropertiesDataService =  new DataService("../data/LayoutProperties.txt");
$layoutProperties = [];
foreach ($layoutPropertiesDataService->readDataByLine() as $line) {
    if (!preg_match(Constants\PATTERN_LAYOUT_PROPERTIES, $line)) {
        continue;
    }
    preg_match(Constants\PATTERN_LAYOUT_PROPERTIES, $line, $parts);
    $value = trim($parts[1]);
    $alias = trim($parts[2]);
    $layoutProperties[$alias] = [
        "\$type" => "string",
        "\$value" => $value,
    ];
}

// ---------------------------------------------------------------
$typographyDataService =  new DataService("../data/Typography.txt");
$typography = [];
foreach ($typographyDataService->readDataByLine() as $line) {
    if (!preg_match(Constants\PATTERN_TYPOGRAPHY, $line)) {
        continue;
    }
    preg_match(Constants\PATTERN_TYPOGRAPHY, $line, $parts);
    $value = trim($parts[1]);
    $alias = trim($parts[2]);
    switch (true)
    {
        case preg_match(Constants\PATTERN_NUMBER_VALUE, $value):
            $typography[$alias] = [
                "\$type" => "number",
                "\$value" => (float)$value,
            ];
            break;
        default:
            $typography[$alias] = [
                "\$type" => "string",
                "\$value" => $value,
            ];
            break;
    }
}

// ---------------------------------------------------------------
$zIndexDataService =  new DataService("../data/ZIndex.txt");
$zIndex = [];
foreach ($zIndexDataService->readDataByLine() as $line) {
    if (!preg_match(Constants\PATTERN_ZINDEX, $line)) {
        continue;
    }
    preg_match(Constants\PATTERN_ZINDEX, $line, $parts);
    $value = trim($parts[1]);
    $alias = trim($parts[2]);
    $zIndex[$alias] = [
        "\$type" => "number",
        "\$value" => $value,
    ];
}

// ===============================================================
// Export theme css variables
$theme = [
    "Palette" => $paletteLight,
    "Shadows" => $shadows,
    "LayoutProperties" => $layoutProperties,
    "Typography" => $typography,
    "ZIndex" => $zIndex,
];

file_put_contents($exportFile, json_encode($theme, JSON_PRETTY_PRINT));

echo "Export to " . $exportFile . " DONE.";
