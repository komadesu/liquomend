$('.pulldown').each(function () {
  var classes = $(this).attr('class'),
    id = $(this).attr('id'),
    name = $(this).attr('name');
  var template = '<div class="' + classes + '">';
  template +=
    '<span class="pulldown-trigger font-pulldown">' +
    $(this).attr('placeholder') +
    '</span>';
  template += '<div class="extract-options">';
  $(this)
    .find('option')
    .each(function (index, select) {
      if (select.classList.contains('extract__base')) {
        template +=
          '<span class="extract-option font-pulldown ' +
          $(this).attr('class') +
          '" data-value="' +
          $(this).attr('value') +
          '">' +
          $(this).html() +
          '</span>';
      } else {
        template +=
          '<button class="extract-option font-pulldown ' +
          $(this).attr('class') +
          '" data-value="' +
          $(this).attr('value') +
          '">' +
          $(this).html() +
          '</button>';
      }
    });
  template += '</div></div>';

  $(this).wrap('<div class="pulldown-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});

$('.pulldown-trigger').on('click', function (event) {
  $('html').one('click', function () {
    $('.pulldown').removeClass('opened');
  });
  $(this).parents('.pulldown').toggleClass('opened');
  event.stopPropagation();
});
$('.extract-option').on('click', function () {
  $(this)
    .parents('.pulldown-wrapper')
    .find('select')
    .val($(this).data('value'));
  $(this)
    .parents('.extract-options')
    .find('.extract-option')
    .removeClass('selection');
  $(this).addClass('selection');
  $(this).parents('.pulldown').removeClass('opened');
  $(this).parents('.pulldown').find('.pulldown-trigger').text($(this).text());
});
