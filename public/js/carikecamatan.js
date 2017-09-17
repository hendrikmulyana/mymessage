/**
 * Created by EBOD on 7/27/2017.
 */
$(document).ready(function () {
    $("#kabkot").click(function () {
        var kabval=$("#kabkot").val();
        $.post('http://lotus.com/api/searchKec',{kabval:kabval},function (match) {
            $("#kecamatan").html(match);
        });
    });
});