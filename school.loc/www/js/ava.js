$(document).ready(function(){
    var blockSide = $('.ava-block').width();
    var avaWidth = $('.ava').width();
    var avaHeight = $('.ava').height();
    var padding;
    $('.ava-block').height(blockSide);
    if(avaWidth < avaHeight){
      $('.ava').width(blockSide);
      avaWidth = $('.ava').width();
      avaHeight = $('.ava').height();
      padding = (avaHeight - avaWidth) / 4;
      $('.ava').css('top', - padding);
    }else{
      $('.ava').height(blockSide);
      avaWidth = $('.ava').width();
      avaHeight = $('.ava').height();
      padding = (avaWidth - avaHeight) / 4;
      $('.ava').css('left', - padding);
    }
    
  })