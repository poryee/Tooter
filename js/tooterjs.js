

var imgDir = [
    "url('css/bgImages/bg1.jpg')",
    "url('css/bgImages/bg2.jpeg')",
    "url('css/bgImages/bg3.jpeg')"
];

var captionArr = [
    "Selfie at the Tower! #tower #selfie",
    "Amazing night view of the city #nightview",
    "Checkout my ride that I've just gotten! #car"
];

var authorArr = [
    "jerry",
    "john",
    "tom"
];

var timeArr = [
    "8:20 PM - 12 Jul 2014",
    "5:02 PM - 28 Apr 2014",
    "3:13 PM - 10 Jul 2014"
];

window.addEventListener('load', init);

function init()
{
    setInterval("doSlideShow()", 5000);
    imgPreview();
    tag();
    $('#toot-text').on('input', count);

    document.getElementById('post-toot-image-btn-hidden').addEventListener('mousedown', function () {
        document.getElementById('post-toot-image-btn').style.borderStyle = "inset";
    });
    document.getElementById('post-toot-image-btn-hidden').addEventListener('mouseup', function () {
        document.getElementById('post-toot-image-btn').style.borderStyle = "outset";
    });

    $('.trigger').on("click", function (e) {
        $('.main-main').css("opacity", 0.3).fadeIn(300, function () {
            var img = document.createElement("img");
            img.id = "zoom-img";
            img.src = e.target.src;
            img.style.cssText = 'position: fixed; width: 50%; top: 50%; left: 50%; transform: translate(-50%,-50%);';
            img.addEventListener("click", function () {
                $("#zoom-img").remove();
                $('.main-main').css("opacity", 1).fadeIn(300);
            });
            $('body').append(img);
        });
        e.preventDefault();
    });

    $('.toot-buttons-rt').on('click', function () {
        var content = $(this).parent().siblings(".toot").html();
        var user = $(this).parent().siblings(".toot-hiddenuser").html();
        var oldcontent = $('#toot-text').html();
        $('#toot-text').html(oldcontent + "RT " + user + ' "' + content + '"');
        $('#post-toot-btn').prop("disabled", false);
        $('#toot-textarea').val($('#toot-text').html());
        count();
    });

    $('.toot-buttons-reply').on('click', function () {
        var user = $(this).parent().siblings(".toot-username").html();
        var oldcontent = $('#toot-text').html();
        $('#toot-text').html(oldcontent + user);
        $('#post-toot-btn').prop("disabled", false);
        $('#toot-textarea').val($('#toot-text').html());
        count();
    });
    
    $('#searchsub').on("click", function (){
        
        //var text = document.getElementById('searchtext').value;
        var str = document.getElementById('searchtext').value;
        if(str !== "")
        {
            var res = str.replace("#", "");
            var hash = document.getElementById('searchtext').value.substring(0, 1); 
            //alert(hash);
            if (hash === "#")
            {
                window.location.replace("http://sittooter.azurewebsites.net/Assignment/hashsearch.php?hashword="+res);
            }
            else
            {
                document.searchform.submit();
            }
        }
        
   
        
        
        
       //
    });
}

var inc = 0;
var homeMain = document.getElementById('home-main');

function doSlideShow() {

    var image = $('#index-bgi');
    image.fadeOut(1000, function () {
        image.css("background", imgDir[inc]);
        image.css("opacity", 0.9);
        image.css("backgroundSize", "cover");
        image.fadeIn();
    });

    var caption = $('#caption');
    var captionAuthor = $('#caption-author');
    var captionTime = $('#caption-time');

    caption.html(captionArr[inc]);
    captionAuthor.html("Toot and caption by " + authorArr[inc]);
    captionTime.html(timeArr[inc]);

    inc++;

    if (inc >= imgDir.length)
    {
        inc = 0;
    }
}

