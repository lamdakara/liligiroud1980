
$(".offre-item").click(function (e) {
    var value = $(this).data('id');
    console.log('value: ' + value);
    $.ajax({
        type: "POST",
        url: $(this).data('url'),
        async: true,
        data: {},
        success: function () {
            console.log('success increment');
        }
    });
});
