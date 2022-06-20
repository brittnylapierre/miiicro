<?php 

namespace WhiteCube\Lingua;

class W3cConverter extends ComponentConverter implements ConverterInterface
{
    public static function prepare(string $string)
    {
        $string = strtolower(trim($string));
        preg_match('/^([a-z]{2,3})(?:\-([a-z]{4}))?(?:\-([a-z]{2}))?$/', $string, $matches);
        return [
            'full' => $string,
            'iso' => $matches[1] ?? null,
            'script' => self::getScriptFromPregMatch($matches),
            'country' => self::getCountryFromPregMatch($matches)
        ];
    }

    public static function format(ConverterInterface $converter)
    {
        $string = strlen($converter->iso_639_1) ? $converter->iso_639_1 : substr($converter->iso_639_3, 0, 3);
        if($converter->script->code) $string .= '-' . ucfirst($converter->script->code);
        if($converter->country->code) $string .= '-' . $converter->country->code;
        return $string;
    }
}