function count() {
    var val = $.trim($('#toot-text').html());   // Remove spaces from b/e of string
    chars = val.length;                         // Count characters
    charsLeft = 255 - chars;
    document.getElementById('post-toot-wordcount').style.color = "inherit";
    $('#post-toot-wordcount').html(charsLeft);

    if (charsLeft < 255)
    {
        $('#post-toot-btn').prop('disabled', false);
    }

    if (charsLeft < 0)
    {
        $('#post-toot-btn').prop('disabled', true);
        document.getElementById('post-toot-wordcount').style.color = "red";
    }
}

//@ tag ppl function
function tag()
{
    var start = /@/ig;     // @ Match
    var word = /@(\w+)/ig; //@abc Match
    
    var hashstart = /#/ig;     // # Match
    var hashword = /#(\w+)/ig; //#abc Match

    $('#toot-text').on("keyup", function () {
        $('#toot-textarea').val($('#toot-text').html());
    });


    $('#toot-text').on("keyup", function (e)
    {
        var content = $(this).html();   //retrieve content of text area
        
        var go=0;
        var name=0;
        var hashgo=0;
        var hashtag=0;
        
        
        go = content.match(start);         //if content contains @
        name = content.match(word);        //if content contains @abc
        
        hashgo = content.match(hashstart);         //if content contains #
        hashtag = content.match(hashword);        //if content contains #abc
        
        var dataString = 'searchword=' + name;

        if (e.keyCode === 8)    //detect backspace
        {
            document.getElementById('toot-search-display').style.display = "none";
        }

        
        
        if (hashgo !==null){
            if (hashgo.length > 0) //# found
            {
                if (hashtag.length > 0) //#abc found
                {
                    console.log ( '#key was pressed' );
                   
                    
                }
            }
        }
        
        
        if (go !==null){
            if (go.length > 0) //@ found
            {
                if (name.length > 0) //@abc found
                {
                    $.ajax({
                        type: "POST",
                        url: "boxsearch.php",
                        data: dataString,
                        cache: false,
                        //post info to boxsearch.php and display data
                        success: function (data) {
                            $("#toot-search-display").html(data).show();
                        }
                    });
                }
            }
        }
        
        
        
        
    });
}





//@ tag ppl add name function
function addName(e) {
    var word = /@(\w+)/ig;
    var username = $(e).attr('title');  //retrieve the title tag content
    var old = $("#toot-text").html();
    var content = old.replace(word, ""); //replacing #abc to (" ") space
    var link = "<a href=profile.php?user="+username+">"+username+"</a>";
    $("#toot-text").html(content + link);
    $("#toot-search-display").hide();
    count();
    $('#toot-textarea').val(content + link);
}




function imgPreview()
{
    FileReaderJS.setupInput(document.getElementById('post-toot-image-btn-hidden'), {
        on: {
            load: function (e, file) {
                if (file.type.match(/image/)) {
                    var img = document.getElementById('toot-img-preview1');
                    img.style.cssText = 'height: 28px;';
                    var filename = $('input[type=file]').val().split('\\').pop();
                    var delBtn = document.createElement("a");
                    delBtn.addEventListener("click", function () {
                        img.src = "";
                        $('#toot-img-preview-info').text("");
                        $('#toot-img-preview').prop("hidden",true);
                        $('#post-toot-btn').prop("disabled", true);
                    });
                    delBtn.innerHTML = '<span class="glyphicon glyphicon-remove"></span>';
                    img.onload = function () {
                        if (filename.length > 20)
                        {
                            filename = filename.substr(0, 10) + "..";
                        }
                        $('#toot-img-preview-info').text(" " + filename + " ");
                        $('#toot-img-preview-info').append(delBtn);
                        $('#toot-img-preview').prop("hidden",false);
                        $('#post-toot-btn').prop("disabled", false);                        
                    };
                }
                img.src = e.target.result;
            }
        }
    });
}

//carousel function 
$(document).ready(function () {
    $('.carousel-credits').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000
    });
});