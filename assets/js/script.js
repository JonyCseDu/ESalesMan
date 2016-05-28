function redirect(){
    var sItem = document.getElementById("search-box").value;
    var optItem = document.getElementById("selectOption").value;
    var url = "/presentation/home?";
    var flag = false;
    if(sItem.length > 0){
        url += "name=" + '"' + sItem + '"';
        flag = true;
    }

    if(optItem.length > 0){
        if(flag) url += "&";
        url += "option=" + '"' + optItem + '"';
    }
    console.log(url);
    window.location=url;
}

function myFucntion(){
	alert(5+4);
}