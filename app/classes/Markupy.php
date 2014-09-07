<?php

class Markupy
{
    public static function deparse($txt, $engine='custom')
    {
        $txt = self::_deparseCode($txt);
        $txt = self::_deparseStrong($txt);
        $txt = self::_deparseItalic($txt);
        $txt = self::_deparseStriked($txt);
        $txt = self::_deparseUnderline($txt);
        $txt = self::_deparseH1($txt);
        $txt = self::_deparseH2($txt);
        $txt = self::_deparseH3($txt);
        $txt = self::_deparseBr($txt);
        return $txt;
    }

    public static function parse($txt, $engine='custom')
    {
        $txt = self::_parseCode($txt);
        $txt = self::_parseStrong($txt);
        $txt = self::_parseItalic($txt);
        $txt = self::_parseStriked($txt);
        $txt = self::_parseUnderline($txt);
        $txt = self::_parseH1($txt);
        $txt = self::_parseH2($txt);
        $txt = self::_parseH3($txt);
        return self::_nonPrenl2br($txt);
    }

    private static function _parseH1($str='') {
        $pattern = '#\=\=\=\=(.+?)\=\=\=\=#s';
        $replace = "<h1>\\1</h1>";

        return preg_replace($pattern, $replace, $str);
    }

    private static function _deparseH1($str='') {
        return str_replace(array('<h1>', '</h1>'), '====', $str);
    }

    private static function _parseH2($str='') {
        $pattern = '#\=\=\=(.+?)\=\=\=#s';
        $replace = "<h2>\\1</h2>";

        return preg_replace($pattern, $replace, $str);
    }

    private static function _deparseH2($str='') {
        return str_replace(array('<h2>', '</h2>'), '===', $str);
    }

    private static function _parseH3($str='') {
        $pattern = '#\=\=(.+?)\=\=#s';
        $replace = "<h3>\\1</h3>";

        return preg_replace($pattern, $replace, $str);
    }

    private static function _deparseH3($str='') {
        return str_replace(array('<h3>', '</h3>'), '==', $str);
    }

    private static function _parseStrong($str='') {
        $pattern = '#\*\*\*(.+?)\*\*\*#s';
        $replace = "<strong>\\1</strong>";

        return preg_replace($pattern, $replace, $str);
    }

    private static function _deparseStrong($str='') {
        return str_replace(array('<strong>', '</strong>'), '***', $str);
    }

    private static function _parseItalic($str='') {
        $pattern = '#\|\|\|(.+?)\|\|\|#s';
        $replace = "<em>\\1</em>";

        return preg_replace($pattern, $replace, $str);
    }

    private static function _deparseItalic($str='') {
        return str_replace(array('<em>', '</em>'), '|||', $str);
    }

    private static function _parseStriked($str='') {
        $pattern = '#\-\-\-(.+?)\-\-\-#s';
        $replace = "<s>\\1</s>";

        return preg_replace($pattern, $replace, $str);
    }

    private static function _deparseStriked($str='') {
        return str_replace(array('<s>', '</s>'), '---', $str);
    }

    private static function _parseUnderline($str='') {
        $pattern = '#\+\+\+(.+?)\+\+\+#s';
        $replace = '<span style="text-decoration: underline;">\\1</span>';

        return preg_replace($pattern, $replace, $str);
    }

    private static function _deparseUnderline($str='') {
        return str_replace(array('<span style="text-decoration: underline;">', '</span>'), '+++', $str);
    }

    private static function _parseCode($str='') {
        $pattern = '#\@=([a-zA-Z0-9]+)(.+?)\@#s';
        $replace = '<pre><code class="\\1">\\2</code></pre>';

        $str = preg_replace($pattern, $replace, $str);
        $pattern2 = '#\@(.+)\@#s';
        $replace2 = '<pre><code>\\1</code></pre>';
        return preg_replace($pattern2, $replace2, $str);
    }

    private static function _deparseCode($str='') {
        $pattern = '#<pre><code class="(.+?)">(.+?)<\/code><\/pre>#s';
        $replace = '@=\\1 \\2 @';
        $str = preg_replace($pattern, $replace, $str);

        $pattern2 = '#<pre><code>(.+?)<\/code><\/pre>#s';
        $replace2 = '@ \\1 @';
        return preg_replace($pattern2, $replace2, $str);
    }

    private static function _nonPrenl2br($string){
        $string = str_replace("\n", "<br />", $string);
        if(preg_match_all('/\<pre\>(.*?)\<\/pre\>/', $string, $match)){
            foreach($match as $a){
                foreach($a as $b){
                    $string = str_replace('<pre>'.$b.'</pre>', "<pre>".str_replace("<br />", "", $b)."</pre>", $string);
                }
            }
        }
        return $string;
    }

    private static function _deparseBr($str){
        return str_replace("<br />", "", $str);
    }
}