<?php
function supprime_accents($chaine)
{
    $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
    $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
    return(strtr($chaine,$tofind,$replac));
}
function makeAroute($chaine)
{
    $tmp = supprime_accents($chaine);
    $tmp = str_replace(' ','-',$tmp);
    return($tmp);
}