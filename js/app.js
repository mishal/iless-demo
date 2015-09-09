$(document).ready(function () {

  var $lessTexarea = $('textarea.less-input'),
    $cssTexarea = $('textarea.css-output');

  var theme = 'twilight',
    height = 400,
    tabSize = 2;

  var lessEditor = CodeMirror.fromTextArea($lessTexarea.get(0), {
    lineNumbers: true,
    matchBrackets: true,
    mode: 'text/x-less',
    tabSize: tabSize,
    lineWrapping: true,
    theme: theme
  });


  var cssOutput = CodeMirror.fromTextArea($cssTexarea.get(0), {
    lineNumbers: true,
    mode: 'css',
    readOnly: true,
    tabSize: tabSize,
    lineWrapping: true,
    theme: theme
  });

  lessEditor.setSize(null, height);
  cssOutput.setSize(null, height);

});
