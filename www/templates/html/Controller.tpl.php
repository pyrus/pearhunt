<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <title>Package Search</title>
        <style type="text/css">
        body { font-family:arial;color:#000;margin:50px;}
        .package { font-weight:bold;}
        .code { font-family: Courier; font-size:10pt; }
        #search { text-decoration:none; background:#ccc; color:#000; margin:#000; padding:4px; }
        </style>
    </head>
    <body>
        <h1>Search for a package</h1>
        <form id="form">
            <input type="text" name="q" id="q" />
            <select name="channel" id="channel">
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
            $('#form').submit(function(){
                $('#search').trigger('click');
                return false;
            });
            $('#search').click(function(){
                $('#result li').remove();
                $.get('?q=' + $('#q').val(), function(data){
                    $.each(data, function(key, info) {
                        if ($('#channel').val() != '') {
                            if ($('#channel').val() != info.channel_id) {
                                return;
                            }
                        }
                        $('#result').append('<li><span class="package">' + key + '</span>: <span class="code">pyrus install ' + channels[info.channel_id] + '/' + key + '</span></li>');
                    });
                    if (0 == $('#result').children().length) {
                        $('#result').append('<li>No results found</li>');
                    }
                });
            });
        });
        /* ]]>*/
        </script>
    </body>
</html>
