@extends('main')
@section('content')


<?php
date_default_timezone_set('Europe/Warsaw');
setlocale(LC_ALL, 'pl', 'pl_PL', 'pl_PL.ISO8859-2', 'Polish');
$duration=50;
if(!$vet->time_visit==null){

    $duration=$vet->time_visit;

}
$cleanup=0;

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




<div class="container d-flex justify-content-center " style="background-color: #eff2f8">
    <div class="row">

        <div class="col-md-12 mt-2">
<div class="row">
    <div >
      
</div>
<div class="flex-grow-1" >
            <center>
                <div class="mb-2">
                <h2><?php echo polish_month($month) ." ". $year ?></h2>

                <p><strong>Adres:</strong> {{$location->address}}, {{$location->city->name}}  </p>
               <p><strong>Weterynarz:</strong> {{$vet->name}} </p>
               <div class="row-12 d-flex justify-content-between">  <a class="btn btn-outline-primary"
                href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">Poprzedni tydzień</a>
            <a class="btn btn-outline-primary"
                href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Następny tydzień</a></div>
              
            </div>
            </center>

        </div>
            <br><br>
        </div>
            <div class="tabel d-flex">
                <?php
                
                $data=$vet->locations->first()->whenOpen;



                            
                function testTime($ts,$date,$reservations){
                  
                foreach($reservations as $reservation){
                  
                if($reservation->day==$date && $reservation->hour==$ts ){
                return true;
                }
                    }
                    return false;
                }

$i=0;
do {
    $konwersja['Monday'] = 'poniedziałek';
     $konwersja['Tuesday'] = 'wtorek';
     $konwersja['Wednesday'] = 'środa';
     $konwersja['Thursday'] = 'czwartek';
     $konwersja['Friday'] = 'piątek';
     $konwersja['Saturday'] = 'sobota';
     $konwersja['Sunday'] = 'niedziela';
     $dzientygodnia=$dt->format('l');

     $day=$data[$i]["value"];
                    $start = substr($day, 0, 5);
                    $end= substr($day,6,9);
                    $timeslots =timeslots($duration,$cleanup,$start,$end);
                    $temp = clone $tempdt;
if($dt->format('d M Y')==date('d M Y')){
    
    
    ?>

                <div class="mb-2">
                    <p class="text-primary m-2"> <?php echo $konwersja[$dzientygodnia]. " ". $dt->format('d.m') ."</p>"?>

                        <?php
        
                  if(empty($timeslots)){
                      
                    for ($y=0; $y<7; $y++) {
                        
                        
                      echo  "<div class='mb-4 mt-4' style='text-align:center'>-</div>"; 
                        
                      
                }
                  }
                     
                    foreach($timeslots as $ts){
                  
                        $day = clone $temp;

                         if(testTime($ts,$dt->format('Y-m-d'),$reservations) || $day->format('Y-m-d H:i:s') < date("Y-m-d H:i:s") || date("H:i") > $ts && $dt->format('Y-m-d') == date("Y-m-d")){
                                     ?> <div class="mb-4 mt-4" style='text-align:center'>-</div>
                        <?php     }else{ ?><div class="mb-4  mt-4"><a
                                href="{{ route('ViewformReservation',['date'=>$dt->format('Y-m-d'),'ts'=>$ts,'vet_id'=>$vet_id , 'location_id'=>$location->id ])}}"><button
                                    class="btn btn-light btn-xs"><?php  echo $ts ?></button></a></div>
                        <?php } ?>
                        <?php  } ?>







                </div><?php

}else{ ?>

                <div class=' m-2'> <?php echo $konwersja[$dzientygodnia] . " ". $dt->format('d.m') ?>

                    <?php
                
                if(empty($timeslots)){
                      
                      for ($y=0; $y<7; $y++) {
                          
                          
                        echo  "<div class='mb-4 mt-4 ' style='text-align:center'>-</div>"; 
                          
                        
                  }
                    }
                     
                    foreach($timeslots as $ts){
                        $day = clone $temp;
  
                         if(testTime($ts,$dt->format('Y-m-d'),$reservations) || $dt->format('Y-m-d H:i:s') < date("Y-m-d H:i:s")){
                                ?> <div class="mb-4 mt-4" style='text-align:center'>-</div>
                    <?php     }else{ ?><div class="mb-4 mt-4"><a
                            href="{{ route('ViewformReservation',['date'=>$dt->format('Y-m-d'),'ts'=>$ts,'vet_id'=>$vet_id,'location_id'=>$location->id  ]) }}"><button
                                class="btn btn-light btn-xs"><?php  echo $ts ?></button></a></div>
                    <?php  } ?>
                    <?php  } ?>


                </div>
                <?php
}

        $dt->modify('+1 day');
        $i++;
    } while ($week == $dt->format('W'));
    ?>




            </div>
        </div>
    </div>

</div>





@endsection