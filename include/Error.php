<style>
    #wrapper{
        background-color: black;
    }
    h1{
        text-align: center;
        color: white;
        margin-top: 4%;
    }
    #pic{
        width: 35%;
        margin: 0 auto;
    }
</style>
<div id = "pic">
    <img border="0" alt="HAL900" align="middle" width = "100%" src="../img/HAL900.png">
</div>
<h1>I'm sorry, <?php
    if(isset($_SESSION["username"]) && !empty($_SESSION["username"]) ){
        echo $_SESSION["username"];
    }
    else{
        echo "Dave";
    }
    ?>. I'm afraid I can't do that.</h1>
<!--Image borrowed from https://en.wikipedia.org/wiki/HAL_9000-->
