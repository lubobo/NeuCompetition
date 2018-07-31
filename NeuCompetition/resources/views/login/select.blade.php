<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>选择角色</title>

    <style>
        /*! normalize.css v2.1.2 | MIT License | git.io/normalize */

        /* ==========================================================================
           HTML5 display definitions
           ========================================================================== */

        /**
         * Correct `block` display not defined in IE 8/9.
         */

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section,
        summary {
            display: block;
        }

        /**
         * Correct `inline-block` display not defined in IE 8/9.
         */

        audio,
        canvas,
        video {
            display: inline-block;
        }

        /**
         * Prevent modern browsers from displaying `audio` without controls.
         * Remove excess height in iOS 5 devices.
         */

        audio:not([controls]) {
            display: none;
            height: 0;
        }

        /**
         * Address styling not present in IE 8/9.
         */

        [hidden] {
            display: none;
        }

        /* ==========================================================================
           Base
           ========================================================================== */

        /**
         * 1. Set default font family to sans-serif.
         * 2. Prevent iOS text size adjust after orientation change, without disabling
         *    user zoom.
         */

        html {
            font-family: sans-serif; /* 1 */
            -ms-text-size-adjust: 100%; /* 2 */
            -webkit-text-size-adjust: 100%; /* 2 */
        }

        /**
         * Remove default margin.
         */

        body {
            margin: 0;
        }

        /* ==========================================================================
           Links
           ========================================================================== */

        /**
         * Address `outline` inconsistency between Chrome and other browsers.
         */

        a:focus {
            outline: thin dotted;
            text-decoration: none;
        }

        /**
         * Improve readability when focused and also mouse hovered in all browsers.
         */

        a:active,
        a:hover {
            outline: 0;
        }

        /* ==========================================================================
           Typography
           ========================================================================== */

        /**
         * Address variable `h1` font-size and margin within `section` and `article`
         * contexts in Firefox 4+, Safari 5, and Chrome.
         */

        h1 {
            font-size: 2em;
            margin: 0.67em 0;
        }

        /**
         * Address styling not present in IE 8/9, Safari 5, and Chrome.
         */

        abbr[title] {
            border-bottom: 1px dotted;
        }

        /**
         * Address style set to `bolder` in Firefox 4+, Safari 5, and Chrome.
         */

        b,
        strong {
            font-weight: bold;
        }

        /**
         * Address styling not present in Safari 5 and Chrome.
         */

        dfn {
            font-style: italic;
        }

        /**
         * Address differences between Firefox and other browsers.
         */

        hr {
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            height: 0;
        }

        /**
         * Address styling not present in IE 8/9.
         */

        mark {
            background: #ff0;
            color: #000;
        }

        /**
         * Correct font family set oddly in Safari 5 and Chrome.
         */

        code,
        kbd,
        pre,
        samp {
            font-family: monospace, serif;
            font-size: 1em;
        }

        /**
         * Improve readability of pre-formatted text in all browsers.
         */

        pre {
            white-space: pre-wrap;
        }

        /**
         * Set consistent quote types.
         */

        q {
            quotes: "\201C" "\201D" "\2018" "\2019";
        }

        /**
         * Address inconsistent and variable font size in all browsers.
         */

        small {
            font-size: 80%;
        }

        /**
         * Prevent `sub` and `sup` affecting `line-height` in all browsers.
         */

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline;
        }

        sup {
            top: -0.5em;
        }

        sub {
            bottom: -0.25em;
        }

        /* ==========================================================================
           Embedded content
           ========================================================================== */

        /**
         * Remove border when inside `a` element in IE 8/9.
         */

        /**
         * Correct overflow displayed oddly in IE 9.
         */

        svg:not(:root) {
            overflow: hidden;
        }

        /* ==========================================================================
           Figures
           ========================================================================== */

        /**
         * Address margin not present in IE 8/9 and Safari 5.
         */

        figure {
            margin: 0;
        }

        /* ==========================================================================
           Forms
           ========================================================================== */

        /**
         * Define consistent border, margin, and padding.
         */

        fieldset {
            border: 1px solid #c0c0c0;
            margin: 0 2px;
            padding: 0.35em 0.625em 0.75em;
        }

        /**
         * 1. Correct `color` not being inherited in IE 8/9.
         * 2. Remove padding so people aren't caught out if they zero out fieldsets.
         */

        legend {
            border: 0; /* 1 */
            padding: 0; /* 2 */
        }

        /**
         * 1. Correct font family not being inherited in all browsers.
         * 2. Correct font size not being inherited in all browsers.
         * 3. Address margins set differently in Firefox 4+, Safari 5, and Chrome.
         */

        button,
        input,
        select,
        textarea {
            font-family: inherit; /* 1 */
            font-size: 100%; /* 2 */
            margin: 0; /* 3 */
        }

        /**
         * Address Firefox 4+ setting `line-height` on `input` using `!important` in
         * the UA stylesheet.
         */

        button,
        input {
            line-height: normal;
        }

        /**
         * Address inconsistent `text-transform` inheritance for `button` and `select`.
         * All other form control elements do not inherit `text-transform` values.
         * Correct `button` style inheritance in Chrome, Safari 5+, and IE 8+.
         * Correct `select` style inheritance in Firefox 4+ and Opera.
         */

        button,
        select {
            text-transform: none;
        }

        /**
         * 1. Avoid the WebKit bug in Android 4.0.* where (2) destroys native `audio`
         *    and `video` controls.
         * 2. Correct inability to style clickable `input` types in iOS.
         * 3. Improve usability and consistency of cursor style between image-type
         *    `input` and others.
         */

        button,
        html input[type="button"], /* 1 */
        input[type="reset"],
        input[type="submit"] {
            -webkit-appearance: button; /* 2 */
            cursor: pointer; /* 3 */
        }

        /**
         * Re-set default cursor for disabled elements.
         */

        button[disabled],
        html input[disabled] {
            cursor: default;
        }

        /**
         * 1. Address box sizing set to `content-box` in IE 8/9.
         * 2. Remove excess padding in IE 8/9.
         */

        input[type="checkbox"],
        input[type="radio"] {
            box-sizing: border-box; /* 1 */
            padding: 0; /* 2 */
        }

        /**
         * 1. Address `appearance` set to `searchfield` in Safari 5 and Chrome.
         * 2. Address `box-sizing` set to `border-box` in Safari 5 and Chrome
         *    (include `-moz` to future-proof).
         */

        input[type="search"] {
            -webkit-appearance: textfield; /* 1 */
            -moz-box-sizing: content-box;
            -webkit-box-sizing: content-box; /* 2 */
            box-sizing: content-box;
        }

        /**
         * Remove inner padding and search cancel button in Safari 5 and Chrome
         * on OS X.
         */

        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        /**
         * Remove inner padding and border in Firefox 4+.
         */

        button::-moz-focus-inner,
        input::-moz-focus-inner {
            border: 0;
            padding: 0;
        }

        /**
         * 1. Remove default vertical scrollbar in IE 8/9.
         * 2. Improve readability and alignment in all browsers.
         */

        textarea {
            overflow: auto; /* 1 */
            vertical-align: top; /* 2 */
        }

        /* ==========================================================================
           Tables
           ========================================================================== */

        /**
         * Remove most spacing between table cells.
         */

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
    </style>

    <style>
        @import url(http://fonts.useso.com/css?family=Lato:400,900|Montez);
        .sparkley {
            background: #3e5771;
            color: white;
            border: none;
            padding: 16px 36px;
            font-weight: normal;
            border-radius: 3px;
            transition: all 0.25s ease;
            box-shadow: 0 38px 32px -23px black;
            margin: 0 1em 1em;
        }
        .sparkley:hover {
            background: #2c3e50;
            color: rgba(255, 255, 255, 0.2);
        }

        html {
            font-family: Lato;
            font-weight: 200;
            font-size: 1em;
            text-align: center;
            color: #ddd;
            min-height: 100%;
            background: #092756;
            background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(35, 24, 82, 0.22) 10%, rgba(138, 114, 76, 0) 40%), -moz-linear-gradient(top, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%), -moz-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(35, 24, 82, 0.22) 10%, rgba(138, 114, 76, 0) 40%), -webkit-linear-gradient(top, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%), -webkit-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -o-radial-gradient(0% 100%, ellipse cover, rgba(35, 24, 82, 0.22) 10%, rgba(138, 114, 76, 0) 40%), -o-linear-gradient(top, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%), -o-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(35, 24, 82, 0.22) 10%, rgba(138, 114, 76, 0) 40%), -ms-linear-gradient(top, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%), -ms-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(35, 24, 82, 0.22) 10%, rgba(138, 114, 76, 0) 40%), linear-gradient(to bottom, rgba(57, 173, 219, 0.25) 0%, rgba(42, 60, 87, 0.4) 100%), linear-gradient(135deg, #670d10 0%, #092756 100%);
        }
        html body {
            padding: 50px;
        }

        h1 span, h2 span, h3 span {
            font-family: Montez;
            font-size: 1.9em;
            font-weight: 300;
            margin: 0 0.3em;
            color: #ff0080;
        }

        h1 {
            font-size: 1.9em;
            width: 900px;
            margin: 0 auto 1em;
            text-shadow: 0 2px 1px black;
        }

        p {
            padding: 5px 10px;
            display: inline-block;
            margin: 10px auto;
        }

    </style>

    <script src="../register/js/prefixfree.min.js"></script>
    <script src="../register/js/modernizr.js"></script>

