<?php
class Date
{
    var $days = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
    var $months = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décemnbre");

    function getAll($year)
    {
        $r = array();

        $date = new DateTime($year . "-01-01");

        while ($date->format("Y") === $year)
        {
            $y = $date->format("Y");
            $m = $date->format("n");
            $d = $date->format("j");
            $w = str_replace("0", "7", $date->format("w"));
            $r[$y][$m][$d] = [$w];

            $date->add(new DateInterval("P1D"));
        }
        return $r;
    }
}

function returnDayEventsNumber ($arrayObject, $dayDate)
{
    $dayEventsArray = array();
    if(is_array($arrayObject) && count($arrayObject) > 0)
    {
        foreach($arrayObject as $key => $object)
        {
            if (date_format(new DateTime($object->getEventDate()), "Y-n-j") == $dayDate)
            {
                $dayEventsArray[] = $object;
            }
        }
    }
    return $dayEventsArray;
}
