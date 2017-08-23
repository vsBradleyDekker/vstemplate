
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css?ver=<?php echo rand();?>">
</head>
<body>
    <div class="row">
        <div class="unit_Converter columns small-12 medium-12">
            <div class="row">
                <div class="columns small-6">
                    <img src="Casio-Logo.png" width="30%">
                </div>
                <div class="columns small-2"></div>
                <div class="columns small-2"></div>
                <div class="columns small-2  top-mask bg-black">
                </div>
            </div>
            <h1 class="text-center"> Unit Calculator </h1>
            <h3 class="text-center rotate">  
            <?php
                // form logic
                if(isset($_POST["form"])){
                    if(!is_numeric($_POST['distance'])){
                        echo "no numerical value entered";

                    }
                    else{


                    switch($_POST["form"]){

                        case 'convertToDistance':
                        echo convertToDistance($_POST['distance'], $_POST['convertType']);
                        break;

                        case 'convertToWeight':
                        echo convertToWeight($_POST['distance'], $_POST['convertType']);
                        break;

                        case 'convertToTemp':
                        echo convertToTemp($_POST['distance'], $_POST['convertType']);
                        break;

                        default:
                        echo "nope";

                        break;
                    }
                }
            }
            ?>
            </h3>
            <div class="row">
                <div class="columns small-12 medium-6">
                    <form method="post">
                        <input type="hidden" value="convertToDistance" name="form" />
                        <label>ConvertDistance
                            <input type="text" placeholder="Please enter a numoric value" name="distance" value="" />
                        </label>
                        <select name="convertType" size="1" id="convertType">
                            <option disabled>Select measurement type</option>
                            <option value="kilometers">kilometers</option>
                            <option value="miles">Miles</option>
                        </select>
                        <button type="submit" value="go" class="button">Go</button>
                    </form>
                </div>
                <div class="columns medium-6">
                    <form method="post">
                        <input type="hidden" value="convertToWeight" name="form">
                        <label>ConvertWeight
                            <input type="text" placeholder="Please enter a numoric value" name="distance" value="" />
                        </label>
                        <select name="convertType" size="1" id="convertType">
                            <option disabled>Select measurement type</option>
                            <option value="kilograms">Kilogram</option>
                            <option value="pounds">Pounds</option>
                        </select>
                        
                        <button type="submit" value="go" class="button">Go</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="columns medium-6">
                    <form method="post">
                        <input type="hidden" value="convertToTemp" name="form">
                            <label>ConvertTemp
                                <input type="text" placeholder="Please enter a numoric value" name="distance" value=""/>
                            </label>
                        <select name="convertType" size="1" id="convertType">
                            <option disabled>Select measurement type</option>
                            <option value="celcius">Celcius</option>
                            <option value="farenheight">Farenheight</option>
                        </select>
                        <button type="submit" value="go" class="button">Go</button>
                    </form>
                </div>
                <div class="bg-black columns medium-6 ">
                    <img class="text-center"src="img/veale-solutions-logo.png" alt="">
                    <p class="text-right">Coded by Tom &amp; Brad</p>
                </div>
            </div>
        </div>     
    </div>
</body>

    <?php

    //Functions 
   
    function convertToDistance($distance, $convertType){
        if($convertType == "miles"){
            return($distance * 0.62);
        }
        if($convertType == "kilometers"){
            return($distance / 0.62);
        }

    }
    function convertToWeight($weight, $convertType){
        if($convertType == "kilograms"){
            return($weight * 2.202);
        }
        if($convertType == "pounds"){
            return($weight / 2.202);
        }
    }
    function convertTotemp($temp, $convertType){
        if($convertType == "celcius"){
            return($temp - 32 * 5 / 9);
        }
        if($convertType == "farenheight"){
            return($temp * 9/5 +32);
        }
        
    }
    ?>
</html>