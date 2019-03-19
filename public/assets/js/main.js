(function(){

	/*--
	sidebar toggle class
	======================--*/
  $('#msbo').on('click', function(){
    $('body').toggleClass('msb-x');
  });

  /*--
  sidebar plus icon toggle class
  ============================--*/
  $(".panel-default a").on('click', function(){
  	$(this).toggleClass('click-color');
  });

  /*--
  sidebar menu bar icon toggle class
  ============================--*/
  $("#msbo").on('click', function(){
  	$(this).toggleClass('msbo-click');
  });

  /*===================
    view Popup and Page Functions 
    ===================*/
    $(".open-popup").on("click",function(){
        $(".popup-wrapper-view").fadeIn();
        return false;
    });
    $(".close").on("click",function(){
        $(".popup-wrapper-view").fadeOut();
    });
	
  /*--===================
  login and logout hover call
  ==================================--*/
  
  $(".user-login").hover(function(){
        $(".user-icon-dropdown").addClass("newhover");
        }, function(){
        $(".user-icon-dropdown").removeClass("newhover");
    });


    /*===================
    view Popup price comparison 
    ===================*/

    $(".open-popup-comp").on("click",function(){
        $(".popup-wrapper-compa").fadeIn();
        return false;
    });
    $(".close").on("click",function(){
        $(".popup-wrapper-compa").fadeOut();
    });

    /*===================
    view Popup price comparison 
    ===================*/

    $(".open-popup-comparison").on("click",function(){
        $(".popup-wrapper-compa").fadeIn();
        return false;
    });
    $(".close-comp").on("click",function(){
        $(".popup-wrapper-compa").fadeOut();
    });


    /*===================
    Popup delete section
    ===================*/

    $(".open-popup-delete").on("click",function(){
            $(".popup-wrapper-delete").fadeIn();
            return false;
        });
    $(".close").on("click",function(){
            $(".popup-wrapper-delete").fadeOut();
    });

    /*===================
   PRID popup comparison
    ===================*/
    var prId = '';
    $(".prid-popup-button").on("click",function(){
        prId = $(this).attr('rel');
        $("#myModal"+prId).fadeIn();
        return false;
    });
    $(".close").on("click",function(){
        $("#myModal"+prId).fadeOut();
    });


    /*--======================
    Tender summary popup
    ====================--*/
    $(".tender-pr-id").on("click",function(){
            $(".popup-tender-summary").fadeIn();
            return false;
        });
    $(".close").on("click",function(){
            $(".popup-tender-summary").fadeOut();
    });

}());

   

/*=======================================
  Datepicker init
  =========================================*/

    $('.datepicker-f').datetimepicker({
        format: "DD-MM-YYYY",
        icons: {
        up: 'fa fa-angle-up',
        down: 'fa fa-angle-down',
        previous: 'fa fa-angle-left',
        next: 'fa fa-angle-right',
      }
    });

    /*=======================================
      Timepicker init 
    =========================================*/

      $('.timepicker-f').datetimepicker({
      format: "HH:mm A",
      icons: {
        up: 'fa fa-angle-up',
        down: 'fa fa-angle-down',
        previous: 'fa fa-angle-left',
        next: 'fa fa-angle-right',
      }
    });


