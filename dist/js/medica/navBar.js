var $ = jQuery;

$(document).ready(function () {
  var myNavBar = {

    flagAdd: true,

    scrollingClass: "scrolling-class",

    elements: [],

    init: function init(elements) {
      this.elements = elements;
    },

    add: function add() {
      if (this.flagAdd) {
        for (var i = 0; i < this.elements.length; i++) {
          document.getElementById(this.elements[i]).className += " " + this.scrollingClass;
        }
        this.flagAdd = false;
      }
    },

    remove: function remove() {
      for (var i = 0; i < this.elements.length; i++) {
        var regex = new RegExp("(?:^|\\s)" + this.scrollingClass + "(?!\\S)");
        document.getElementById(this.elements[i]).className = document.getElementById(this.elements[i]).className.replace(regex, '');
      }
      this.flagAdd = true;
    }

  };

  myNavBar.init(["header", "header-container", "brand", "main-navigation"]);

  function offSetManager() {

    var yOffset = 0;
    var currYOffSet = window.pageYOffset;

    if (yOffset < currYOffSet) {
      myNavBar.add();
    } else if (currYOffSet == yOffset) {
      myNavBar.remove();
    }
  }

  window.onscroll = function (e) {
    offSetManager();
  };

  offSetManager();
});