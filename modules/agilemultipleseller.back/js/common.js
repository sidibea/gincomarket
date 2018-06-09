/** _agile_  Removes leading whitespaces _agile_  **/
function LTrim(value) {

    var re = /\s*((\S+\s*)*)/;
    return value.replace(re, "$1");

}

/** _agile_  Removes ending whitespaces _agile_  **/
function RTrim(value) {

    var re = /((\s*\S+)*)\s*/;
    return value.replace(re, "$1");

}

/** _agile_  Removes leading and ending whitespaces _agile_  **/
function trim(value) {

    return LTrim(RTrim(value));

}

function getQuerystringParam(url, key, default_) {
    if (default_ == null) default_ = "";
    key = key.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + key + "=([^&#]*)");
    var qs = regex.exec(url);
    if (qs == null)
        return default_;
    else
        return qs[1];
}