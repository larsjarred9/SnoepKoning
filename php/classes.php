<?php
class Snoepjes {
    public $vorm;
    public $kleur;
    public $smaak;
  
    function __construct($vorm, $kleur, $smaak) {
      $this->vorm = $vorm;
      $this->kleur = $kleur;
      $this->smaak = $smaak;
    }
    
}
?>