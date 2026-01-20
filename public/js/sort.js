document.addEventListener('DOMContentLoaded', function() {
  const sortSelect = document.getElementById('dog-sort-select');
  const container = document.getElementById('dog-container');

  sortSelect.addEventListener('change', function() {
    const val = this.value;
    if (val === 'default') return;

    //子要素(dog-card)を配列として取得
    const cards = Array.from(container.querySelectorAll('.dog-card'));

    cards.sort((a,b) => {
      let valA, valB;

      switch (val) {
        case 'size-asc':
          valA = a.dataset.size;
          valB = b.dataset.size;
          return valA.localeCompare(valB);
        case 'size-desc':
          valA = a.dataset.size;
          valB = b.dataset.size;
          return valB.localeCompare(valA);
        case 'name-asc':
          valA = a.dataset.name;
          valB = b.dataset.name;
          return valA.localeCompare(valB, 'ja');
        case 'viewCounts-desc':
          valA = parseInt(a.dataset.viewCounts);
          valB = parseInt(b.dataset.viewCounts);
          return valB - valA;
        default:
          return 0;
      }
    });

    //並び替えた要素をコンテナに再追加
    cards.forEach(card => container.appendChild(card));
  })
})