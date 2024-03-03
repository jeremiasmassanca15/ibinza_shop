<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include_once ("header.php");?>
    <?php include ("inc/function.php");?>
</head>

<body>
  <main class='ffw' style='ackground:#f7f7f7'>

    <?php
    
        $pth0 = !empty($path[0]) ? $path[0] : 'Nenhuma';
        $pth1 = !empty($path[1]) ? $path[1] : '';
        $epth1 = explode('-', $pth1);
        $f = !empty($epth1[0]) ? $epth1[0] : '';
        
        $favail=0;$efiltrar='';
        if(isset($_GET['filtrar'])) {
            $efiltrar=explode('-', $_GET['filtrar']);
            $chkfavail = ['chegando', 'leilao', 'fornecedor internacional'];
            $favail = in_array($efiltrar[0], $chkfavail) ? $efiltrar[0] : 0;
            $fprice = !empty($efiltrar[1]) ? $efiltrar[1] : '';
            $efprice = explode('_', str_replace(' ','', str_replace(',','',str_replace('KZs','',$fprice))));
            $efprice1 = $efprice[0];
            $efprice2 = $efprice[1];
            $efilt3 = !empty($efiltrar[2]) ? $efiltrar[2] : 0;
            $eurlbf = explode('&filtrar', $url)[0];}
            
        $gc = str_replace('-', ' ', $gtc);

        $fetch_cat=$con->prepare("select catid,title,catimg from categories where section=:gc");
        $fetch_cat->bindValue(':gc', $gc, PDO::PARAM_STR);
        $fetch_cat->fetchAll(PDO::FETCH_ASSOC);
        $fetch_cat->execute();
        if($fetch_cat->rowCount() > 0) {$row_cat=$fetch_cat->fetchAll();}
        else{$row_cat=0;}
        
        $fetch_pro=$con->prepare("select pid,pname,section,price,pfeat4,avail from products  order by pid desc limit 0,12");
        $fetch_pro->setFetchMode (PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

      echo"
        <div class='ff bli f13 aic sameline smxs_none' style='padding: 0.75em 1.7em;'>
            <a href='https://www.ibinza.com/?home' class='aic underline mr025em'>Início
            </a>
            <img class='img10' src='imgs/icons/rightchev.png'>
            <a href='https://www.ibinza.com/categoria?lilo=pt&amp;c=Vehiculos-e-transporte' class='aic underline ml05em mr025em'>Vehiculos e transporte
            </a>
            <img class='img10' src='imgs/icons/rightchev.png'>
            <span class='mr05em gc2 ml05em txtlmt'>Carros a Venda</span>
        </div>
        <div class='ffw spacbwt mt025e none_smxs p015em pt05em wb aic'>
            <a href='https://www.ibinza.com/?".$lilo."home'><img src='imgs/icons/leftchev.png' class='img20'></a>
            <a href='https://www.ibinza.com/?".$lilo."home' class='f25 center aic pl05em_smxs'><img src='imgs/logoib.png' class='mr025em mb025em' width='13.5%'>ibinza
            </a>
            <p></p>
        </div>
        <section class='walinc full'>
            <div class='ffw wb smxs_stick index-8'>
                <div class='full index-12 p025em wb fixed_smxs none_smxs' style='padding-top: 0.5em;'>
                    <form method='post' action='pesquisar' id='input1' style='height: 1.3em' class='col-sm-12 col-xs-12 flex aic bli b6 nne _smxs'>
                        <button type='submit' class='p1em bord0 aic b0 wb b6' style=''>
                          <img src='imgs/icons/bsearch.png' class='img20 pointer mr025e'>
                        </button>
                        <input name='q' value='' type='text' class='full bord0 fh b0' style=';color: #333;font-size:18px;padding-left: 0;' placeholder='Endereço, zona'>
                    </form>
                </div>
                <div class='ffw walinc mt075em plr025em smxs_none'>
                    <span class='full f25 bold'>Categorias</span>
                    <div class='sameline f13 flex mb025em mt075em gc5 maxc'>
                        <span class='mr025em bc'>Mostrando 1 - 12</span> 
                        de $rescount item(s) 
                    </div>
                </div>
                <div class='ff wb walinc p025em' style='padding-top:0.1em'>";
                    echo allcat('','','','','','Filtrar','border-right:#eee 1px solid;margin-right:0.25em',4);
                    echo"
                    <div class='ff xscroll_smxs'>";
                        $styc='';
                        echo allcat('','','','','','Cidade','',2);
                        echo allcat($favail,$path,'',$fprice,$efprice,'Preços','',3);
                        echo allcat('','','','','','Outros','',4);
                    echo"
                    </div>
                </div>
            </div>
            <img src='imgs/ccover.png' class='full r035em mb025em none'>
            <div class='ff'>
                <div class='col-lg-3 mt025em smxs_ none mr05em' style='width:8em;margin-right:1e'>
                    <div class='full stick_ maxh fdc'>
                        <div class='ffw fdc'>
                            <p><strong>CATEGORIAS</strong></p>";
                            foreach ($row_cat as $rowcat) {
                                if($rowcat['catid']) {
                                    $title=$rowcat['title'];
                                    $titlid=$rowcat['catid'];
                                    // $cidcn = $titlid.'-'.$title; 
                                    echo"
                                    <a href='https://www.ibinza.com/produtos?listagem=$titlid-$title' class='mt025em ml025em'><span class='f14'>$title</span></a>";}}
                        echo"
                        </div>
                        <div style='ackground: #f0f1ff;height:9em;' class='ffw mt05em btn2 bli aic smxs_none'>
                            <h6 class='bold'>Aliste o teu item em 5 minutos</h6>
                            <span class='f12 gc2 lh105'>É grátis e fácil e podes começar agora mesmo</span>
                            <a href='#' style='padding: 0.2em 2em;' class='maxc rc r015em'>
                                <span style='font-size: 13px;'><strong>Vender</strong>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class='full mt025e' style='padding-top: 0.1e;'>
                    <div class='full smxs_none mb05em'></div>
                    <div class='ffw p05em r05em mb05em' style='background:#fcfaf8;padding-right:0'>
                        <div href='#' class='f25 smxs_fdc flexw bold smxs_plr025em' style='olor: #fb4c7e;'>
                            <span style='border-bottom:#333 3px solid;olor: #ff3e3e;' class='maxc f_adj'>Mais populares
                            </span>
                        </div>
                        <div class='ffw mt05em'>
                            <div class='col-lg-3 col-xs-12 mb075em'>";
                                foreach ($row_cat as $rowcat) {
                                    if($rowcat['catid']) {
                                        $title=$rowcat['title'];
                                        $titlid=$rowcat['catid'];
                                        $cidcn = $titlid.'-'.$title;
                                        $impcidcn .= $cidcn.",";
                                        $catimg=explode(',',$rowcat['catimg']);
                                        foreach($catimg as $img){
                                            if(explode('00',$img)[0] === 'imgty1') {
                                            echo"
                                            <a href='https://www.ibinza.com/?listagem=$titlid-$title' class='maxc plr075em mb025em mr05em bsl2 bli1 r035em center wb aic is-selected' style='height: 1.2em;'>
                                                <span class='f14'>$title</span>
                                            </a>";}}}}
                            echo"
                            </div>
                            <div class='col-lg-9 col-xs-12 js-flickity overflow'>";
                                while($row_pro=$fetch_pro->fetch()):
                                    if($row_pro){
                                        $ravail=$row_pro['avail'];
                                        $eavail = explode('_', $ravail);
                                        $avlp4 = !empty($eavail[4]) ? $eavail[4] : '0';
                                        $epermi = explode('%',$avlp4);
                                        if(!in_array(55, $epermi)){continue;}
                                        $pid=$row_pro['pid'];$pname=$row_pro['pname'];$prc=$row_pro['price'];
                                        $prc = str_replace('.00', '', number_format($prc, 2, '.', ','));
                                        $encrpid = $pid*4290347;
                                        $repname = str_replace(' ', '-', $pname);
                                        $price =  $prc . ' KZS';
                                        $pimgsty1='height:5em;width: 11em;';
                                        $city = explode('-', $eavail[3])[2];
                                        $lccity = str_replace(' ', '',strtolower($city));
                                        $eli = explode('_',$lilo)[0];
                                        $link = 'https://www.ibinza.com/?'.$eli.'_'.$lccity.'&detalhes='.$encrpid.'-'.$repname;
                                        $pcsty='height:6.2em;border-radius: 0.35em;margin-right:0.5em;width: 100%;';
                                        $imgsty = 'object-fit: cover;';
                                        echo"
                                        <div class='col-lg-3 col-md-4 col-sm-6 col-xs-8 gallery-cell mr05em'>";
                                            echo getimage($pid,$link,$pcsty,$imgsty);
                                            echo"
                                            <div class='full mt025em'>
                                                <a href='$link' class='flexw gc f17 txtlmt' style='olor:#3c73aa'>$pname</a>
                                                <span class='f18 mt025em' style='olor:#aa4130'>
                                                    <strong>$price</strong>
                                                </span>";
                                                // echo profeat($eavail,$city,'',$link,'','width:100%');
                                            echo"    
                                            </div>
                                        </div>";}
                                endwhile;
                            echo"
                            </div>
                        </div>
                    </div>
                    <div class='ffw wb li r05em'>
                        <div class='full t05em'>
                            <span class='ffw pb025em mt025em none'>
                                <p><strong>Explore listagem</strong></p>
                            </span>";
                            // ========= Subcategorias ===========
                            $cnt=0;
                            foreach ($row_cat as $rowcat) {
                                $titlid=$rowcat['catid'];
                                $title=$rowcat['title'];
                                $cat=$rowcat['catimg'];
                                echo"
                                <div class='ffw wb btn2'>
                                    <span class='full f16 bold'>$title</span>
                                </div>
                                <div class='ffw mb075em'>";
                                    if(!empty($cat)) {
                                        $catimg=explode(',',rtrim($cat, ","));
                                        $cntcat = count($catimg);
                                        foreach ($catimg as $img) {
                                            $scnam = explode('.', $img)[0];
                                            $cnt++;
                                            if ($cnt <= 6) {
                                                if (explode('00', $img)[0] === 'imgty1') {continue;}
                                                echo"
                                                <div class='col-lg-2 col-md-4 col-sm-6 col-xs-6'>
                                                    <a href='https://www.ibinza.com/?listagem=$titlid-$title-$scnam' class='ffw p035em'>
                                                        <figure class='ffw overflow center r035em' style='height:5.5em'><img loading='lazy' class='fh' src='imgs/cat_img/$img' alt=''>
                                                        <span class='ffw wc p05em f16 lh105 txtlmt' style='background: #2d282870;margin-top: -2.5em;'>$scnam</span>
                                                        </figure>
                                                    </a>
                                                </div>";}
                                                
                                            if($cnt == $cntcat && $cntcat > 6){
                                                echo "
                                                <div class='col-lg-3 col-md-6 col-sm-6 col-xs-6'>
                                                    <div class='ffw fh p025em bl1 bb1'>
                                                        <span class='ffw maxh'><p class='ffw lh105 gc'>Outras categorias</p>";
                                                        for ($i = 6; $i < min(9, $cntcat); $i++) {
                                                            if (isset($catimg[$i])) {                   $scnam = explode('.', $catimg[$i])[0];
                                                                echo"<a href='https://www.ibinza.com/?listagem=$titlid-$title-$scnam' class='mt025em mr025em r015em btn3 bdark bold'><p>$scnam</p></a>";}}
                                                        echo"
                                                        </span>
                                                    </div>
                                                </div>";}}$cnt=0;}
                                echo"</div>";}
                            echo"
                            <div class='ffw wb bl br mt025e btn2 b05em none'>
                                <span class='full f16 bold'>Carros novos</span>
                            </div>
                            <div class='ffw br bt t05em none'>";
                            echo"</div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>";

    ?>
        
  </main>
  
    <script defer src="js/flickity.pkgd.min.js"></script>
  
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const images = document.querySelectorAll('img.lazyload');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src; // This will trigger the load of the image
                        lazyImage.onload = () => {
                            lazyImage.classList.remove('lazyload'); // This will remove the spinner
                        };
                        observer.unobserve(lazyImage);
                    }
                });
            });
            images.forEach((img) => {
                imageObserver.observe(img);
            });
        });
    </script>
  
  </body>
  </html>
