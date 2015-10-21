<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta id="token" content="{{ csrf_token() }}"/>

    <link rel="stylesheet" href="/assets/css/main.css">

    <link rel="import" href="/bower_components/slider/slider.html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

{{--<style>--}}
    {{--#topNav2 {--}}
        {{--position: absolute;--}}
        {{--top: 10px;--}}
        {{--left: 10px;--}}
        {{--z-index: 1000;--}}
    {{--}--}}

    {{--#topNav2 a {--}}
        {{--color: white;--}}
    {{--}--}}
{{--</style>--}}
{{--<nav id="topNav2">--}}
    {{--<a href="#/skills"><span>skills</span></a>--}}
    {{--<a href="#/work"><span>work</span></a>--}}
    {{--<a href="#/"><span>about</span></a>--}}
    {{--<a href="#/contact"><span>contact</span></a>--}}
{{--</nav>--}}

{{--<a href="#/" class="logo">--}}
    {{--<canvas id="canvasLogo"></canvas>--}}
{{--</a>--}}

<script type="text/template" id="tmplSkill">
    <div class="works-work-title">
        <span><%=title%></span>
    </div>
    {{--<div class="works-img">--}}
        {{--<div class="img-bg" style="background-image:url('assets/img/skills/<%=nameImg%>.png')"></div>--}}
    {{--</div>--}}
</script>

<script type="text/template" id="tmplScoreBoard">
    <div title="Time limit" class="timeLimit">
        <svg version="1.1" width="22" xmlns="http://www.w3.org/2000/svg" preserveaspectratio="xMidYMid meet"
             viewbox="0 0 50 50" space="preserve" data-icon="time" class="i-svg">
            <path d="M7.533,21.646C9.111,13.06,16.633,6.552,25.678,6.552c10.188,0,18.447,8.259,18.447,18.448 c0,10.19-8.259,18.447-18.447,18.447c-7.167,0-13.378-4.084-16.433-10.053h3.886c2.708,4.039,7.317,6.699,12.547,6.699 c8.336,0,15.094-6.758,15.094-15.094S34.014,9.907,25.678,9.907c-7.184,0-13.195,5.018-14.72,11.739H7.533L7.533,21.646z M24.838,25.587l8.74,5.151l0.851-1.444l-7.913-4.706V13.314h-1.678V25.587z M8.906,28.354l5.031-6.708H3.875L8.906,28.354z M7.533,21.646C9.111,13.06,16.633,6.552,25.678,6.552c10.188,0,18.447,8.259,18.447,18.448c0,10.19-8.259,18.447-18.447,18.447 c-7.167,0-13.378-4.084-16.433-10.053h3.886c2.708,4.039,7.317,6.699,12.547,6.699c8.336,0,15.094-6.758,15.094-15.094 S34.014,9.907,25.678,9.907c-7.184,0-13.195,5.018-14.72,11.739H7.533L7.533,21.646z M24.838,25.587l8.74,5.151l0.851-1.444 l-7.913-4.706V13.314h-1.678V25.587z M8.906,28.354l5.031-6.708H3.875L8.906,28.354z"
                  fill="#6a6a6a"></path>
        </svg>
        <div class="timeLimitCounter"><span id="timer">30</span>s</div>
    </div>
    <div id="loader" class="loader">
        <div id="loaderSlip" class="loaderSlip"></div>
    </div>
</script>

<script type="text/template" id="tmplBoardResult">
    <div class="resultsTable">
        <div>
            <div class="resultsClose"></div>
            <h3><span id="resScore">000</span> points</h3>
            <ul>
                <li>
                    <div>TIME</div>
                    <div id="resTimeSpend">0.001s</div>
                </li>
                <li>
                    <div>SHOOTS</div>
                    <div id="resShoots">0</div>
                </li>
                <li>
                    <div>DESTROYED</div>
                    <div id="resDestroyed">0</div>
                </li>
                <li>
                    <div>ACCURACY</div>
                    <div><span id="resAccuracy">0</span>%</div>
                </li>
                <li>
                    <div><span>YOUR BEST</span></div>
                    <div id="resBestScore">000</div>
                </li>
            </ul>
            <a id="openBoardLeader" class="linkBtn">VIEW LEADERBOARD</a>
        </div>
    </div>
</script>

<script type="text/template" id="tmplBoardLeader">
    <div class="leaderTable">
        <div>
            <div class="resultsClose"></div>
            <h3>LEADERBOARD</h3>
            <ul id="topLeaders"></ul>
        </div>
    </div>
</script>
<script type="text/template" id="tmplLeader">
    <div><%=i%>st <span><%=name%></span></div>
    <div><%=score%></div>
</script>
<script type="text/template" id="tmplYourScore">
    <div><%=i%>st <span id="resultName"><input id="resultNameInput" autofocus placeholder="your name"
                                               maxlength="15"></span></div>
    <div><a class="linkBtn" id="saveScore">SAVE</a> <%=score%></div>
</script>

<script type="text/template" id="tmplMenu">
    <a href="#/"><span>game</span></a>
    <a href="#/work"><span>work</span></a>
    <a href="#/skills"><span>skills</span></a>
    <a href="#/contact"><span>contact</span></a>
</script>

<script type="text/template" id="tmplWork">
    <div class="works-work-title">
        <i></i>
        <span><%=nameTitle%></span>
    </div>
    <div class="works-img" style="background-image:url('assets/img/portfolio/gallery/<%=href%>/0.jpg')">
        <div class="works-img-desc">
            <% _.each(skills, function(skill) { %>
            <div><%=skill%></div>
            <% }); %>
        </div>
            <div class="works-logo" style="background-image: url('assets/img/portfolio/gallery/<%=href%>/logo.png')">
        </div>
    </div>
</script>

<script type="text/template" id="tmplDesc">
    <h1><%=nameCompany%> - <%=nameTitle%></h1>
    <p><%=descCompany%></p>
    <% if (link) { %>
    <p>
        <span class="stripe">
            <a href="<%=link%>" target="_blank">Visit the page</a>
        </span>
    </p>
    <% } %>
    <awesome-slider pre-image="/assets/img/portfolio/gallery/<%=href%>/logo.png" autostart="true" bullets="true">
        <% for (var i = 1; i <= numberImg; i++) { %>
            <item source="/assets/img/portfolio/gallery/<%=href%>/<%=i%>.jpg"></item>
        <% } %>
    </awesome-slider>
    <% if (descDeal) { %>
    <div class="section">
        <%=descDeal%>
    </div>
    <% } if (0 < skills.length) { %>
    <div class="section">
        <h2>Technologies</h2>
        <i>Code technologies and skills I got involved while working on this project</i>
        <hr>
        <ul>
        <% for (var i = 0, len = skills.length; i < len; i++) { %>
            <li><%=skills[i]%></li>
        <% } %>
        <ul>
    </div>
    <% } %>
</script>


<script type="text/template" id="tmplResume">
    <h2>About</h2>
    <p>Professional Front-end web developer with 5 years old experience<br>
        Highly skilled at JavaScript including OOP, Single Page Applications,<br>
        MVC/MVVM patterns, HTML5 layout for desktop and mobile.
    </p>
    <h2>Last jobs:</h2>
    <p class="with-link">
        Bank of Moscow -
        <span class="stripe"><a href="http://www.bm.ru" target="_blank">www.bm.ru</a></span>
        - 2012-2015<br>
        Anywayanyday -
        <span class="stripe"><a href="http://www.anywayanyday.com" target="_blank">www.anywayanyday.com</a></span>
        - 2011<br>
        Advertising Boulevard -
        <span class="stripe"><a href="http://www.designbox.ru/eng" target="_blank">www.designbox.ru/eng</a></span>
        - 2010
    </p>
    <h2>Education</h2>
    <p>Bachelor of Science in Computer Science - 2002-2007</p>
</script>

<script type="text/template" id="tmplContact">
<div class="content">
    <h1>I am freelancing</h1>
    <p>I am currently based in Moscow. Wanna talk to me about a project or hire me for a freelance?</p>
    <p>Just send an email to
        <a href="mailto:1kuzroman@gmail.com">1kuzroman@gmail.com</a>
        and let's talk.
    </p>
    <div class="social">
        <a class="facebook" href="https://www.facebook.com/profile.php?id=100001773679921" target="_blank">facebook</a>
        <a class="linkedin" href="https://www.linkedin.com/in/kuzroman" target="_blank">linkedin</a>
    </div>
</div>
</script>

{{--
    ul#nav>li.item$*4>a{item $}
    div>(header>ul>li*2>a)+footer>p
    div+div>p>span+em^^^bq
    (div>dl>(dt+dd)*3)+footer>p
    ul>li.item$@-*5 // change numbering direction
    ul>li.item$@3*5 // change counter base
    p*4>lorem
--}}



{{--<script src="node_modules/jquery/dist/jquery.js"></script>--}}
{{--<script src="node_modules/underscore/underscore.js"></script>--}}
{{--<script src="node_modules/backbone/backbone.js"></script>--}}

{{--<script src="assets/js/routers.js"></script>--}}

<script src="dist/main.js"></script>

</body>
</html>