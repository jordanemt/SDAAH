function login() {
    var url = "?controller=Session&action=login";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        success: function () {
            successMessage('Index');
        },
        error: function (error) {
            errorMessage(error.responseText, 'Index');
        }
    });
}

function logout() {
    var url = "?controller=Session&action=logout";
    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        success: function () {
            window.location.replace("?controller=Index");
        },
        error: function (error) {
            errorMessage(error.responseText, 'Index');
        }
    });
}