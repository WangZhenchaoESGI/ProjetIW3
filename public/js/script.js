$(document).ready(
  function(){
    toggle();
    hideSections();
    showSections();
    // INSTRUCTIONS LORSQUE LE DOC EST PRET
    //console.log("DOCUMENT PRET !!");
    // AJOUTER UNE TRANSITION SUR LE HEADER
    $('header').css('transition','all 0.6s');
    // $('header').css('backgroundColor','red');

    // ECOUTER LE SCROLL DE LA FENETRE
    $(window).scroll(
      function(){
        var window_position = $(window).scrollTop();
        //console.log(window_position);
        if(window_position > 0){
          $('header').addClass('sticky');
        }
        else{
          $('header').removeClass('sticky');
        }
        showSections();
      }
    )
  });

function hideSections(){
  //$('main > section').css('opacity',0);

  // parcourir le tableau
  $('section').each(
    function(index){
      $(this).css('opacity',0);
      $(this).css('position','relative');
      $(this).css('top','5rem');
      $(this).css('transition','all 0.6s');
    }
  )
}

// 1/ Masquer les sections
// 2/ Ajouter un ecouteur de scroll sur la window qui va lancer la fonction showSections()

function showSections(){
  console.log('show Section');
  // pour chaque section du main
  $('section').each(
    function(index){
      // Si le top de la section < 70% de la window
      var top_section = $(this).position().top - $(window).scrollTop();
      if(top_section <= $(window).height() * 0.7){
        // opacity 1
        $(this).css('opacity',1);
        $(this).css('top',0);
      }
    }
  )
}

function toggle(){
  $('#toggle').click(function(){
    $(this).next('.nav').toggleClass("is-collapsed-mobile");
  });
}












