@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{$colorarray}}
        <?php

            foreach ($bookingshow as $data) {
                echo $data->car_code1.'<BR\>';
                }

            ?>
        </div>
    </div>
@endsection