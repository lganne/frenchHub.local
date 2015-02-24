 
 $adr="img/tour/slider_blog/tour-blog-"
 $imgEnCours="";
 //$tab=["backend.jpg","frontend.jpg","frontend-dialog.jpg" ];

 $(".supDroite").on("click",droite);
 $(".infGauche").on("click",gauche);
 $(".slider").on("click",photo);
 
  $i=0;
  $indice="";
 
 function droite(e)
 {
   $i=0;
    $indice=$(this).prev(".slider");
    console.log($indice);
    $ind=$indice.data('indice');
    console.log("ind debut",$ind);
    
    $i=$ind+1;
    $.ajax({
		url:"json/mySilder.json",
		type:"GET",
		dataType:"json",
		success:affiche
	});
    
 }
 function gauche(e)
 {
   $i=0;
    $indice=$(this).next(".slider");
    console.log("next",$indice);
    $ind=$indice.data('indice');
    console.log("ind debut",$ind);
    
    $i=$ind-1;
    $.ajax({
		url:"json/mySilder.json",
		type:"GET",
		dataType:"json",
		success:affiche
	});
    
 }
 
 function photo(e)
 {
    $i=0;
    $ind=$(this).data('indice');
    console.log("ind debut",$ind);
    $indice=$(this);
    $i=$ind+1;
    $.ajax({
		url:"json/mySilder.json",
		type:"GET",
		dataType:"json",
		success:affiche
	});
    
 }
 
 
 
 
 function affiche(donnee)
 {
    console.log("apres",$i);
    $x=$indice.data('tab');
    $tab=donnee[$x];
    console.log($tab);
    
    if ($i <0)
    {
       $i=$tab.length+$i;
        console.log("inferieur 0",$i);
      $imgEnCours=$tab[$i];
      
        
    }
    else if($i <$tab.length)
    {
       
      $imgEnCours=$tab[$i];
      
        
    }
      else
    {
        $i=0;
        $imgEnCours=$tab[$i];
    }
    
    $indice.attr( 'src',$imgEnCours);
   $indice.data('indice', $i );
                 
}

  

