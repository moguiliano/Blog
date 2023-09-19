<?php
function render(string $path, array $variables =[])
{

    /**
     * extrcat recupere des variables sous forme ['variable'=>$varible ] 
     * le transofme en $variable = 'variable';
     * 
     *
     */
extract($variables);
    /**
     * on demarre un tampon ,
     * on recupere l'execution du corps 
     * de la page que l'on requiere
     * on la stock dans une variable page content
     * on l'utilise ensuite dans la layout
     */

    ob_start();
    require('templates/' .$path.'.html.php');//corp de la page
    $pageContent = ob_get_clean();//on stock l'affichage du corp sans lafficher 
    require('templates/layout.html.php');//affiche mon layout
}


function redirect($path)
{   
    header("Location:".$path);
    exit();
    
}

?>