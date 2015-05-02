function loadXMLDoc()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajax_info.txt",true);
xmlhttp.send();
}

function test(){
	$( "#AI_C01_S01_V01.versetext" ).load( "Aitareya_id.html",function() {
  alert( "Load was performed.")} );
}

function show_s2(){
	
}
function show_bhashya(id)
{	
	$(id).slideToggle('slow');
}
function show_nav_level1(id)
{	
	id = id + 'ul';
	$(id).slideToggle('fast');
}

function getUrlParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}

function OnloadFunction(){
    $("#sidenav").height("100%");
    $("#rsidenav").height("96%");
    $("#sidenav").mCustomScrollbar({scrollInertia: 100});
    $(".mainNav #navLevel1").show();
    $("#showNavLevel1").addClass( "active" );
    setTimeout(function(){
        $('#sidenav').css('left','-360px');
    },1000);
    
    $( "#sidenav .arrow" ).click(
        function() {
            if($( '#sidenav' ).hasClass( "show" )){
                closeNav(1);
            }
            else{
                openNav(1);
            }
        }
    );

    $( "#showNavLevel1" ).click(function() {
        $( ".mainNav ul" ).hide();
        $( "#showNavLevel2, #showNavLevel3, #showNavLevel4" ).removeClass( "active" );
        $( ".mainNav #navLevel1" ).show();
        $( "#showNavLevel1" ).addClass( "active" );
        $( ".sort" ).hide();
        $("#sidenav").mCustomScrollbar("scrollTo", 0);
    });
    $( "#showNavLevel2" ).click(function() {
        $( ".mainNav ul" ).hide();
        $( "#showNavLevel3, #showNavLevel4, #showNavLevel1" ).removeClass( "active" );
        $( "#navLevel2" ).load( "include_sutra_list.php", function(){bindNavEvents();}).show();
        $( "#showNavLevel2" ).addClass( "active" );
        $( ".sort" ).show();
        $("#sidenav").mCustomScrollbar("scrollTo", 0);
    });
    $( "#showNavLevel3" ).click(function() {
        $( ".mainNav ul" ).hide();
        $( "#showNavLevel4, #showNavLevel1, #showNavLevel2" ).removeClass( "active" );
        $( "#navLevel3" ).load( "include_adhikarana_list.php", function(){bindNavEvents();}).show();
        $( "#showNavLevel3" ).addClass( "active" );
        $( ".sort" ).show();
        $("#sidenav").mCustomScrollbar("scrollTo", 0);
    });
    $( "#showNavLevel4" ).click(function() {
        $( ".mainNav ul" ).hide();
        $( "#showNavLevel1, #showNavLevel2, #showNavLevel3" ).removeClass( "active" );
        $( "#navLevel4" ).load( "include_vishaya_list.php", function(){bindNavEvents();}).show();
        $( "#showNavLevel4" ).addClass( "active" );
        $( ".sort" ).show();
        $("#sidenav").mCustomScrollbar("scrollTo", 0);
    });
    
    setTimeout(function(){
        var hloc = window.location.href;
        var jump_id = hloc.split("#");
        jump_id = jump_id[1];
        $('#BH_'+jump_id).slideToggle('slow');
        var qid = getUrlParameter('qid');

        if(qid === undefined){
        }
        else{
            $("html, body").hide().fadeIn('slow').animate({ scrollTop: $( '#' + qid ).offset().top - 140 }, 1)
        }
    },100);
    
    setTimeout( function(){$(document).scroll(function(){$('#callout').fadeOut(2000)})}, 2000);
    
    $(".qt a").hover(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
    $(".qt a").focus(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
    
    bindNavEvents();
    
    $( document )
    .ajaxStart(function() {
        setTimeout( function(){$( "#ajaxLoader" ).fadeIn( 50 );}, 1);
    })
    .ajaxStop(function() {
        setTimeout( function(){$( "#ajaxLoader" ).fadeOut( 250 );}, 1);
    })
    ;
}
function OnloadFunctionAjax(){
    $(".qt a").hover(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
    $(".qt a").focus(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
}
function loadChapter(parentId, id, pagenum, bhashya, hval, level, vid){
    
    var go = $('#pageLazy');
    var postData = {"bhashya":bhashya,"hval":hval};

    $.ajax({
        type: "POST",
        url: "include_level" + level + "_body.php?page=" + pagenum,
        dataType: "html",
        data: postData,
        success: function(res){
            goNow = true;
            $('#loader').fadeOut(500);
            go.append(res).fadeIn();
            OnloadFunctionAjax();
           
            if(parentId != 0){
                
               insertVishaya(parentId, id, pagenum, bhashya, hval, level, vid);
            }
            else{
                
                $( "html, body" ).scrollTop($( id ).offset().top);
            }
            
            var dattr = $( ".page_format" ).attr("data-page");
            dattr = parseInt(pagenum) + ';' + dattr.split(/;/)[1] + ';' + dattr.split(/;/)[2];
            $( "#pageLazy" ).attr("data-page", dattr);
        },
        error: function(e){
            goNow = false;
            $('#loader').fadeOut(500);
        }
    });
}
function closeNav(time){
    setTimeout( function(){
        $( '#sidenav' ).removeClass( "show" );
        $( '.arrow i' ).fadeOut( 400, function(){$( '.arrow i' ).removeClass( "fa-times" );$( '.arrow i' ).addClass( "fa-navicon" );$( '.arrow i' ).fadeIn( 20 );} );
    },time);
    $( "#sidenav" ).unbind( "mouseleave" );
}
function openNav(time){
    setTimeout( function(){
        $( '#sidenav' ).addClass( "show" );
        $( '.arrow i' ).fadeOut( 400, function(){$( '.arrow i' ).removeClass( "fa-navicon" );$( '.arrow i' ).addClass( "fa-times" );$( '.arrow i' ).fadeIn( 20 );} );
    },time);
}
function bindNavEvents(){
    $( "a, button" ).click(function(){
        $( "#ajaxLoader" ).remove();
        $(this).append("<i id=\"ajaxLoader\" class=\"fa fa-spinner fa-spin\"></i>");
        $( "#ajaxLoader" ).hide();
    });
    
    $( ".navLinkScroll" ).click(function( event ) {
        event.preventDefault();
        var data = $(this).attr('data-index').split(/;/);
        
        var id = data[0];
        var pagenum = data[1];
        var bhashya = data[2];
        var hval = data[3];
        var level = data[4];
        
        if($( id ).length == 0){
            loadChapter(0, id, pagenum, bhashya, hval, level, 0);
        }
        else{
            $( "html, body" ).scrollTop($( id ).offset().top);
        }
        $( "#sidenav" ).mouseleave(function() {
            closeNav(100);
        });
    });
    
    $( ".navLinkScrollText" ).click(function( event ) {
        event.preventDefault();
        var data = $(this).attr('data-index').split(/;/);
        
        var parentId = data[0];
        var id = data[1];
        var pagenum = data[2];
        var bhashya = data[3];
        var hval = data[4];
        var level = data[5];
        var vid = data[6];
        
        if($( id ).length == 0){
            loadChapter(parentId, id, pagenum, bhashya, hval, level, vid);
        }
        else{
            insertVishaya(parentId, id, pagenum, bhashya, hval, level, vid);
        }
        $( "#sidenav" ).mouseleave(function() {
            closeNav(100);
        });
    });

}
function bindToggleEvent(){
    $( "#toggleAll" ).click(function() {
        if($( ".toggle input" ).prop( "checked")) {
            $( ".toggle input" ).prop( "checked", false);
        }
        else {
            $( ".toggle input" ).prop( "checked", true);
        }
    });
}
function insertVishaya(parentId, id, pagenum, bhashya, hval, level, vid) {
    
    if($ (parentId).length == 0){
        $( id + '_VI_' + vid ).remove();
        $( id ).before( "<p id=\"" + id.replace('#', '') + "_VI_" + vid + "\" class=\"vishaya\"><i class=\"fa fa-arrow-down\"></i> " + hval +"</p>" );
        $( "html, body" ).scrollTop($( id ).prev().offset().top - 140);
    }
    else{
        $( parentId ).show( 10 , function() {
            $( id + '_VI_' + vid ).remove();
            $( id ).before( "<p id=\"" + id.replace('#', '') + "_VI_" + vid + "\" class=\"vishaya\"><i class=\"fa fa-arrow-down\"></i> " + hval +"</p>" );
            $( "html, body" ).scrollTop($( id ).prev().offset().top - 140);
        });
    }
}
