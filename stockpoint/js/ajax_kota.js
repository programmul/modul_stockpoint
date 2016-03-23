var ajaxku;
function ajaxkota(id){
    ajaxku = buatajax();
    var loc = window.location.protocol + '//' + window.location.host;
    var url= loc + "/lib/select_kota.php";
    url=url+"?q="+id;
    alert(url);
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChanged();
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function ajaxkec(id){
    ajaxku = buatajax();
    var url="/lib/select_kota.php";
    url=url+"?kec="+id;
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChangedKec;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function ajaxkel(id){
    ajaxku = buatajax();
    var url="/lib/select_kota.php";
    url=url+"?kel="+id;
    url=url+"&sid="+Math.random();
    ajaxku.onreadystatechange=stateChangedKel;
    ajaxku.open("GET",url,true);
    ajaxku.send(null);
}

function buatajax(){
    if (window.XMLHttpRequest){
    return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
    return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}
function stateChanged(){
    var data;
    if (ajaxku.readyState==4){
    data=ajaxku.responseText;
    if(data.length>=0){
    document.getElementById("kota").innerHTML = data
    }else{
    document.getElementById("kota").value = "<option selected>Pilih Kota/Kab</option>";
    }
    }
}

function stateChangedKec(){
    var data;
    if (ajaxku.readyState==4){
    data=ajaxku.responseText;
    if(data.length>=0){
    document.getElementById("kec").innerHTML = data
    }else{
    document.getElementById("kec").value = "<option selected>Pilih Kecamatan</option>";
    }
    }
}

function stateChangedKel(){
    var data;
    if (ajaxku.readyState==4){
    data=ajaxku.responseText;
    if(data.length>=0){
    document.getElementById("kel").innerHTML = data
    }else{
    document.getElementById("kel").value = "<option selected>Pilih Mamokuhan/Desa</option>";
    }
    }
}