<?php

namespace App\Helpers;

class FulltextSearch
{
    public function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            /*
            * applying + operator (required word) only big words
            * because smaller ones are not indexed by mysql
            */
            if (strlen($word) >= 1) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }
}
