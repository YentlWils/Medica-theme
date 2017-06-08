var $ = jQuery;

$(document).ready(function(){

  /**
   * This object controls the nav bar. Implement the add and remove
   * action over the elements of the nav bar that we want to change.
   *
   * @type {{flagAdd: boolean, elements: string[], add: Function, remove: Function}}
   */
  var myNavBar = {

    flagAdd: true,

    scrollingClass: "scrolling-class",

    elements: [],

    init: function (elements) {
      this.elements = elements;
    },

    add : function() {
      if(this.flagAdd) {
        for(var i=0; i < this.elements.length; i++) {
          document.getElementById(this.elements[i]).className += " " + this.scrollingClass;
        }
        this.flagAdd = false;
      }
    },

    remove: function() {
      for(var i=0; i < this.elements.length; i++) {
        var regex = new RegExp("(?:^|\\s)" + this.scrollingClass + "(?!\\S)");
        document.getElementById(this.elements[i]).className =
          document.getElementById(this.elements[i]).className.replace( regex , '' );
      }
      this.flagAdd = true;
    }

  };

  /**
   * Init the object. Pass the object the array of elements
   * that we want to change when the scroll goes down
   */
  myNavBar.init(  [
    "header",
    "header-container",
    "brand",
    "main-navigation"
  ]);

  /**
   * Function that manage the direction
   * of the scroll
   */
  function offSetManager(){

    var yOffset = 0;
    var currYOffSet = window.pageYOffset;

    if(yOffset < currYOffSet) {
      myNavBar.add();
    }
    else if(currYOffSet == yOffset){
      myNavBar.remove();
    }

  }

  /**
   * bind to the document scroll detection
   */
  window.onscroll = function(e) {
    offSetManager();
  }

  /**
   * We have to do a first detectation of offset because the page
   * could be load with scroll down set.
   */
  offSetManager();
});