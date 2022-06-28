<?php require_once (ROOT."public/php/header.php") ?>


<main>
    <div id="main_div">
        <h1>Calendrier</h1>

        <?php

        require(ROOT."model/calendar_date.php");
        $date = new Date();
        $todayDate = new DateTime();
//        $todayDate = $todayDate->format("Y-m-d");
//        $todayDate = new DateTime($todayDate);
        $todayTimestamp = $todayDate->getTimestamp();
        $year = date_format(new DateTime($viewDate), "Y");
        $dates = $date->getAll($year);
        ?>

        <div class="calendar">
            <div class="year">
                <a href="<?= WEBROOT ?>Event/calendar/<?= $year - 1 ?>-01"><?= $year - 1 ?></a>
                <?= $year ?>
                <a href="<?= WEBROOT ?>Event/calendar/<?= $year + 1 ?>-01"><?= $year + 1 ?></a>
            </div>
            <div class="months">
                <ul>
                    <?php foreach ($date->months as $id=>$m) : ?>
                    <li><a href="#" id="link_month_<?= $id+1 ?>"><?= utf8_encode(substr(utf8_decode($m), 0, 3)) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="clear"></div>
            <?php $dates = current($dates); ?>
            <?php foreach ($dates as $m=>$days) : ?>
            <div class="month" id="month_<?= $m ?>">
                <table class="calendar_table">
                    <thead>
                        <tr>
                            <?php foreach ($date->days as $d) : ?>
                            <th><?= substr($d, 0 ,3) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php $end = end($days); foreach ($days as $d=>$w) : ?>
                        <?php
                        $dayDate = $year.'-'.$m.'-'.$d;
                        $dayDateFormatted = new DateTime($dayDate);
                        $dayTimestamp = $dayDateFormatted->getTimestamp();
                        ?>
                            <?php if ($d == 1 && $w[0] != 1) : ?>
                                <td colspan="<?= $w[0] - 1 ?>" class="padding_array"></td>
                            <?php endif; ?>
                        <div class="relative">
                            <?php
                            $dayEventsArray = returnDayEventsNumber($yearEvents, $dayDate);
                            $dayEventsNumber = count($dayEventsArray);


                            if ($dayEventsNumber > 0)
                            {
                                if ($dayEventsNumber === 1)
                                {
                                    if ($dayTimestamp === $todayTimestamp)
                                    {
                                        echo '<div class="day"><td class="calendar_td today"><div><p>' . $d . '</p><a href="' . WEBROOT . 'Event/main/' . date_format(new DateTime($dayDate), "Y-m-d") . '" title="' . $dayEventsNumber . ' Partie">' . $dayEventsNumber . '</a></div></td></div>';
                                    }
                                    else
                                    {
                                        echo '<div class="day"><td class="calendar_td"><div><p>' . $d . '</p><a href="' .WEBROOT . 'Event/main/' . date_format(new DateTime($dayDate), "Y-m-d") . '" title="' . $dayEventsNumber . ' Partie">' . $dayEventsNumber . '</a></div></td></div>';
                                    }
                                }
                                else
                                {
                                    if ($dayTimestamp === $todayTimestamp)
                                    {
                                        echo '<div class="day"><td class="calendar_td today"><div><p>' . $d . '</p><a href="' . WEBROOT . 'Event/main/' . date_format(new DateTime($dayDate), "Y-m-d") . '" title="' . $dayEventsNumber . ' Parties">' . $dayEventsNumber . '</a></div></td></div>';
                                    }
                                    else
                                    {
                                        echo '<div class="day"><td class="calendar_td"><div><p>' . $d . '</p><a href="' . WEBROOT . 'Event/main/' . date_format(new DateTime($dayDate), "Y-m-d") . '" title="' . $dayEventsNumber . ' Partie">' . $dayEventsNumber . '</a></div></td></div>';
                                    }
                                }
                            }
                            elseif ($dayTimestamp > $todayTimestamp)
                            {
                                echo '<div class="day"><td class="calendar_td"><div><p>'.$d.'</p><a href="'.WEBROOT.'Event/main/'.date_format(new DateTime($dayDate), "Y-m-d").'" title="' . $dayEventsNumber . ' Partie">'.$dayEventsNumber.'</a></div></td></div>';
                            }
                            elseif ($dayTimestamp === $todayTimestamp)
                            {
                                echo '<div class="day"><td class="calendar_td today"><div><p>' . $d . '</p><a href="' . WEBROOT . 'Event/main/' . date_format(new DateTime($dayDate), "Y-m-d") . '" title="' . $dayEventsNumber . ' Partie">' . $dayEventsNumber . '</a></div></td></div>';
                            }
                            else
                            {
                                echo '<div class="day"><td class="calendar_td"><div><p>' . $d . '</p><span>' . $dayEventsNumber . '</span></div></td></div>';
                            }

                            ?>

    <!--                        <div class="day"><td>--><?//= $d ?><!--<br/>--><?//= $dayEventsNumber ?><!--</td></div>-->
                        </div>
                        <div class="calendar_day_events_popup" style="display: none">
                            <?php

                            if ($dayEventsNumber > 0)
                            {
                                echo '<a href="'.WEBROOT.'Event/main/'.date_format(new DateTime($dayDate), "Y-m-d").'">Il y a '.$dayEventsNumber.' évènements ce jour.</a>';
                            }

                            ?>
                        </div>
                            <?php if ($w[0] == 7) : ?>
                                </tr><tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($end[0] != 7) :?>
                            <td colspan="<?= 7 - $end[0] ?>" class="padding_array"></td>
                        <?php endif; ?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<button class="return_button warning" type="button" value="Retour" onclick="history.back()">Retour</button>
</main>
