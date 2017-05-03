@extends('layouts.app')

@section('content')

    <?php
    use App\Booking;
    use App\carmodel;
    ?>
    <?php
    define('NMODEL', 6);
    define('COLORMAX', 8);
    $codelist = array("EL", "ELL", "SU", "QX", "GSX", "GS41");//6 model!
    $modellist = array("New Mirage", "Attrage", "ALL NEW TRITON", "ALL NEW PAJERO", "Delica Space Wagon", "Lancer EX");//8 model
    $colorlist[0] = array("P57", "M09", "T69", "U17", "W54", "X08", " ", " ", " ");//New Mirage
    $colorlist[1] = array("A66", "P57", "T69", "U17", "W54", "X08", " ", " ", " ");//Attrage
    $colorlist[2] = array("C06", "D23", "F27",awawfwdfrrr "U17", "U25", "W32", "W54", "X08");//ALL NEW Triton
    $colorlist[3] = array("C17", "U17", "U25", "W54", "X08", " ", " ", " ", " ");//ALL NEW Pajero
    $colorlist[4] = array("W23", "X37", " ", " ", " ", " ", " ", " ", " ");//Delica
    $colorlist[5] = array("A02", "A66", "P19", "U17", "W54", "X08", " ", " ", " ");//Lancer EX
    ?>

    <div class="container">
        <div class="row">
                    <?php
                    for ($list=0;$list<NMODEL ;$list++){
                            $result = Booking::join('carmodel',function ($join) {
                                $join->on('booking.car_code1', '=', 'carmodel.car_code1')
                                    ->on('booking.opt', '=', 'carmodel.opt')
                                    ->on('booking.year', '=', 'carmodel.year');
                            })->where('SOLD',0)
                             ->where('car_code2',$codelist[$list])->where('SHOW1',1)->get();
                            echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
                            echo '<tr class="Head2">';
                            echo '<th colspan="3" align="center" scope="col">'.$modellist[$list].'</th>';
                            echo '<th colspan="7" align="left" scope="col">รวม '.$result->count().' คัน</th>';
                            echo '</tr>';
                            echo '<tr bgcolor="#FF3333" class="title">';
                            echo '<td width="15%" align="center" valign="middle">รุ่น</td>';
                            echo '<td width="7%" align="center" valign="middle">รหัสย่อ</td>';
                            echo '<td width="24%" align="center" valign="middle">ลายละเอียด</td>';
                            echo '<td width="4%" align="center" valign="middle">ปี</td>';
                            echo '<td width="10%" align="center">ราคา</td>';
                             for ($colori=0;$colori <COLORMAX;$colori++){
                                echo '<td width="5%" align="center">'. $colorlist[$list][$colori].'</td>';
                             }
                            echo '</tr>';
                            $modelsql = carmodel::where('car_code2',$codelist[$list])->orderBy('classify','ASC')->get();

                            $bgcolori=0;
                            foreach ($modelsql as $data) {
                                if ($data->SHOW1){
                                  $bgcolori++;
                                    if ($bgcolori%2==1) $bgcolormodel = 'class = "Head3"';
                                    else $bgcolormodel = 'class = "Head4"';

                                echo '
                                <tr '.$bgcolormodel.'>

                                <td align="center" valign="middle">'.$data->car_code1.'</td>
                                <td align="center" valign="middle">'.$data->car_code3.'</td>
                                <td align="center" valign="middle">'.$data->model_name.'</td>
                                <td align="center" valign="middle">'.$data->year.'</td>
                                <td align="center" valign="middle">'.$data->price.'</td>
                                ';

                                for ($colorj=0;$colorj <COLORMAX;$colorj++){

                                    $sqlselect2 = Booking::where('car_code1',$data->car_code1)->where('car_color',$colorlist[$list][$colorj])->where('opt',$data->opt)->where('year',$data->year)->where('SOLD',0);
                                    $numsqlbooking = $sqlselect2->count();
                                    echo '<td align="center" class="number">';
                                    echo '<div>';
                                    if ($colorlist[$list][$colorj]!=" "){
                                        echo '<a href="booking.php/'.$data->car_code1.'/'.$colorlist[$list][$colorj].'/'.$data->opt.'/'.$data->year.'/'.$list.'">'.$numsqlbooking.'</a>
                                        </div>
                                        </td>
                                        ';//show number booking
                                    } //end of check empty color
                                    else {

                                        echo '</div>';
                                        echo '</td>';
                                    }
                                 }
                                echo '</tr>';
                                }

                            }
                            echo '</table>';
                         }

                        ?>

    </div>
    </div>
@endsection
