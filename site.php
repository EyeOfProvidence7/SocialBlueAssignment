
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <form action="site.php" method="post">
            <div>
                <label for="ingredients">Ingredients:</label>
                <textarea cols="80" rows="10" id="ingredients" name="ingredients"></textarea>
            </div>
            <div style="padding-top: 20px">
                <label for="calories">Limit calories to 500:</label>
                <input type="hidden" name="calories" value="0">
                <input type="checkbox" id="calories" name="calories" value="1">
            </div>
            <div style="padding-top: 20px">
                <input id="submit" type="submit">
            </div>
        </form>

    </body>
    <script src="https://cdn.jsdelivr.net/gh/akjpro/form-anticlear/base.js"></script>
</html>

<?php

include 'SolutionRunner.class.php';

if (!empty($_POST)) {
    SolutionRunner::runSolution($_POST["ingredients"], $_POST["calories"]);
}
?>