window.addEventListener('load', () => {
  let cocktails = document.querySelectorAll('.cocktail__item');
  $('.extract-option').on('click', function () {
    if ($('select').val() === 'peach') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('peach')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'cassis') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('cassis')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'kahlua') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('kahlua')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'malibu') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('malibu')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'dita') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('dita')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'other_liquor') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('other_liquor')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'liquor') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('liquor')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'gin') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('gin')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'rum') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('rum')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'vodka') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('vodka')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'tequila') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('tequila')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'other') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('other')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'all') {
      cocktails.forEach((cocktail) => {
        if (cocktail.classList.contains('cocktail__item')) {
          cocktail.style.display = 'block';
        } else {
          cocktail.style.display = 'none';
        }
      });
    }
  });
});
