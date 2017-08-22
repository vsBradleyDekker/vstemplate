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
          <div class="columns small-12">
            <p>
              <?php
               if(isset($_POST['form'])) {
                 switch($_POST['form']) {
                    case 'kilometersConvert':
                     echo convertToMiles($_POST['kilometers'], $_POST['convertType']);
                       
                      break; 
                    case 'kilogramsConvert':
                     echo convertToPounds($_POST['kilograms']);
                        
                      break;
                    case 'celciusConvert':
                     echo convertTemp($_POST['celcius']); 
                        
                      break;  
                    default:

                    break;
                  }
                  
                }

                //Echo out results here
              ?>
            </p>
          </div>
          <div class="columns small-12 medium-6">
            <form method="post">
                <input type="hidden" value="kilometersConvert" name="form" />
                <label>Convert Distance
                <input type="text" name="kilometers" value="" />
                </label>
                <select name="convertType" id="convertType" size="1">
                  <option disabled> Select a measurement type</option>
                  <option value="kilometers">Kilometers</option>
                  <option value="miles">Miles</option>
                </select>
                <input type="submit" value="Go" class="button"/>
            </form>
          </div>
          <div class="columns small-12 medium-6">
            <form method="post">
                <input type="hidden" value="kilogramsConvert" name="form" />
                <label>Convert weight
                <input type="text" name="kilograms" value="" />
                </label>
                <select name="convertType" id="convertType" size="1">
                  <option disabled> Select a measurement type</option>
                  <option value="kilograms">Kilograms</option>
                  <option value="pounds">Pounds</option>
                </select>
                <input type="submit" value="Go" class="button"/>
            </form>
          </div>
          <div class="columns small-12 medium-6">
            <form method= "post">
              <input type= "hidden" value="cleciusConvert" name="form"
              <label>Convert Tempreture
              <input type="text" name="celcius" value="" 
              </label>
              <select name="convertType" id="convertType" size="1">
                  <option disabled> Select a measurement type</option>
                  <option value="celcius">Celcius</option>
                  <option value="farenheight">Farenheight</option>
                </select>
              <input type="submit" value="Go" class="button"/>
              </form> 
          </div>        
        
  </body>

          <?php
            function convertToMiles($distance, $convertType){
              if($convertType == "miles"){
                return ($distance * 2.20462);
              } 
              if($convertType == "kilometers"){
                return($distance / 2.20462);
              }
                
            } 
            function convertToPounds($weight,$convertType){
              if($convertType== "pounds"){
                return ($weight * 0.621371);
              } 
              if($convertType == "kilograms"){
                return($weight / 0.621371);
              }
            }
            function convertToFarenheight($temp, $convertType){
              if($convertType == "farenheight"){
                return ($celsius * 9/5 + 32);
              }  
              if($convertType == "celcius"){
                return($convertType / 9/5 - 32);  
              }             
          ?>
</html>          