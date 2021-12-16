// RESPONSIVE NAVIGATION
  $(document).ready(function () {

    $("#navbar").on("click", function() {
      $(".nveMenu").addClass("is-opened");
      $(".overlay").addClass("is-on");
    });

    $(".overlay").on("click", function() {
      $(this).removeClass("is-on");
      $(".nveMenu").removeClass("is-opened");
    });
  });
  // RESPONSIVE NAVIGATION


  //inspired by instagram : webdev.tips

const tab = document.querySelectorAll("button");
const panel = document.querySelectorAll(".single__tab");

function tabClick(event) {
  // deactivate existing active tabs and panel
  for (let i = 0; i < tab.length; i++) {
    tab[i].classList.remove("active");
    console.log(tab[i]);
  }
  for (let i = 0; i < panel.length; i++) {
    panel[i].classList.remove("active");
    console.log(panel[i]);
  }
  // activate new tabs and panel
  event.target.classList.add('active');
  let classString = event.target.getAttribute('data-target');
  document.getElementById('tabs__content').getElementsByClassName(classString)[0].classList.add("active");
}
for (let i = 0; i < tab.length; i++) {
  tab[i].addEventListener('click', tabClick, false);
}

window.onload = function() {
    baguetteBox.run('.baguetteBoxOne');
    baguetteBox.run('.baguetteBoxTwo');
    baguetteBox.run('.baguetteBoxThree', {
        animation: 'fadeIn',
        noScrollbars: true
    });
    baguetteBox.run('.baguetteBoxFour', {
        buttons: false
    });
    baguetteBox.run('.baguetteBoxFive', {
        captions: function(element) {
            return element.getElementsByTagName('img')[0].alt;
        }
    });

    if (typeof oldIE === 'undefined' && Object.keys) {
        hljs.initHighlighting();
    }

    var year = document.getElementById('year');
    year.innerText = new Date().getFullYear();
};