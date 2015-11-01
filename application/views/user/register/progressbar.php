<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container text-center">

            <div class="row bs-wizard" style="border-bottom:0; margin-left:20%;">

                <div class="col-xs-3 bs-wizard-step <?php if($step == 1){ echo 'active';} elseif($step == 2 || $step == 3){echo 'complete';} ?>">
                  <div class="text-center bs-wizard-stepnum">Schritt 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Gib deine Daten ein</div>
                </div>

                <div class="col-xs-3 bs-wizard-step <?php if($step == 1){ echo 'disabled';} elseif($step == 2){echo 'active';} elseif($step == 3) { echo 'complete'; } ?>"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Schritt 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Schau in deine E-Mail</div>
                </div>

                <div class="col-xs-3 bs-wizard-step <?php if($step == 1 || $step == 2){ echo 'disabled';} elseif($step == 3) { echo 'active'; } ?>"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Schritt 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Fertig! (ggf. Profil erweitern)</div>
                </div>
            </div>





  </div>
</div>