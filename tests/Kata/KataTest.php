<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class KataTest extends TestCase
{
    // Creation tableau aleatoire
 function CreateLetter() {
    $ressource = ['A','B','C','D','E'];
    $letters = [];
    for ( $length = 0  ; $length < 3 ; $length++ ) 
    {
        $randomn = random_int(0,4);
        array_push($letters , $ressource[$randomn]);
    }
    return $letters;
 }
// Verification par une boucle de chaque entrée du tableau
public function verify() {
    // User input
    $firstletter = 'B';
    $secondletter = 'B';
    $thirdletter = 'B';
    // $tableau = $this->CreateLetter();
    $tableau = ['A','B','C'];
    //////////////Testing array//////////////////
    //Testing first letter
    if ( str_contains($tableau[0], $firstletter) ){
        $first = "Ok ";
    }
    else {
        for ($index=0 ; $index < 3 ; $index++) {
            if ( str_contains($tableau[$index], $firstletter)  ) {
                $first = "Presque ";
                $index= 3;
            }
            else {
                $first = "Faux ";
            }
    }
}
    //Testing Second letter
    if ( str_contains($tableau[1], $secondletter) ){
        $second = "Ok ";
    }
    else {
        for ($index=0 ; $index < 3 ; $index++) {
            if ( str_contains($tableau[$index],$secondletter)  ) {
                $second = "Presque ";
                $index= 3;
            }
            else {
                $second = "Faux ";
            }
    }
    }
    //Testing Third letter 
    if ( str_contains($tableau[2], $thirdletter) ){
        $third = "Ok ";
    }
    else {
        for ($index=0 ; $index < 3 ; $index++) {
            if ( str_contains($tableau[$index],$thirdletter)  ) {
                $third = "Presque ";
                $index= 3;
            }
            else {
                $third = "Faux ";
            }
    }
}
    if ($first == "Ok " && $second == "Ok " && $third == "Ok ") return true;
    
    else {
        $resultat = $first.$second.$third;
        return "Perdu";
    }
}
 function testLetters () {
     $result = $this->verify();
     if ( $result = true) {
        self::assertSame(true , $result);
        return true;
     }
     
    if ( self::assertContains("Faux" , $result) || (self::assertContains("Presque" , $result)  )) 
    {
        return false;
    }
      
 }

}