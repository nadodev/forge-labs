<?php

namespace App\Helpers;

class MarkdownHelper
{
    public static function parse($text)
    {
        if (empty($text)) {
            return '';
        }

        // Converter quebras de linha para <br>
        $text = nl2br($text);
        
        // Converter headers
        $text = preg_replace('/^### (.*$)/m', '<h3>$1</h3>', $text);
        $text = preg_replace('/^## (.*$)/m', '<h2>$1</h2>', $text);
        $text = preg_replace('/^# (.*$)/m', '<h1>$1</h1>', $text);
        
        // Converter listas - versão melhorada
        $lines = explode('<br>', $text);
        $inList = false;
        $result = [];
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            if (preg_match('/^- (.*)$/', $line, $matches)) {
                if (!$inList) {
                    $result[] = '<ul>';
                    $inList = true;
                }
                $result[] = '<li>' . $matches[1] . '</li>';
            } else {
                if ($inList) {
                    $result[] = '</ul>';
                    $inList = false;
                }
                if (!empty($line)) {
                    $result[] = $line;
                }
            }
        }
        
        if ($inList) {
            $result[] = '</ul>';
        }
        
        $text = implode('<br>', $result);
        
        // Converter texto em negrito
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        
        // Converter texto em itálico
        $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);
        
        // Converter código inline
        $text = preg_replace('/`(.*?)`/', '<code>$1</code>', $text);
        
        // Limpar quebras de linha extras
        $text = preg_replace('/<br\s*\/?>\s*<br\s*\/?>/', '<br>', $text);
        
        return $text;
    }
}
