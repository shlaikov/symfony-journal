<?php

namespace AppBundle\Utils;


class Translatable
{
    protected $text;

    public function __construct($text)
    {
        $this->text = (string) $text;
    }

    public function draw()
    {
        if (!$this->isRussian($this->text)) {
            $result = $this->text;
        } else {
            $result = $this->transliterate($this->text);
        }

        $text = $this->multiExplode([
            ',', '.', ' ',
            ':', '(', ')'
        ], mb_strtolower($result));

        return implode('-', $text);
    }

    private function transliterate($text)
    {
        $cyrillic = [
            'ж',  'ч',  'щ',   'ш',  'ю', 'ы', 'а', 'б', 'в', 'г',
            'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
            'Ж',  'Ч',  'Щ',   'Ш',  'Ю', 'Ы', 'А', 'Б', 'В', 'Г',
            'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я'
        ];
        $latin = [
            'zh', 'ch', 'sht', 'sh', 'yu', '', 'a', 'b', 'v', 'g',
            'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'ya',
            'Zh', 'Ch', 'Sht', 'Sh', 'Yu', '', 'A', 'B', 'V', 'G',
            'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
            'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Ya'
        ];

        return $text ? str_replace($cyrillic, $latin, $text) : null;
    }

    private function multiExplode($delimiters, $string)
    {
        $mixed = str_replace($delimiters, $delimiters[0], $string);

        return explode($delimiters[0], $mixed);
    }

    private function isRussian($text)
    {
        return preg_match('/[А-Яа-яЁё]/u', $text);
    }
}