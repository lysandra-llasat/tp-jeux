<?php
function get_price($game)
{
    $game = $game['prix'];

    if ($game > 0) {

        return number_format($game / 100, 2, ',', '') . '€';
    } else {
        ?> <p> GRATUIT </p> <?php

}
}

 
        ?>