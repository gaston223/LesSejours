(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["js/annonce"],{

/***/ "./assets/js/annonce.js":
/*!******************************!*\
  !*** ./assets/js/annonce.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {__webpack_require__(/*! core-js/modules/es.regexp.exec */ "./node_modules/core-js/modules/es.regexp.exec.js");

__webpack_require__(/*! core-js/modules/es.string.replace */ "./node_modules/core-js/modules/es.string.replace.js");

$('#add-image').click(function () {
  //Je recupère le numero des futurs champs que je vais créer
  var index = +$('#widgets-counter').val();
  console.log(index); //Je recupère le prototype des entrées

  var tmpl = $('#annonce_images').data('prototype').replace(/__name__/g, index); //J'injecte ce code au sein de la div

  $('#annonce_images').append(tmpl);
  $('#widgets-counter').val(index + 1); //Je gère le bouton supprimer

  handleDeleteButtons();
});

function handleDeleteButtons() {
  $('button[data-action="delete"]').click(function () {
    var target = this.dataset.target;
    $(target).remove();
  });
}

function updateConter() {
  var count = +$('#annonce_images div.form-group').length;
  $('#widgets-counter').val(count);
}

updateConter();
handleDeleteButtons();
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ })

},[["./assets/js/annonce.js","runtime","vendors~js/annonce~js/app","vendors~js/annonce"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYW5ub25jZS5qcyJdLCJuYW1lcyI6WyIkIiwiY2xpY2siLCJpbmRleCIsInZhbCIsImNvbnNvbGUiLCJsb2ciLCJ0bXBsIiwiZGF0YSIsInJlcGxhY2UiLCJhcHBlbmQiLCJoYW5kbGVEZWxldGVCdXR0b25zIiwidGFyZ2V0IiwiZGF0YXNldCIsInJlbW92ZSIsInVwZGF0ZUNvbnRlciIsImNvdW50IiwibGVuZ3RoIl0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7O0FBQUFBLENBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JDLEtBQWhCLENBQXNCLFlBQVc7QUFDN0I7QUFDQSxNQUFNQyxLQUFLLEdBQUcsQ0FBQ0YsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0JHLEdBQXRCLEVBQWY7QUFDQUMsU0FBTyxDQUFDQyxHQUFSLENBQVlILEtBQVosRUFINkIsQ0FJN0I7O0FBQ0EsTUFBTUksSUFBSSxHQUFHTixDQUFDLENBQUMsaUJBQUQsQ0FBRCxDQUFxQk8sSUFBckIsQ0FBMEIsV0FBMUIsRUFBdUNDLE9BQXZDLENBQStDLFdBQS9DLEVBQTRETixLQUE1RCxDQUFiLENBTDZCLENBUTdCOztBQUNBRixHQUFDLENBQUMsaUJBQUQsQ0FBRCxDQUFxQlMsTUFBckIsQ0FBNEJILElBQTVCO0FBQ0FOLEdBQUMsQ0FBQyxrQkFBRCxDQUFELENBQXNCRyxHQUF0QixDQUEwQkQsS0FBSyxHQUFHLENBQWxDLEVBVjZCLENBVzdCOztBQUNBUSxxQkFBbUI7QUFFdEIsQ0FkRDs7QUFlQSxTQUFTQSxtQkFBVCxHQUErQjtBQUMzQlYsR0FBQyxDQUFDLDhCQUFELENBQUQsQ0FBa0NDLEtBQWxDLENBQXdDLFlBQVk7QUFDaEQsUUFBTVUsTUFBTSxHQUFHLEtBQUtDLE9BQUwsQ0FBYUQsTUFBNUI7QUFDQVgsS0FBQyxDQUFDVyxNQUFELENBQUQsQ0FBVUUsTUFBVjtBQUNILEdBSEQ7QUFJSDs7QUFFRCxTQUFTQyxZQUFULEdBQXVCO0FBQ25CLE1BQU1DLEtBQUssR0FBRyxDQUFDZixDQUFDLENBQUMsZ0NBQUQsQ0FBRCxDQUFvQ2dCLE1BQW5EO0FBQ0FoQixHQUFDLENBQUMsa0JBQUQsQ0FBRCxDQUFzQkcsR0FBdEIsQ0FBMEJZLEtBQTFCO0FBQ0g7O0FBQ0RELFlBQVk7QUFDWkosbUJBQW1CLEciLCJmaWxlIjoianMvYW5ub25jZS5qcyIsInNvdXJjZXNDb250ZW50IjpbIiQoJyNhZGQtaW1hZ2UnKS5jbGljayhmdW5jdGlvbigpIHtcclxuICAgIC8vSmUgcmVjdXDDqHJlIGxlIG51bWVybyBkZXMgZnV0dXJzIGNoYW1wcyBxdWUgamUgdmFpcyBjcsOpZXJcclxuICAgIGNvbnN0IGluZGV4ID0gKyQoJyN3aWRnZXRzLWNvdW50ZXInKS52YWwoKTtcclxuICAgIGNvbnNvbGUubG9nKGluZGV4KTtcclxuICAgIC8vSmUgcmVjdXDDqHJlIGxlIHByb3RvdHlwZSBkZXMgZW50csOpZXNcclxuICAgIGNvbnN0IHRtcGwgPSAkKCcjYW5ub25jZV9pbWFnZXMnKS5kYXRhKCdwcm90b3R5cGUnKS5yZXBsYWNlKC9fX25hbWVfXy9nLCBpbmRleCk7XHJcblxyXG5cclxuICAgIC8vSidpbmplY3RlIGNlIGNvZGUgYXUgc2VpbiBkZSBsYSBkaXZcclxuICAgICQoJyNhbm5vbmNlX2ltYWdlcycpLmFwcGVuZCh0bXBsKTtcclxuICAgICQoJyN3aWRnZXRzLWNvdW50ZXInKS52YWwoaW5kZXggKyAxKVxyXG4gICAgLy9KZSBnw6hyZSBsZSBib3V0b24gc3VwcHJpbWVyXHJcbiAgICBoYW5kbGVEZWxldGVCdXR0b25zKCk7XHJcblxyXG59KTtcclxuZnVuY3Rpb24gaGFuZGxlRGVsZXRlQnV0dG9ucygpIHtcclxuICAgICQoJ2J1dHRvbltkYXRhLWFjdGlvbj1cImRlbGV0ZVwiXScpLmNsaWNrKGZ1bmN0aW9uICgpIHtcclxuICAgICAgICBjb25zdCB0YXJnZXQgPSB0aGlzLmRhdGFzZXQudGFyZ2V0O1xyXG4gICAgICAgICQodGFyZ2V0KS5yZW1vdmUoKTtcclxuICAgIH0pXHJcbn1cclxuXHJcbmZ1bmN0aW9uIHVwZGF0ZUNvbnRlcigpe1xyXG4gICAgY29uc3QgY291bnQgPSArJCgnI2Fubm9uY2VfaW1hZ2VzIGRpdi5mb3JtLWdyb3VwJykubGVuZ3RoO1xyXG4gICAgJCgnI3dpZGdldHMtY291bnRlcicpLnZhbChjb3VudCk7XHJcbn1cclxudXBkYXRlQ29udGVyKClcclxuaGFuZGxlRGVsZXRlQnV0dG9ucygpOyJdLCJzb3VyY2VSb290IjoiIn0=