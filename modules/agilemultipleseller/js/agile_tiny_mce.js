/**
 * Dynamic finding server path by its js file
 */

var scr = document.getElementsByTagName('script');
var path = scr[scr.length - 1].getAttribute("src");
var path_array = path.split('/');
path_array.splice((path_array.length - 4), 4);
var root_path = path_array.join('/');
window.tinyMCEPreInit = {};
window.tinyMCEPreInit.base = root_path + '/js/tiny_mce';
window.tinyMCEPreInit.suffix = '.min';
$('head').append($('<script>').attr('type', 'text/javascript').attr('src', root_path + '/js/tiny_mce/tinymce.min.js'));
