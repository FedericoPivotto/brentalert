<!--
 * Copyright (C) 2021 ITIS "E. Fermi", Bassano del Grappa (VI) Italy
 * Please refer to the AUTHORS file for more information.
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
-->

<template>
<div id="d-flex row align-items-center">

    <div class="card card-about">
        <div class="card-body">
            <h4 class="card-title card-text-custom-header">About!</h4>
            <p class="card-text card-text-custom">In questa pagina potrai trovare tutte le informazioni relative all'applicazione BrentAlert.</p>
        </div>
    </div>

    <div class="card card-about">
        <div class="card-body">
            <h4 class="card-title card-text-custom-header">Perché BrentAlert</h4>
            <p class="card-text card-text-custom">BrentAlert nasce dalla necessità di aiutare la popolazione di Bassano del Grappa in situazioni di emergenza, in specifico durante le piene del fiume Brenta.</p>
        </div>
    </div>

    <div class="card card-about">
        <div class="card-body">
            <h4 class="card-title card-text-custom-header">Futuro</h4>
            <p class="card-text card-text-custom">L'idea per il nostro futuro è quella di donare l'applicazione alla Protezione Civile di Bassano del Grappa, in modo da dare seguito a questo progetto istituito per il concorso al Premio Scuola Digitale 2019/2020.</p>
            <p class="card-text card-text-custom">La nostra applicazione permetterà alle autorità di comunicare con gli organi di emergenza in modo estremamente semplice, fornendo un elenco dei contatti utili e la possibilità di contattarli tramite chiamate o messaggi Telegram.</p>
        </div>
    </div>

    <div class="card card-about">
        <div class="card-body">
            <h4 class="card-title card-text-custom-header">App realizzata da:</h4>
            <p class="card-text card-text-custom"> Davide Molinaroli, Davide De Benetti, Nicola Basso, Francesco Milani, Andrea Tessarolo, Alessando Ruggeri, Federico Pivotto, Federico Guazzo </p>
            <p class="card-text card-text-custom">Gruppo di studenti delle classi <br> 5Ai e 5Bi - A.S. 2019/2020 <br> <a href="https://www.fermibassano.edu.it" target="_blank"> ITIS "E. Fermi", Bassano del Grappa</a></p>
            <a href="https://www.fermibassano.edu.it" target="_blank"> <img class="center" src="../assets/logo_itis.png" alt=""></a>
        </div>
    </div>

    <div class="card card-about">
        <div class="card-body">
            <h4 class="card-title card-text-custom-header">Avvertenza</h4>
            <p class="card-text card-text-custom">I dati visualizzati sono resi disponibili da ARPAV tramite pubblicazione su sito Internet. Tale pubblicazione avviene in modo automatico, senza validazione preventiva; a seguito di validazione i dati possono subire anche notevoli variazioni. L'aggiornamento dei dati avviene ogni 30 minuti, con un ritardo rispetto all'acquisizione in "tempo reale" solitamente di circa 1-2 ore. Eventuali possibili maggiori ritardi nell'aggiornamento sono accidentali e non valutabili a priori. L'eventuale mancanza di dati è da imputarsi a malfunzionamento del sistema. ARPAV interviene per la rimozione di eventuali guasti in base a procedure codificate e nel minor tempo possibile.
            <br><br>
            (Fonte: <a href="https://www.arpa.veneto.it" target="_blank">www.arpa.veneto.it</a>)

            </p>
        </div>
    </div>


    <div class="card card-about">
        <div class="card-body">
            <h4 class="card-title card-text-custom-header">Contatti</h4>
            <p class="card-text card-text-custom">Per informazioni e suggerimenti scrivere una email a: <br><a href="mailto:protezionecivile@comune.bassano.vi.it">protezionecivile@comune.bassano.vi.it</a></p>
        </div>
    </div>




    <div class="card card-about">
        <div class="card-body">
          <a href="http://www.comune.bassano.vi.it/" target="_blank"><img class="center" src="../assets/Bassano_del_Grappa-Stemma.png" alt="comune Bassano Del Grappa" style="width:160px">
            <p class="card-text-custom muted"> <a href="http://www.comune.bassano.vi.it/" target="_blank">Città di Bassano del Grappa</a></p>
          </a>
<!--          <a href="https://www.arpa.veneto.it/" target="_blank"><img class="center" src="../assets/arpav-veneto.png" alt="Arpa Veneto"></a> -->
        </div>
    </div>
    <!-- <div class="card card-about"> -->
    <!--     <div class="card-body"> -->
    <!--     </div> -->
    <!-- </div> -->
    <!--  -->

</div>
</template>

<script>
export default {
  
  name:'About',

}
</script>

<style scoped>
a {
  color: #e0e0e0;
  font-weight: bold;
}

  .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 80%;
    height: auto;
    object-fit: contain;
  }

  .card-about
  {
      box-shadow: 5px 5px 10px 7px rgba(0, 0, 0, 0.2);
      background: rgb(63,94,251);
      background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(44,67,191,1) 100%);
      margin-bottom: 2.5%;
      margin-right:2.5%;
      margin-left:2.5%;
      margin-top:2.5%;
      border-radius:5px;
      border-color:#BFBFBD;
  }

  .card-text-custom-header
  {
      font-family: Roboto;
      color:#fff;
      text-align:center;
  }

  .card-text-custom
  {
      font-family: Roboto;
      color:#BFBFBD;
      text-align:center;
  }

</style>
