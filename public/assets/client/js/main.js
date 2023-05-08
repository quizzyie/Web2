const rangeInput = document.querySelectorAll(".range-input input");
let priceInput = document.querySelectorAll(".shop__sidebar__price input");
let progress = document.querySelector(".slider .progress");
let priceGap = 1000;
priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(priceInput[0].value);
    let maxVal = parseInt(priceInput[1].value);

    if (maxVal - minVal >= priceGap && maxVal <= 10000) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minVal;
        progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxVal;
        progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
      }
    }
  });
  input.addEventListener("blur", () => {
    let minVal = parseInt(priceInput[0].value);
    let maxVal = parseInt(priceInput[1].value);
    let minValue = document.querySelector(".input-min");
    let maxValue = document.querySelector(".input-max");
    if (maxVal - minVal < priceGap) {
      maxVal = minVal + priceGap;
      rangeInput[1].value = maxVal;
      maxValue.value = maxVal;
      progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
    if (minVal < 0) {
      minVal = 0;
      rangeInput[0].value = minVal;
      minValue.value = minVal;
      progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
    }
    if (maxVal > 10000) {
      maxVal = 10000;
      rangeInput[1].value = maxVal;
      maxValue.value = maxVal;
      progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(e.target.parentElement.children[0].value);
    let maxVal = parseInt(e.target.parentElement.children[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      progress.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      progress.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }

    filter(0);
  });
});
const navbar = document.querySelectorAll(".navbar_menu li a");

navbar.forEach((item) => {
  item.addEventListener("click", (event) => {
    navbar.forEach((item) => {
      item.classList.remove("active");
    });
    item.classList.add("active");
  });
});

("use strict");
window.addEventListener("pageshow", function (event) {
  if (
    event.persisted ||
    (window.performance && window.performance.navigation.type === 2)
  ) {
    window.location.reload();
  }
});

(function ($) {
  /*------------------
        Preloader
    --------------------*/
  $(window).on("load", function () {
    $(".loader").fadeOut();
    $("#preloder").delay(200).fadeOut("slow");

    /*------------------
            Gallery filter
        --------------------*/
    $(".filter__controls li").on("click", function () {
      $(".filter__controls li").removeClass("active");
      $(this).addClass("active");
    });
    if ($(".product__filter").length > 0) {
      var containerEl = document.querySelector(".product__filter");
      var mixer = mixitup(containerEl);
    }
  });

  /*------------------
        Background Set
    --------------------*/
  $(".set-bg").each(function () {
    var bg = $(this).data("setbg");
    $(this).css("background-image", "url(" + bg + ")");
  });

  //Search Switch
  $(".search-switch").on("click", function () {
    $(".search-model").fadeIn(400);
  });

  $(".search-close-switch").on("click", function () {
    $(".search-model").fadeOut(400, function () {
      $("#search-input").val("");
    });
  });

  /*------------------
		Navigation
	--------------------*/
  $(".mobile-menu").slicknav({
    prependTo: "#mobile-menu-wrap",
    allowParentLinks: true,
  });

  /*------------------
        Accordin Active
    --------------------*/
  $(".collapse").on("shown.bs.collapse", function () {
    $(this).prev().addClass("active");
  });

  $(".collapse").on("hidden.bs.collapse", function () {
    $(this).prev().removeClass("active");
  });

  //Canvas Menu
  $(".canvas__open").on("click", function () {
    $(".offcanvas-menu-wrapper").addClass("active");
    $(".offcanvas-menu-overlay").addClass("active");
  });

  $(".offcanvas-menu-overlay").on("click", function () {
    $(".offcanvas-menu-wrapper").removeClass("active");
    $(".offcanvas-menu-overlay").removeClass("active");
  });

  /*-----------------------
        Hero Slider
    ------------------------*/
  $(".hero__slider").owlCarousel({
    loop: true,
    margin: 0,
    items: 1,
    dots: false,
    nav: true,
    navText: [
      "<span class='arrow_left'><span/>",
      "<span class='arrow_right'><span/>",
    ],
    animateOut: "fadeOut",
    animateIn: "fadeIn",
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
  });
  $(document).ready(function () {
    // Select the minus and plus buttons
    var minusButton = $(".minus");
    var plusButton = $(".plus");

    // Get the quantity value span
    var quantityValue = $("#quantity_value");

    // Attach click event listeners to the buttons
    minusButton.click(function () {
      var currentValue = parseFloat(quantityValue.text());
      if (currentValue > 1) {
      }
    });

    plusButton.click(function () {
      var slg = document.getElementById("slgSpTD").innerHTML;
      var currentValue = parseFloat(quantityValue.text());
      if (currentValue >= slg - 1) {
        currentValue = slg - 1;
        quantityValue.text(currentValue);
      }
    });
  });

  /*--------------------------
        Select
    ----------------------------*/
  $("select").niceSelect();

  /*-------------------
		Radio Btn
	--------------------- */
  $(
    ".product__color__select label, .shop__sidebar__size label, .product__details__option__size label"
  ).on("click", function () {
    $(
      ".product__color__select label, .shop__sidebar__size label, .product__details__option__size label"
    ).removeClass("active");
    $(this).addClass("active");
  });

  /*-------------------
		Scroll
	--------------------- */
  $(".nice-scroll").niceScroll({
    cursorcolor: "#0d0d0d",
    cursorwidth: "5px",
    background: "#e5e5e5",
    cursorborder: "",
    autohidemode: true,
    horizrailenabled: false,
  });

  /*------------------
        CountDown
    --------------------*/
  // For demo preview start
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, "0");
  var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
  var yyyy = today.getFullYear();

  if (mm == 12) {
    mm = "01";
    yyyy = yyyy + 1;
  } else {
    mm = parseInt(mm) + 1;
    mm = String(mm).padStart(2, "0");
  }
  var timerdate = mm + "/" + dd + "/" + yyyy;
  // For demo preview end

  // Uncomment below and use your date //

  /* var timerdate = "2020/12/30" */

  $("#countdown").countdown(timerdate, function (event) {
    $(this).html(
      event.strftime(
        "<div class='cd-item'><span>%D</span> <p>Days</p> </div>" +
          "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" +
          "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" +
          "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"
      )
    );
  });

  /*------------------
		Magnific
	--------------------*/
  $(".video-popup").magnificPopup({
    type: "iframe",
  });

  /*-------------------
		Quantity change
	--------------------- */
  var proQty = $(".pro-qty");
  proQty.prepend('<span class="fa fa-angle-up dec qtybtn"></span>');
  proQty.append('<span class="fa fa-angle-down inc qtybtn"></span>');
  proQty.on("click", ".qtybtn", function () {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.hasClass("inc")) {
      var newVal = parseFloat(oldValue) + 1;
    } else {
      // Don't allow decrementing below zero
      if (oldValue > 0) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 0;
      }
    }
    $button.parent().find("input").val(newVal);
  });

  /*------------------
        Achieve Counter
    --------------------*/
  $(".cn_num").each(function () {
    $(this)
      .prop("Counter", 0)
      .animate(
        {
          Counter: $(this).text(),
        },
        {
          duration: 4000,
          easing: "swing",
          step: function (now) {
            $(this).text(Math.ceil(now));
          },
        }
      );
  });
})(jQuery);