</head>

<body>

<h1>A little canvas script to <span>add magic</span> to DOM elements!</h1>

<a class="sparkley" href="/register/teacher" style="text-decoration: none">I am a teacher</a>
<a class="sparkley last" href="/register/student" style="text-decoration: none">I am a student</a>

<div style="text-align:center;clear:both;margin-top:30px">
    <script src="/gg_bd_ad_720x90.js" type="text/javascript"></script>
    <script src="/follow.js" type="text/javascript"></script>
</div>

<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
<script >
    // http://paulirish.com/2011/requestanimationframe-for-smart-animating/
    // http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

    // requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel

    // MIT license

    (function() {
        var lastTime = 0;
        var vendors = ['ms', 'moz', 'webkit', 'o'];
        for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
            window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
            window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
                    || window[vendors[x]+'CancelRequestAnimationFrame'];
        }

        if (!window.requestAnimationFrame)
            window.requestAnimationFrame = function(callback, element) {
                var currTime = new Date().getTime();
                var timeToCall = Math.max(0, 16 - (currTime - lastTime));
                var id = window.setTimeout(function() { callback(currTime + timeToCall); },
                        timeToCall);
                lastTime = currTime + timeToCall;
                return id;
            };

        if (!window.cancelAnimationFrame)
            window.cancelAnimationFrame = function(id) {
                clearTimeout(id);
            };
    }());
