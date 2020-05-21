@extends('main')
@section('content')


<?php
date_default_timezone_set('Europe/Warsaw');
setlocale(LC_ALL, 'pl', 'pl_PL', 'pl_PL.ISO8859-2', 'Polish');
$duration=50;
$cleanup=0;
$start =$vet->TimeStart;
$end =$vet->TimeEnd;
function timeslots($duration,$cleanup,$start,$end){
$start =new DateTime($start);
$end=new DateTime($end);
$interval=new DateInterval("PT".$duration."M");
$cleanupInterval=new DateInterval("PT".$cleanup."M");
$slots = array();
for($intStart=$start;$intStart<$end;$intStart->add($interval)->add($cleanupInterval)){
    $endPeriod= clone $intStart;
    $endPeriod->add($interval);
    if($endPeriod>$end){
    break;
    }
    $slots[]=$intStart->format("H:i")."-".$endPeriod->format("H:i");
}
return $slots;
}



/////////////////////////////////////////////////////////
$dt = new DateTime();
if (isset($_GET['year']) && isset($_GET['week'])) {
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    $dt->setISODate($dt->format('o'), $dt->format('W'));
}
$year = $dt->format('o');
$week = $dt->format('W');
$month=$dt->format('M');
$year=$dt->format('Y');

$tempdt=clone $dt;
function polish_month($month)
{
$month = substr($month, 0, 3);
$months = array('Styczeń' => 'Jan', 'Luty' => 'Feb', 'Marzec' => 'Mar','Kwiecień' => 'Apr', 'Maj' => 'May', 'Czerwiec' => 'Jun', 'Lipiec' => 'Jul', 'Sierpień' => 'Aug', 'Wrzesień' => 'Sep', 'Październik' => 'Oct', 'Listopad' => 'Nov', 'Grudzień' => 'Dec'); 
$m = array_search($month, $months);
return $m;
}




?>


<!--Next week-->

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <center>
                <h2><?php echo polish_month($month) ." ". $year ?></h2>
                <a class="btn btn-primary btn-xs"
                    href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Następny tydzień</a>
            </center>


            <br><br>
            <table class="table table-bordered">
                <tr class="success">

                    <?php


    do {
    $konwersja['Monday'] = 'poniedziałek';
     $konwersja['Tuesday'] = 'wtorek';
     $konwersja['Wednesday'] = 'środa';
     $konwersja['Thursday'] = 'czwartek';
     $konwersja['Friday'] = 'piątek';
     $konwersja['Saturday'] = 'sobota';
     $konwersja['Sunday'] = 'niedziela';
     $dzientygodnia=$dt->format('l');
if($dt->format('d M Y')==date('d M Y')){

    echo "<td class='bg-info'>" . $konwersja[$dzientygodnia] ."<p>" . $dt->format('d.m');  " </p></td>\n";
}else{echo "<td>" . $konwersja[$dzientygodnia] . "<p>" . $dt->format('d.m');  " </p></td>\n";}



        $dt->modify('+1 day');
    } while ($week == $dt->format('W'));
    ?>
                </tr>
                <?php
                $timeslots=timeslots($duration,$cleanup,$start,$end);



                function testTime($ts,$date,$reservations){

            foreach($reservations as $reservation){
                if($reservation->day==$date && $reservation->hour==$ts ){
                return true;
                }
                    }
                    return false;
                }


                $temp = clone $tempdt;
                foreach($timeslots as $ts){
                    $day = clone $temp;

                    ?> <tr><?php
                
                for ($i = 1; $i <= 7; $i++) {
                
                
                     if(testTime($ts,$day->format('Y-m-d'),$reservations) || $day->format('Y-m-d H:i:s') < date("Y-m-d H:i:s")){
                            ?> <td><button class="btn btn-danger btn-xs"><?php  echo $ts?></button></td>
                    <?php     }else{ ?><td><a
                            href="{{ route('ViewformReservation',['date'=>$day->format('Y-m-d'),'ts'=>$ts,'vet_id'=>$vet_id ]) }}"><button
                                class="btn btn-success btn-xs"><?php  echo $ts?></button></a></td>

                    <?php  } ?>

                    <?php  $day->modify('+ 1 day');  } ?>


                </tr>
                <?php }?>
            </table>
        </div>
    </div>

</div>





@endsection