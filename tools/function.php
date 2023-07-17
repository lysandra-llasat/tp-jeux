<?php

function validate($data)
{
    $data = trim($data); //trim supprime les espaces 
    $data = stripslashes($data); //stripslashes supprime les antislashs
    $data = htmlspecialchars($data); //htmlspecialchars converti les caractere spéciaux
    return $data; //function générique pour protégé les input (au cas ou une personne veux rentre des ligne de code)
}
