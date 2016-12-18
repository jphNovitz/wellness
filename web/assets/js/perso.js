/**
 * javascript code personnel
 */

<script>

$("<div class='card-rows'>").appendTo('#liste');

for (var i = 0; i < 10; i++) {
    $('.card-rows')
        .append($('<div class="card-row">')
            .load("{{ asset('assets/_partials/essai.html.twig') }}"));


}
$('.card-row .card-row-inner').each(function () {
    console.log(this);



});


</script>

/*
$(document).ready(

    function () {
        console.log('readey');
        $("#popol").click(function () {
            console.log("hello");
            //$("#vid").text({%include ('_partials/footer.html.twig') %});
            essai=$("#popol").data("zzz");
            val=$("#popol").data("val");
            console.log(val);
            val=JSON.stringify(val);
            console.log(val);

            $("#vid").load(essai+"?services="+val, function () {

            });

        });

    }
);*/

/*$(document).ready(
    function () {
        $.get('#popol').click(function () {
            console.log('click');
            var cat;
            $.ajax({
                url: "{{ path('services_get') }}",
                method: "get",
                data: cat,
                success: function (data) {
                    console.log(data);

                },
                fail: function () {
                    console.log("ok");

                }

            });
        });



    }
);*/

