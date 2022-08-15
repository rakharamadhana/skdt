var convertToPercent = function(data) { 
    if(data == null)
        return '-';
    return toNumeric(data)+'%';
}

var convertToNumeric = function(data) { 
    if(data == null)
        return '-';
    return toNumeric(data);
}

var convertToCurrency = function(data) { 
    if(data == null)
        return '-';
    return 'Rp'+toNumeric(data);
}

function toNumeric(x){
    if(x == null)
        return 0;
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function toCurrency(x){
    if(x == null)
        return 'Rp 0';
        
    var rounded_x = Math.round(x);
    return 'Rp '+rounded_x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}