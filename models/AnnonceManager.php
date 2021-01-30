<?php

class AnnonceManager extends Model
{
 public function getAnnonces()
 {

     return $this->getAll('annonce', 'Annonces');
 }
}