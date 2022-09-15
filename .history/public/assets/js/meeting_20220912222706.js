function enabledChange(id, changePath) {
    var value = $(this).val();
    console.log('value: ' + value);
    $.ajax({
        type: "POST",
        url: changePath,
        async: true,
        data: { },
        success: function () {
            console.log('success');
        }
    });
}


