<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
       $strn = $_POST["search"];
       $i = 0;
       $count = 0;
       $chara ='y';
        $length = strlen($strn)-1;
        for($i=0;$i<strlen($strn);$i++)
       {
           if($strn[$i]==' '){
               $chara ='n';
                break;}
           if($i==$length)
           {
             if($strn[$i]=='+'){
               $chara ='n';
                break;}  
           }
           if($i<$length)
           {
             if(!is_numeric($strn[$i])&&!is_numeric($strn[$i+1])&&$strn[$i+1]=='+'&&$strn[$i]=='+'){
               $chara ='n';
                break;} 
             if(!is_numeric($strn[$i])&&!is_numeric($strn[$i+1])&&$strn[$i+1]!='+'&&$strn[$i]!='+'){
               $chara ='n';
                break;} 
           }
           if($i==$length)
           {
             if(is_numeric($strn[$i])){
               $chara ='n';
                break;}   
           }
       }
       $i=0;
       if( $chara=='y'){
         while($i<=$length) {
           if(is_numeric($strn[$count])&&$count!=$length ){    
             if(is_numeric($strn[$count])&&($strn[$count+1]=='.'))
               { 
                 if(is_numeric($strn[$count+2]))
                 {
                     $count+=2;
                     $i+=2;
                     while(is_numeric($strn[$count]))
                     {
                       $count++;
                       $i++;
                     }
                     $chara ='a';
                     break;
                 }
              else{
                  $chara ='n';
                  break;
              } 
               }
                 
           else
           {
               $chara ='a';
               $count++;
               $i++;  }}
         else if(!is_numeric($strn[$count])&&($chara=='a')&&$strn[$count]!='+')
           {
               $chara ='b';
               $count++;
               $i++;
           } 
            else if(!is_numeric($strn[$count])&&($chara=='b')&&$strn[$count]=='+'&&($count!=$length))
           {
               $chara ='a';
               $count++;
               $i++;
           }
           
          else { $chara ='n';
                 break;
               }
        }
        $i=0;
        if($chara!='n'&&$chara!='y'){
        $q = fopen("query.txt","w") or die("Unable to open file!");
        fwrite($q,"$strn");
        fclose($q);
        $q = fopen("query.txt","r") or die("Unable to open file!");
        $j =0;
        $strin='';
        $index=0;
       while($j<= strlen($strn)-1)
        {
           if(is_numeric($strn[$j]))
                 {
                if(($strn[$j+1]=='.'))
                     {
                       $strin =$strn[$j+1].$strn[$j];
                        $j+=2;
                     while(is_numeric($strn[$j]))
                     {
                       $strin.=$strn[$j];
                       $j++;
                     } }
                else{
                    $strin=$strn[$j];
                       $j++;
                }
                 $weightQ[$index++]= floatval($strin);
                 $strin='';
                   
               }
               else if(!is_numeric($strn[$j])&&($strn[$j]!='+'))
               {
                   $strin=$strn[$j];
                   $weightQ[$index++]= $strin;
                   $j++;
               }
               else{$j++;}
        
        }
        $q = fopen("query.txt","r") or die("Unable to open file!");
        $f1 =fopen("file1.txt","r") or die("Unable to open file!"); 
        $f2 =fopen("file2.txt","r") or die("Unable to open file!"); 
        $f3 =fopen("file3.txt","r") or die("Unable to open file!"); 
        $f4 =fopen("file4.txt","r") or die("Unable to open file!"); 
        $f5 =fopen("file5.txt","r") or die("Unable to open file!"); 
        $Array1= array();
        $Array2= array();
        $Array3= array();                                // arrays to store the weights of all documents
        $Array4= array();
        $Array5= array();
        $Query= array();                                // to store weights of the the query
        
        function numberofChar($f1,$char)
        {
          $count=0;
          while (! feof($f1 ))
          {
             if($char== fgetc($f1 ))
              {
              $count++;
              }
         }
         return $count;
        }
        function wspace($str)
        {
            if($str==' ')
                return true;
            else {
            return false;
            }
        }
         function fun($f1){
            $len=0;
            while(!feof($f1))
           {  
           $x = trim(fgets($f1)); 
           $s =strlen($x)-1;
           $len+=strlen($x);
           }
           return $len;
         }
          fclose($f1);
          $ind=0;
          for($i=0;$i<count($weightQ);$i++)
           {
               if($i%2!=0){
                   $s = $weightQ[$i];
                   $f1 = fopen("file1.txt","r") or die("Unable to open file!"); 
                   $n1 = numberofChar($f1,$s);
                   fclose($f1);
                   $f1 = fopen("file1.txt","r") or die("Unable to open file!");
                   $n2 = fun($f1);
                   fclose($f1);
                   $f1 = fopen("file1.txt","r") or die("Unable to open file!");
                   $Array1[$ind]=($n1/$n2);
                   fclose($f2);
                   $f2 = fopen("file2.txt","r") or die("Unable to open file!"); 
                   $n1 = numberofChar($f2,$s);
                   fclose($f2);
                   $f2 = fopen("file2.txt","r") or die("Unable to open file!");
                   $n2 = fun($f2);
                   fclose($f2);
                   $f2 = fopen("file2.txt","r") or die("Unable to open file!");
                   $Array2[$ind]=($n1/$n2);
                   $f3 = fopen("file3.txt","r") or die("Unable to open file!"); 
                   $n1 = numberofChar($f3,$s);
                   fclose($f3);
                   $f3 = fopen("file3.txt","r") or die("Unable to open file!");
                   $n2 = fun($f3);
                   fclose($f3);
                   $f3 = fopen("file3.txt","r") or die("Unable to open file!");
                   $Array3[$ind]=($n1/$n2);
                    fclose($f4);
                   $f4 = fopen("file4.txt","r") or die("Unable to open file!"); 
                   $n1 = numberofChar($f4,$s);
                   fclose($f3);
                   $f4 = fopen("file4.txt","r") or die("Unable to open file!");
                   $n2 = fun($f4);
                   fclose($f4);
                   $f4 = fopen("file4.txt","r") or die("Unable to open file!");
                   $Array4[$ind]=($n1/$n2);
                   fclose($f5);
                   $f5 = fopen("file5.txt","r") or die("Unable to open file!"); 
                   $n1 = numberofChar($f5,$s);
                   fclose($f5);
                   $f5= fopen("file5.txt","r") or die("Unable to open file!");
                   $n2 = fun($f5);
                   fclose($f5);
                   $f5 = fopen("file5.txt","r") or die("Unable to open file!");
                   $Array5[$ind]=($n1/$n2);
                   $ind++;
               } 
               
           }
           $D1 =0;
           $D2 =0;
           $D3 =0;
           $D4 =0;
           $D5 =0;
          for($i=0;$i<count($Array1);$i++)
           {
              if($i%2==0){
               $D1+=$weightQ[$i]*($Array1[$i]);
               $D2+=$weightQ[$i]*($Array2[$i]);
               $D3+=$weightQ[$i]*($Array3[$i]);
               $D4+=$weightQ[$i]*($Array4[$i]);
               $D5 +=$weightQ[$i]*($Array5[$i]);  
           }}
         $DocAr = array(
             "Document1 :"=>$D1,
             "Document2 :"=>$D2,
             "Document3 :"=>$D3,
             "Document4 : "=>$D4,
             "Document5 : "=>$D5,
             );
         
             arsort($DocAr, SORT_REGULAR);
             echo "<center>";
            foreach($DocAr as $key => $value)
            {
                echo $key. $value."<br>";
            }
             echo "</center>" ;   
         }
       else {
           echo "<center>";
           echo "Wrong Expression"."<br>"." Please enter the right expression";
           echo "</center>";
       }}
       else {
           echo "<center>";
           echo "Wrong Expression";
           echo "</center>";}
        ?>
    </body>
</html>
