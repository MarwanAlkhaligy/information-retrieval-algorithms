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
        <form method = "POST"  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
           <center>
               <h1>Search</h1>
               <br>
               <input type="search" name="search">
               <br>
               <input type="submit"  name="s1" value="->Enter<-">
               <br>
           </center>
       </form>
        <?php
        if(isset($_POST["search"]))
       {
       $strn = $_POST["search"];
       $Nfile = 5;
       $chara ='y';
        for($i=0;$i<strlen($strn);$i++){
        if($strn[$i]==' '||$strn[$i]=='+'||is_numeric($strn[$i])|$strn[$i]=='.'||$strn[$i]=='!'||$strn[$i]=='@'||$strn[$i]=='('||$strn[$i]==')'||$strn[$i]=='+'||$strn[$i]=='-'||$strn[$i]=='*'||$strn[$i]=='{'||$strn[$i]==' }'){
               $chara ='n';
                break;
                 }
      }
        if($chara=='y'){
        $q = fopen("query.txt","w") or die("Unable to open file!");
        fwrite($q,"$strn");
        fclose($q);
        $q = fopen("query.txt","r") or die("Unable to open file!");
        
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
        $Query= array(); 
        $CounArr=array();                       // to store weights of the the query
        
        function numberofChar($f1,$char)
        {
          $count=0;
          while (! feof($f1 ))
          {
             if(!strcasecmp($char,fgetc($f1 )))
              {
              $count++;
              }
         }
         return $count;
        }
          function fun($f1,$strn)
        {
        $f1=fread($f1, filesize($strn));  
        $len=0;
        $i=0;
        $arry1=$f1; 
        for($i=0;$i<26;$i++)
         {
             $arry[$i]=0;
         }
        for($i=0;$i<strlen($arry1);$i++){
           $x = $arry1[$i];
          if('A'== strtoupper($x)||'A'== strtolower($x)){
               $arry[0]+=1;
           }else if('B'== strtoupper($x)||'B'== strtolower($x)){
               $arry[1]+=1;
           } else if('c'== strtoupper($x)||'c'== strtolower($x)){
               $arry[2]+=1;
           }else if('d'== strtoupper($x)||'d'== strtolower($x)){
               $arry[3]+=1;
           }  else if('e'== strtoupper($x)||'e'== strtolower($x)){
               $arry[4]+=1;
           }
            else if('f'== strtoupper($x)||'f'== strtolower($x)){
               $arry[5]+=1;
           }else if('g'== strtoupper($x)||'g'== strtolower($x)){
               $arry[6]+=1;
           } else if('h'== strtoupper($x)||'h'== strtolower($x)){
               $arry[7]+=1;
           } else if('i'== strtoupper($x)||'i'== strtolower($x)){
               $arry[8]+=1;
           }else if('j'== strtoupper($x)||'j'== strtolower($x)){
               $arry[9]+=1;
           }else if('k'== strtoupper($x)||'k'== strtolower($x)){
               $arry[10]+=1;
           } else if('l'== strtoupper($x)||'l'== strtolower($x)){
               $arry[11]+=1;
           } else if('m'== strtoupper($x)||'m'== strtolower($x)){
               $arry[12]+=1;
           }else if('n'== strtoupper($x)||'n'== strtolower($x)){
               $arry[13]+=1;
           }else if('o'== strtoupper($x)||'o'== strtolower($x)){
               $arry[14]+=1;
           }else if('p'== strtoupper($x)||'p'== strtolower($x)){
               $arry[15]+=1;
           }else if('q'== strtoupper($x)||'q'== strtolower($x)){
               $arry[16]+=1;
           }else if('r'== strtoupper($x)||'r'== strtolower($x)){
               $arry[17]+=1;
           }else if('s'== strtoupper($x)||'s'== strtolower($x)){
               $arry[18]+=1;
           }else if('t'== strtoupper($x)||'t'== strtolower($x)){
               $arry[19]+=1;
           }else if('u'== strtoupper($x)||'u'== strtolower($x)){
               $arry[20]+=1;
           }else if('v'== strtoupper($x)||'v'== strtolower($x)){
               $arry[21]+=1;
           }else if('w'== strtoupper($x)||'w'== strtolower($x)){
               $arry[22]+=1;
           }else if('x'== strtoupper($x)||'x'== strtolower($x)){
               $arry[23]+=1;
           }else if('y'== strtoupper($x)||'y'== strtolower($x)){
               $arry[24]+=1;
           } else if('z'== strtoupper($x)||'z'== strtolower($x)){
               $arry[25]+=1;
           } }
           for($i=0;$i<26;$i++){
               if($len<$arry[$i]){
                   $len=$arry[$i];
            }}
            return $len;}
        function Check($f1,$char){
            $count=0;
             while (!feof($f1 )){
             if(!strcasecmp($char,fgetc($f1 ))){
              $count++;
              break;
             }
             }if($count!=0){
                return 1;
            }else{
                 return 0;
            }
        }
        function CosSim($Q,$D)
        {
            $D1=0;
            $D2=0;
            $D3=0;
            for($i=0;$i<count($Q);$i++)
            {
             $D1+=$Q[$i]*$D[$i];   
            }
            for($i=0;$i<count($Q);$i++)
            {
             $D2+=$Q[$i]*$Q[$i];   
            }
            for($i=0;$i<count($D);$i++)
            {
             $D3+=$D[$i]*$D[$i];   
            }
            $x = (sqrt($D2)*sqrt($D3));
            if($x==0)
            {
             return($D1/-1)  ; 
            }
            else {
                return($D1/(sqrt($D2)*sqrt($D3)));
        }
        }
        function open($FName,$char)
        { 
           $C1=0;
           $f1 = fopen($FName,"r") or die("Unable to open file!"); 
           $C1+= Check($f1,$char );
           fclose($f1);
           return $C1;
        }
        function getNumofChar($FName,$char)
        { 
           $f1 = fopen($FName,"r") or die("Unable to open file!"); 
           $n1 = numberofChar($f1,$char);
           fclose($f1);
           $f1 = fopen($FName,"r") or die("Unable to open file!");
           $n2 = fun($f1,$FName);
           fclose($f1);
           return $n1/$n2;
        }
          fclose($f1);
          $ind=0;
          $j=0;
          for($i=0;$i<strlen($strn);$i++){
               
                   $C1=0;
                   $C2=0;
                   $C3=0;
                   $C4=0;
                   $C5=0;
                   $s = $strn[$i];
                   $C= open("query.txt", $s);
                   $C1= open("file1.txt", $s);
                   $C2= open("file2.txt", $s);
                   $C3= open("file3.txt", $s);
                   $C4= open("file4.txt", $s);
                   $C5= open("file5.txt", $s);
                   $CounArr[$ind]=$C1+$C2+$C3+$C4+$C5+$C;
                   $Query[$ind] =getNumofChar("query.txt",$s);
                   $Array1[$ind]=getNumofChar("file1.txt",$s);
                   $Array2[$ind]=getNumofChar("file2.txt",$s);
                   $Array3[$ind]=getNumofChar("file3.txt",$s);
                   $Array4[$ind]=getNumofChar("file4.txt",$s);
                   $Array5[$ind]=getNumofChar("file5.txt",$s);
                   $ind++;
           }
          
             $D1 =0;
             $D2 =0;
             $D3 =0;
             $D4 =0;
             $D5 =0;
             for($i=0;$i<count($CounArr);$i++)
             {
                 $Query[$i]=$Query[$i]*log($Nfile+1/$CounArr[$i],2);
                 $Array1[$i]=$Array1[$i]*log($Nfile+1/$CounArr[$i],2); 
                 $Array2[$i]=$Array2[$i]*log($Nfile+1/$CounArr[$i],2);
                 $Array3[$i]=$Array3[$i]*log($Nfile+1/$CounArr[$i],2); 
                 $Array4[$i]=$Array4[$i]*log($Nfile+1/$CounArr[$i],2);
                 $Array5[$i]=$Array5[$i]*log($Nfile+1/$CounArr[$i],2); 
             }
             $D1 = CosSim($Query, $Array1);
             $D2 = CosSim($Query, $Array2);
             $D3 = CosSim($Query, $Array3);
             $D4 = CosSim($Query, $Array4);
             $D5 = CosSim($Query, $Array5);
             $DocAr = array(
             "Document1 :"=>$D1,
             "Document2 :"=>$D2,
             "Document3 :"=>$D3,
             "Document4 : "=>$D4,
             "Document5 : "=>$D5,
             );
         
             arsort($DocAr, SORT_REGULAR);
             echo "<center>";
           
             foreach ($DocAr as $key => $value)
             {   if($value>0){
                 echo  $key.$value."<br>";
             
               }
             }
             
             echo "</center>" ;
        }
       else {
           echo "<center>";
           echo "Wrong Expression"."<br>"." Please enter the right expression";
           echo "</center>";
       }}
        ?>
    </body>
</html>
