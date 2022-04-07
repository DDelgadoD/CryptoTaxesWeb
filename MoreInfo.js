$(document).ready(function(){
    $('.info').click(function(){
        var clickBtnValue = $(this).val();
		alert(clickBtnValue);
        var ajaxurl = 'MoreInfo.php',
        data =  {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    });
});