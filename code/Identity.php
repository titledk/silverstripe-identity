<?php

/**
 * Identity
 *
 * @author Anselm Christophersen <ac@anselm.dk>
 * @date   February 2016
 */
class Identity extends Object
{
    private static $colors = [];

    private static $colorsCached = [
        'hex' => null,
        'rbg' => null
    ];

    /**
     * Identify colors in either hex or rgb
     * @param string $type
     * @return array
     */
    public static function get_colors($type = 'hex')
    {
        $cached = self::$colorsCached;
        if (isset($cached[$type])) return $cached[$type];

        $colors = Config::inst()->get('Identity', 'colors');
        if ($type == 'rgb') {
            $rgbColors = [];
            foreach ($colors as $name => $c) {
                $rgbColors[$name] = self::hex2rgb($c);
            }
            $colors = $rgbColors;
        }
        self::$colorsCached[$type] = $colors;
        return $colors;
    }

    /**
     * Helper for converting a color to rbg
     * @param $hex
     * @return string
     */
    public static function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
        return "$r,$g,$b";
    }
}


