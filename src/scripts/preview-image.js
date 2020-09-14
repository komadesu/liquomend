class PreviewImage {
  constructor(el) {
    this.sizeLimit = 1024 * 1024 * 1;
    this.fileInput = el instanceof HTMLElement ? el : document.querySelector(el);
    this.fileInput.addEventListener('change', this._handleFileSelect.bind(this));
  }

  _handleFileSelect() {
    const files = this.fileInput.files;
    const file = files[0];

    if (!file.type.startsWith('image/')) return;

    if (file.size > this.sizeLimit) {
      alert('ファイルサイズは1MB以下にしてください');
      this.fileInput.value = ''; // inputの中身をリセット
      return; // この時点で処理を終了する
    }

    this._previewFile(file);
  }

  _previewFile(file) {
    const preview = document.querySelector('.preview');

    const reader = new FileReader();

    // URLとして読み込まれたときに実行する処理
    reader.onload = function (e) {
      const imageUrl = e.target.result; // URLはevent.target.resultで呼び出せる
      const img = document.createElement('img'); // img要素を作成
      img.src = imageUrl; // URLをimg要素にセット
      preview.appendChild(img); // .previewの中に追加
    };

    // いざファイルをURLとして読み込む
    reader.readAsDataURL(file);
  }
}

export default PreviewImage;
