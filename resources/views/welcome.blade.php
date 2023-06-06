<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard Emisi GRK</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

        <link href="{{ asset('assets/devextreme/materialbluelightcompact.css') }}" rel="stylesheet" />
        
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
        <link href="{{ mix('css/template.css') }}" rel="stylesheet">

        <style>
            .intensitas-bg{
                /* height: 300px; */
                display: block;
                background-color: #FFF7EA;
                background-image: url( '/assets/media/icons/pkt/Pattern-yellow.svg' );
                background-repeat: no-repeat;
                background-position: top right;
                background-size: 110px;
                padding:10px;
                border-radius: 15px;
            }
            .pattern_back-bg{
                /* height: 300px; */
                display: block;
                background-color: #F7FAFC;
                background-image: url( '/assets/media/logos/pattern_back_svg.svg' );
                background-repeat: no-repeat;
                background-position: top right;
                /* background-size: 75px; */
            }
            .el-select{
                width: 100% !important;
            }
            .zoomout{
                zoom: 70%;
            }
            .icon_info{
                background-image: url( '/assets/media/logos/info.svg' );
            }

            .custom-tooltip {
            position: relative;
            display: inline-block;
            }

            .tooltip {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
            }

            .custom-tooltip button {
            border: none;
            background-color: transparent;
            cursor: pointer;
            }

            .wr_primary{
                background-color: #1268B3 !important;
            }
        </style>

        
    </head>
    
    <body>
        <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
        <div id="app">
            <router-view></router-view>
        </div>
        
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

        <script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
    </body>
</html>
