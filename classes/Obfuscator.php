<?php
namespace KosmosKosmos\ContentEmailObfuscator\Classes;

class Obfuscator {

    /**
     * Obfuscates the complete input string and outputs a link
     * only good fore email-strings.
     *
     * @param $string
     *
     * @return string
     */
    public static function obfuscateEmail($string) {
        $obfuscated = '"'.str_rot13($string).'".replace(/[a-zA-Z]/g,function(c){return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);})';
        return '<span class="kkobfreverter"><script type="text/javascript">
                kosmosKosmosObfuscatorActive = true;
                document.write("<a class=\"kosmoskosmosobflink\" href=\"mailto:"+'.$obfuscated.'+"\">"+'.$obfuscated.'+"</a>");
                </script></span>';
	    // $string =str_rot13("<source src='bvlabsalödkasldjkabldkjasbld.de'></video>");
	    // var bla = {{$string}}

    }

	/**
	 * Returns JAVASCRIPT CODE instead of EMAIL Adress String
	 * @var $string - the string
	 * @return string
	 **/
	public static function obfuscate($string) {

        $matches = array();
        $pattern = '/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,5}\b/i';

        preg_match_all($pattern,$string,$matches);

        foreach ($matches[0] as $match) {

            $replace = self::obfuscateEmail($match);

            $string = str_replace($match,$replace,$string);

        }

        return $string;

	}

}