</script>

<script >
    $(function() {


        // default is varying levels of transparent white sparkles
        $(".sparkley:first").sparkleh();

        // rainbow as a color generates random rainbow colros
        // count determines number of sparkles
        // overlap allows sparkles to migrate... watch out for other dom elements though.
        $(".sparkley:last").sparkleh({
            color: "rainbow",
            count: 100,
            overlap: 10
        });

        // here we create fuscia sparkles
        $("h1").sparkleh({
            count: 80,
            color: "#ff0080"
        });



        $("p").sparkleh({
            count: 20,
            color: "#00ff00"
        });


        // an array can be passed, too for colours
        // for an image, the image needs to be fully loaded to set
        // the canvas to it's height/width.
        $("#image").imagesLoaded( function() {
            $(".img").sparkleh({
                count: 25,
                color: ["#00afec","#fb6f4a","#fdfec5"]
            });
        });


    });







    $.fn.sparkleh = function( options ) {

        return this.each( function(k,v) {

            var $this = $(v).css("position","relative");

            var settings = $.extend({
                width: $this.outerWidth(),
                height: $this.outerHeight(),
                color: "#FFFFFF",
                count: 30,
                overlap: 0
            }, options );

            var sparkle = new Sparkle( $this, settings );

            $this.on({
                "mouseover focus" : function(e) {
                    sparkle.over();
                },
                "mouseout blur" : function(e) {
                    sparkle.out();
                }
            });

        });

    }




    function Sparkle( $parent, options ) {
        this.options = options;
        this.init( $parent );
    }

    Sparkle.prototype = {

        "init" : function( $parent ) {

            var _this = this;

            this.$canvas =
                    $("<canvas>")
                            .addClass("sparkle-canvas")
                            .css({
                                position: "absolute",
                                top: "-"+_this.options.overlap+"px",
                                left: "-"+_this.options.overlap+"px",
                                "pointer-events": "none"
                            })
                            .appendTo($parent);

            this.canvas = this.$canvas[0];
            this.context = this.canvas.getContext("2d");
            this.sprite = new Image();

            this.canvas.width = this.options.width + ( this.options.overlap * 2);
            this.canvas.height = this.options.height + ( this.options.overlap * 2);

            this.sprites = [0,6,13,20];
            this.particles = this.createSparkles( this.canvas.width , this.canvas.height );

            this.anim = null;
            this.fade = false;

        },

        "createSparkles" : function( w , h ) {

            var holder = [];

            for( var i = 0; i < this.options.count; i++ ) {

                var color = this.options.color;

                if( this.options.color == "rainbow" ) {
                    color = '#'+Math.floor(Math.random()*16777215).toString(16);
                } else if( $.type(this.options.color) === "array" ) {
                    color = this.options.color[ Math.floor(Math.random()*this.options.color.length) ];
                }

                holder[i] = {
                    position: {
                        x: Math.floor(Math.random()*w),
                        y: Math.floor(Math.random()*h)
                    },
                    style: this.sprites[ Math.floor(Math.random()*4) ],
                    delta: {
                        x: Math.floor(Math.random() * 1000) - 500,
                        y: Math.floor(Math.random() * 1000) - 500
                    },
                    size: parseFloat((Math.random()*2).toFixed(2)),
                    color: color
                };

            }

            return holder;

        },

        "draw" : function( time, fade ) {

            var ctx = this.context;
            var img = this.sprite;
            img.src = this.datauri;

            ctx.clearRect( 0, 0, this.canvas.width, this.canvas.height );

            for( var i = 0; i < this.options.count; i++ ) {

                var derpicle = this.particles[i];
                var modulus = Math.floor(Math.random()*7);

                if( Math.floor(time) % modulus === 0 ) {
                    derpicle.style = this.sprites[ Math.floor(Math.random()*4) ];
                }

                ctx.save();
                ctx.globalAlpha = derpicle.opacity;
                ctx.drawImage(img, derpicle.style, 0, 7, 7, derpicle.position.x, derpicle.position.y, 7, 7);

                if( this.options.color ) {

                    ctx.globalCompositeOperation = "source-atop";
                    ctx.globalAlpha = 0.5;
                    ctx.fillStyle = derpicle.color;
                    ctx.fillRect(derpicle.position.x, derpicle.position.y, 7, 7);

                }

                ctx.restore();

            }


        },

        "update" : function() {

            var _this = this;

            this.anim = window.requestAnimationFrame( function(time) {

                for( var i = 0; i < _this.options.count; i++ ) {

                    var u = _this.particles[i];

                    var randX = ( Math.random() > Math.random()*2 );
                    var randY = ( Math.random() > Math.random()*3 );

                    if( randX ) {
                        u.position.x += (u.delta.x / 1500);
                    }

                    if( !randY ) {
                        u.position.y -= (u.delta.y / 800);
                    }

                    if( u.position.x > _this.canvas.width ) {
                        u.position.x = -7;
                    } else if ( u.position.x < -7 ) {
                        u.position.x = _this.canvas.width;
                    }

                    if( u.position.y > _this.canvas.height ) {
                        u.position.y = -7;
                        u.position.x = Math.floor(Math.random()*_this.canvas.width);
                    } else if ( u.position.y < -7 ) {
                        u.position.y = _this.canvas.height;
                        u.position.x = Math.floor(Math.random()*_this.canvas.width);
                    }

                    if( _this.fade ) {
                        u.opacity -= 0.02;
                    } else {
                        u.opacity -= 0.005;
                    }

                    if( u.opacity <= 0 ) {
                        u.opacity = ( _this.fade ) ? 0 : 1;
                    }

                }

                _this.draw( time );

                if( _this.fade ) {
                    _this.fadeCount -= 1;
                    if( _this.fadeCount < 0 ) {
                        window.cancelAnimationFrame( _this.anim );
                    } else {
                        _this.update();
                    }
                } else {
                    _this.update();
                }

            });

        },

        "cancel" : function() {

            this.fadeCount = 100;

        },

        "over" : function() {

            window.cancelAnimationFrame( this.anim );

            for( var i = 0; i < this.options.count; i++ ) {
                this.particles[i].opacity = Math.random();
            }

            this.fade = false;
            this.update();

        },

        "out" : function() {

            this.fade = true;
            this.cancel();

        },



        "datauri" : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABsAAAAHCAYAAAD5wDa1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDozNDNFMzM5REEyMkUxMUUzOEE3NEI3Q0U1QUIzMTc4NiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDozNDNFMzM5RUEyMkUxMUUzOEE3NEI3Q0U1QUIzMTc4NiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjM0M0UzMzlCQTIyRTExRTM4QTc0QjdDRTVBQjMxNzg2IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjM0M0UzMzlDQTIyRTExRTM4QTc0QjdDRTVBQjMxNzg2Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+jzOsUQAAANhJREFUeNqsks0KhCAUhW/Sz6pFSc1AD9HL+OBFbdsVOKWLajH9EE7GFBEjOMxcUNHD8dxPBCEE/DKyLGMqraoqcd4j0ChpUmlBEGCFRBzH2dbj5JycJAn90CEpy1J2SK4apVSM4yiKonhePYwxMU2TaJrm8BpykpWmKQ3D8FbX9SOO4/tOhDEG0zRhGAZo2xaiKDLyPGeSyPM8sCxr868+WC/mvu9j13XBtm1ACME8z7AsC/R9r0fGOf+arOu6jUwS7l6tT/B+xo+aDFRo5BykHfav3/gSYAAtIdQ1IT0puAAAAABJRU5ErkJggg=="

    };





    // $('img.photo',this).imagesLoaded(myFunction)
    // execute a callback when all images have loaded.
    // needed because .load() doesn't work on cached images

    // mit license. paul irish. 2010.
    // webkit fix from Oren Solomianik. thx!

    // callback function is passed the last image to load
    //   as an argument, and the collection as `this`


    $.fn.imagesLoaded = function(callback){
        var elems = this.filter('img'),
                len   = elems.length,
                blank = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

        elems.bind('load.imgloaded',function(){
            if (--len <= 0 && this.src !== blank){
                elems.unbind('load.imgloaded');
                callback.call(elems,this);
            }
        }).each(function(){
            // cached images don't fire load sometimes, so we reset src.
            if (this.complete || this.complete === undefined){
                var src = this.src;
                // webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
                // data uri bypasses webkit log warning (thx doug jones)
                this.src = blank;
                this.src = src;
            }
        });

        return this;
    };
</script>

</body>

</html>