<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Unit Calculator</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/styles.css?ver=<?php echo rand();?>">
    </head>
      <body>
      <div class="row">
        <div class="unit-calculator columns small-12">
        <h1 class = "text-center">Unit Calculator</h1> 
  
        <h2 class = 'text-center'>
            <?php
              if(isset($_POST ['form'])) {
                if(!is_numeric($_POST["distance"])){
                  echo "NO!!";
                }
                else {

              
                switch($_POST ['form']) {
                  
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
          </h2>
        <div class="columns small-12 medium-12">
          <form method = "post">
            <input type = "hidden" value ="convertToDistance" name = "form"/>
              <label>Convert Distance
                <input type = "text" placeholder="enter numerical value" name = "distance"  value = ""/>
              </label>
            <select name = "convertType" id= "converttype" size = "1"> 
              <option disabled> Select a measurement type</option>
              <option value="kilometers">Kilometers</option>
              <option value="miles">Miles</option>
            </select>
            <input type="submit" value="Go" class="btn"/>
          </form>
            <hr>
            <div class= "row">
            <div class="columns small-12 medium-6">
          <form method = "post">
            <input type = "hidden" value ="convertToWeight" name = "form"/>
              <label>Convert Weight
                <input type = "text" placeholder= "enter numerical value"name = "distance"  value = ""/>
              </label>
            <select name = "convertType" id= "convertType" size = "1"> 
              <option disabled> Select a measurement type</option>
              <option value="kilograms">Kilograms</option>
              <option value="pounds">pounds</option>
            </select>
            <input type="submit" value="Go" class="button"/>
          </form>
          </div>
            <hr>
            <div class="columns small-12 medium-6">
              <form method = "post">
                <input type = "hidden" value ="convertToTemp" name = "form"/>
                  <label>Convert Tempreture
                    <input type = "text"  placeholder= "enter numerical value" name = "distance"  value = ""/>
                  </label>
                <select name = "convertType" id= "convertType" size = "1"> 
                  <option disabled> Select a measurement type</option>
                  <option value="celcius">Celcius</option>
                  <option value="farenheight">Farenheight</option>
                </select>
                <input type="submit" value="Go" class="button"/>
              </form>
              
            </div>
          </div>
        </div>
      </div>
        
      </body>
          
          
          <?php
        
          function convertToDistance($distance, $convertType) {
            
              if($convertType == "miles"){
              return($distance * 0.62);
            }
            if($convertType == "kilometers");{
              return($distance / 0.62);
            }
            
            
          }
          
          function convertToWeight($weight, $convertType){
            
            if($convertType == "pounds"){
              return($weight / 2.20462);
            }
            if($convertType == "kilograms");{
              return($weight * 2.20462);
            }
          }
          
            
          function convertToTemp($tempreture, $convertType){  
            if($convertType == "farenheight"){
              return($tempreture * 9 / 5 + 32);
            }
            if($convertType == "celcius");
              return($tempreture - 32 * 5 / 9 );
            }
              

            ?>  
</html>      
          
            
        
                     
                        
                  