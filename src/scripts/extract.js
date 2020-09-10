window.addEventListener('load', () => {
  let bases = document.querySelectorAll('.extract__base');
  $('.extract-option').on('click', function () {
    if ($('select').val() === 'liquor') {
      bases.forEach((base) => {
        if (base.classList.contains('liquor')) {
          base.style.display = 'block';
        } else {
          base.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'gin') {
      bases.forEach((base) => {
        if (base.classList.contains('gin')) {
          base.style.display = 'block';
        } else {
          base.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'rum') {
      bases.forEach((base) => {
        if (base.classList.contains('rum')) {
          base.style.display = 'block';
        } else {
          base.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'vodka') {
      bases.forEach((base) => {
        if (base.classList.contains('vodka')) {
          base.style.display = 'block';
        } else {
          base.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'tequila') {
      bases.forEach((base) => {
        if (base.classList.contains('tequila')) {
          base.style.display = 'block';
        } else {
          base.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'other') {
      bases.forEach((base) => {
        if (base.classList.contains('other')) {
          base.style.display = 'block';
        } else {
          base.style.display = 'none';
        }
      });
    }
    if ($('select').val() === 'all') {
      bases.forEach((base) => {
        if (base.classList.contains('extract__base')) {
          base.style.display = 'block';
        } else {
          base.style.display = 'none';
        }
      });
    }
  });
});
