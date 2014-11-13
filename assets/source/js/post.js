$(document).ready(function () {
    ElFinderFileCallback.callFunction = function(id, file) {
        $("#thumbnail-container").html('<img src="' + file.url + '">');
        return this.functions[id](file, id);
    }
});