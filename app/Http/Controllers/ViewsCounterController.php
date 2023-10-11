<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsCounterController extends Controller
{
    public function ajouter_vue()
    {
        // Chemin vers le fichier de compteur
        $fichier = storage_path('app/compteur.txt');
        $journal = storage_path('app/journal_visiteur.txt');

        // Obtenir l'adresse IP du visiteur
        $ip = $_SERVER['REMOTE_ADDR'];

        // Vérifier si l'IP existe déjà dans le journal
        if (!$this->ip_existe_dans_journal($ip, $journal)) {
            // Incrémentation
            $compteur = 1;
            if (file_exists($fichier)) {
                $compteur = (int) file_get_contents($fichier);
                $compteur++;
            }

            // Enregistrement du compteur dans le fichier
            file_put_contents($fichier, $compteur);

            // Ajouter l'IP au journal
            $this->ajouter_ip_au_journal($ip, $journal);
        }
    }

    public function nombre_vue()
    {
        $fichier = storage_path('app/compteur.txt');
        $compteur = (int) file_get_contents($fichier);
        return $compteur;
    }

    private function ip_existe_dans_journal($ip, $journal)
    {
        $ip_list = file($journal, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return in_array($ip, $ip_list);
    }

    private function ajouter_ip_au_journal($ip, $journal)
    {
        file_put_contents($journal, $ip . PHP_EOL, FILE_APPEND);
    }
}
