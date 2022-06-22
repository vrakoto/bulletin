<?php


/**
 * display_error_input
 *
 * @param  string $labelTitle
 * Active le label pour l'input et lui attribue une valeur d'indication.
 * Ne rien mettre si label n'est pas nécessaire.
 * 
 * @param  string $typeInput
 * Le type de l'input.
 * Peut être remplacé par un textarea.
 * 
 * @param  array $varErrorsPHP
 * Correspond à la variable PHP (sous forme de tableau) contenant les erreurs du formulaire.
 * 
 * @param  string $varPHP
 * Correspondra à la future variable PHP qui sera récupérée par le backend PHP afin de récuperer la valeur du champ en question.
 * 
 * @param  string $idLabelAndJavascript
 * ID permettant d'associer au label et également variable utilisable côté JS.
 * Ne rien mettre si label n'est pas nécessaire.
 * 
 * @param  string $property
 * Propriétés supplémentaire pour le champ en question (falcutatif).
 * 
 * @return string
 */
function display_error_input(string $labelTitle, string $typeInput, array $varErrorsPHP, string $varPHP, string $idLabelAndJavascript, string $property = NULL): string
{
    $classInvalidField = '';
    $keepValuesError = '';

    if (!empty($varErrorsPHP[$varPHP])) {
        $classInvalidField = 'invalidField';
    } else {
        $keepValuesError = $_POST[$varPHP] ?? '';
    }

    if ($labelTitle !== '') {
        $labelElement = "<label for='$idLabelAndJavascript'>$labelTitle</label>";
    } else {
        $labelElement = '';
    }

    if ($typeInput === 'textarea') {
        $textAreaElement = "<textarea class='$classInvalidField' name='$varPHP' id='$idLabelAndJavascript'>$keepValuesError</textarea>";
    } else {
        $textAreaElement = "<input type='$typeInput' class='$classInvalidField' name='$varPHP' id='$idLabelAndJavascript' value='$keepValuesError' $property>";
    }

    return <<<HTML
    $labelElement
    $textAreaElement
HTML;
}