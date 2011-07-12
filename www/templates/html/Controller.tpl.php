<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <title>Package Search</title>
    </head>
    <body>
        <form>
            <input type="text" name="q" id="q" />
            <select name="channel">
                <option value="">all</option>
<?php
$channels = $context->getModel();
foreach ($channels as $channel) {
    echo "\t\t" . '<option value="' . $channel['id'] . '">';
    echo $channel['name'];
    echo '</option>' . PHP_EOL;
}
?>
            </select>
            <a href="#" id="search">Search</a>
        </form>
        <ul id="result">

        </ul>
        <script type="text/javascript">
        /* <![CDATA[ */
        var channels = [];
<?php
foreach ($channels as $channel) {
    echo "\tchannels[{$channel['id']}] = '{$channel['name']}';" . PHP_EOL;
}
echo PHP_EOL;
?>
        $(document).ready(function(){
            $('#search').click(function(){
                $('#result li').remove();
                $.get('?q=' + $('#q').val(), function(data){
                    var li = $('<li>');
                    $.each(data, function(key, info) {
                        console.log(key);
                        $('#result').append('<li>' + key + ': pear install ' + channels[info.channel_id] + '/key</li>');
                    });
                });
            });
        });
        /* ]]>*/
        </script>
    </body>
</html>
