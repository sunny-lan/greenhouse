/**
 * Allows to modify current URL easily
 * @param pairs What parameters to set eg. [[paramKey, paramValue], [paramKey, paramValue] ...] - May also contain a single pair
 * @param location The location to navigate to
 * @param clearParams Set to true in order to clear all old parameters
 * @param clearSrc Set to true in order to keep the URL of the last page
 */
function setPage(pairs, location, clearParams, clearSrc) {
    if (pairs[0])
        if (!Array.isArray(pairs[0]))
            pairs = [pairs];

    var l = window.location;

    var params = {};

    // inject srcURL into params
    var realLocation = window.location.protocol + '//' + window.location.host + window.location.pathname;
    if (!clearSrc && !clearParams)
        params.srcURL = realLocation;
    else params.srcURL= location;

    if (!clearParams) {
        // get old params from url
        var x = /(?:\??)([^=&?]+)=?([^&?]*)/g;
        var s = l.search;
        for (var r = x.exec(s); r; r = x.exec(s)) {
            r[1] = decodeURIComponent(r[1]);
            if (!r[2]) r[2] = '%%';
            params[r[1]] = r[2];
        }
    }

    // inject given params into old params
    for (var pairIdx = 0; pairIdx < pairs.length; pairIdx++) {
        var val = pairs[pairIdx];
        if (val === undefined)continue;
        if (val[1].length)
            val = encodeURIComponent(val[1]);
        else val = undefined;
        params[pairs[pairIdx][0]] = val;
    }

    // build search
    var search = [];
    for (var i in params) {
        if (params[i] === undefined)continue;
        var p = encodeURIComponent(i);
        var v = params[i];
        if (v !== '%%') p += '=' + v;
        search.push(p);
    }
    search = search.join('&');


    //create final url
    var fixed = location && location.replace(/\s/g, '').length ? location : realLocation;
    if (search.replace(/\s/g, '').length)
        fixed += '?' + search;

    window.location = fixed;
}