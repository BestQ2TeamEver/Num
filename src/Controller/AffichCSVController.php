<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AffichCSVController extends AbstractController
{
    /**
     * @Route("/", name="home ")
     */
    public function home(){
        return $this->render('home/home.html.twig');
    }


    /**
     * @Route("/affichCSV", name="affichCSV")
     */
    public function index()
    {
        echo"<h1>Voila le contenu du fichier CSV actuel : ✅</h1>";
        $rowNo = 1;
        $boolean = 0;
        $nomcolonnes = array();
        $info = array();
            // $fp is file pointer to file sample.csv
        //C:\Users\Numa mrn\Desktop\php\VoltaireQ2Project\src\Controller
        if (($fp = fopen((__DIR__)."\\data.csv", "r")) !== FALSE) {
            while (($row = fgetcsv($fp, 1000, ";")) !== FALSE) {
                //Only 0 .  $num = count($row);
                //useless because CSV have one column and c is always only 0.  for($c=0 ; $c< $num; $c++){
                $str = explode(";", $row[0]);
                if($boolean == 0){
                    foreach ($str as $s) {
                        array_push($nomcolonnes,$s);
                        $boolean++;
                    }
                }
                $rowexploded = count($str);
                $donnees = array();
                echo "<p> Etudiant $rowNo <br /></p>\n";
                if($rowNo>1){
                    for ($c=0; $c < $rowexploded; $c++) {
                        array_push($donnees,$str[$c]);
                        echo "$str[$c]<br>";
                    }
                }
                array_push($info, $donnees);
                
                $rowNo++;
            }
            fclose($fp);
        }
        return $this->render('affichCSV/affichCSV.html.twig', [
            'controller_name' => 'AffichCSVController',
        ]);
    }

}