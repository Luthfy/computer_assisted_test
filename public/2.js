(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/ExamQuestion.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Pages/ExamQuestion.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'ExamQuestion.vue',
  data: function data() {
    return {
      question: {
        id_question: 0,
        selection_group: null,
        text_question: null,
        sub_test: null,
        opsion_answer: [],
        answer: 0
      }
    };
  },
  mounted: function mounted() {
    if (this.$route.params.id == 0) {
      this.getQuestion();
    }
  },
  computed: _objectSpread(_objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapState"])({
    exams: function exams(state) {
      return state.exam.exams;
    },
    questions: function questions(state) {
      return state.exam.exams.data.exam.question;
    },
    exam: function exam(state) {
      return state.exam.exams.data.exam;
    }
  })), {}, {
    codeExam: function codeExam() {
      return this.$route.params.codeExam;
    },
    idQuestion: function idQuestion() {
      return this.$route.params.id;
    },
    answers: function answers() {
      return this.$q.localStorage.getItem('exam_cpns_answers_' + this.codeExam);
    }
  }),
  methods: {
    getQuestion: function getQuestion() {
      var question = this.questions[this.idQuestion];
      this.question = question;
    },
    setAnswer: function setAnswer(question) {
      var answers = this.answers;
      var isFind = false;
      answers.forEach(function (item, index) {
        if (item.id_question == question.id_question) {
          item.answer = question.answer;
          isFind = true;
        }
      });

      if (!isFind) {
        answers.push({
          id_question: question.id_question,
          answer: question.answer
        });
      }

      this.$q.localStorage.set('exam_cpns_answers_' + this.codeExam, answers);
    }
  },
  watch: {
    questions: function questions(newValue, oldValue) {
      this.getQuestion();
    },
    idQuestion: function idQuestion(newValue, oldValue) {
      this.getQuestion();
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/ExamQuestion.vue?vue&type=template&id=47e004ce&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/Pages/ExamQuestion.vue?vue&type=template&id=47e004ce&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "q-page",
    { staticStyle: { "padding-top": "66px" }, attrs: { padding: "" } },
    [
      _c(
        "q-card",
        { attrs: { flat: "", bordered: "" } },
        [
          _c(
            "q-card-section",
            { staticClass: "text-subtitle1" },
            [
              _vm.question.hasOwnProperty("answer")
                ? _c("q-icon", {
                    staticClass: "float-right",
                    attrs: {
                      name: "check_circle",
                      color: "primary",
                      size: "24px"
                    }
                  })
                : _vm._e(),
              _vm._v(" "),
              _c("div", { staticClass: "text-h6" }, [
                _vm._v(
                  "\n                Pertanyaan " +
                    _vm._s(parseInt(this.$route.params.id) + 1) +
                    "\n            "
                )
              ]),
              _vm._v(" "),
              _vm.question.hasOwnProperty("text_question")
                ? _c("div", {
                    domProps: { innerHTML: _vm._s(_vm.question.text_question) }
                  })
                : _vm._e()
            ],
            1
          ),
          _vm._v(" "),
          _vm.question.hasOwnProperty("opsion_answer")
            ? _c(
                "q-card-section",
                {},
                _vm._l(_vm.question.opsion_answer, function(option, index) {
                  return _c(
                    "div",
                    { key: "option-" + index },
                    [
                      _c(
                        "q-item",
                        {
                          directives: [{ name: "ripple", rawName: "v-ripple" }],
                          attrs: { tag: "label" }
                        },
                        [
                          _c(
                            "q-item-section",
                            { attrs: { avatar: "" } },
                            [
                              _c("q-radio", {
                                attrs: {
                                  dense: "",
                                  val: option.id + "-a-" + option.text_answer
                                },
                                on: {
                                  input: function($event) {
                                    return _vm.setAnswer(_vm.question)
                                  }
                                },
                                model: {
                                  value: _vm.question.answer,
                                  callback: function($$v) {
                                    _vm.$set(_vm.question, "answer", $$v)
                                  },
                                  expression: "question.answer"
                                }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "q-item-section",
                            [
                              _c("q-item-label", {
                                domProps: {
                                  innerHTML: _vm._s(option.text_answer)
                                }
                              })
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                }),
                0
              )
            : _vm._e()
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/Pages/ExamQuestion.vue":
/*!*********************************************!*\
  !*** ./resources/js/Pages/ExamQuestion.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ExamQuestion_vue_vue_type_template_id_47e004ce_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ExamQuestion.vue?vue&type=template&id=47e004ce&scoped=true& */ "./resources/js/Pages/ExamQuestion.vue?vue&type=template&id=47e004ce&scoped=true&");
/* harmony import */ var _ExamQuestion_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ExamQuestion.vue?vue&type=script&lang=js& */ "./resources/js/Pages/ExamQuestion.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ExamQuestion_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ExamQuestion_vue_vue_type_template_id_47e004ce_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ExamQuestion_vue_vue_type_template_id_47e004ce_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "47e004ce",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/Pages/ExamQuestion.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/Pages/ExamQuestion.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/Pages/ExamQuestion.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ExamQuestion_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./ExamQuestion.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/ExamQuestion.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ExamQuestion_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/Pages/ExamQuestion.vue?vue&type=template&id=47e004ce&scoped=true&":
/*!****************************************************************************************!*\
  !*** ./resources/js/Pages/ExamQuestion.vue?vue&type=template&id=47e004ce&scoped=true& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ExamQuestion_vue_vue_type_template_id_47e004ce_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ExamQuestion.vue?vue&type=template&id=47e004ce&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/Pages/ExamQuestion.vue?vue&type=template&id=47e004ce&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ExamQuestion_vue_vue_type_template_id_47e004ce_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ExamQuestion_vue_vue_type_template_id_47e004ce_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);