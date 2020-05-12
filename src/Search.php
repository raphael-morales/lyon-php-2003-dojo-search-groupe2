<?php declare(strict_types=1);

final class Search
{
    const DATA = ['Rocky 1', 'Rocky 2', 'My Little Pony'];

    private static $instance = null;

    private function __construct(){}

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function search(string $searchString): array
    {
        $results = [];

        // Your code should be written here
        // return results matching $searchString in self::DATA

        $searchArray = explode(' ', $searchString);

        foreach (self::DATA as $data) {
            $position = [];
            $error = FALSE;

            foreach ($searchArray as $searchWord) {
        
                if (!in_array($data, $results)) {
                    if (stristr($data, $searchWord)) {

                        // si on trouve le word, on met une position dans le tableau
                        array_push($position, stripos($data, $searchWord));
                    }
                    // si y'a plusieurs positions, on vérifie l'ordre
                    if (count($position) > 1) {
                        for($i = 1; $i<count($position); $i++) 
                        {
                            if($position[$i] < $position[$i - 1]) 
                            {   
                                // si l'ordre est pas bon, on fait une erreur
                                $error = TRUE;
                            } 
                        }
                    }
                    // si y'a une position dans $position, ce qui veut dire que word a été trouvé une fois
                    // si y'a pas d'erreur, on push
                    if (!empty($position && $error === FALSE))
                    {
                        array_push($results, $data);
                    }
                } 
            }
        }
        return $results;
    }
}
