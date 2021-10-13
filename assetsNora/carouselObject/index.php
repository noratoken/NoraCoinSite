<?php
class carousel{
  function carousel1(){
    ?>
  <div class="adBox ">
    <div id="carousel" class="carousel slide mainImages" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="img/payWithNora.png" alt="nora coin">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/c2.png" alt="nora coin">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/digitalCurrency.png" alt="nora coin digital currency">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/grow.png" alt="nora coin gains">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

    <?php
  }
}


?>
