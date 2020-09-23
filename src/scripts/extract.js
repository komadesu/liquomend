window.addEventListener('load', () => {
  let cocktails = document.querySelectorAll('.cocktail__item');
  $('.extract-option').on('click', function () {
    if ($('select').val() === 'peach') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('peach')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'cassis') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('cassis')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'kahlua') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('kahlua')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'malibu') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('malibu')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'dita') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('dita')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'other_liquor') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('other_liquor')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'liquor') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('liquor')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'gin') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('gin')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'rum') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('rum')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'vodka') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('vodka')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'tequila') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('tequila')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'other') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('other')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'all') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('cocktail__item')) {
          cocktail.parentElement.style.display = 'block';
        } else {
          cocktail.parentElement.style.display = 'none';
        }
      });
    }
  });
});
