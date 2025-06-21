</div> <!-- end container -->
<footer class="bg-body-tertiary text-body-secondary text-center mt-5 p-3">
  <small>&copy; <?= date('Y') ?> Your Movie Database</small>
</footer>

<script>
  const input = document.getElementById('search');
  const list = document.getElementById('suggestions');

  input.addEventListener('input', async () => {
    const query = input.value.trim();
    if (query.length < 2) {
      list.innerHTML = '';
      return;
    }

    try {
      const res = await fetch(`search-suggest.php?q=${encodeURIComponent(query)}`);
      const data = await res.json();

      if (!data.length) {
        list.innerHTML = '<li class="list-group-item disabled">No matches</li>';
        return;
      }

      list.innerHTML = data.map(title => `
        <li class="list-group-item">${title}</li>
      `).join('');
    } catch (err) {
      console.error(err);
    }
  });

  // Optional: clicking a suggestion sets the input
  list.addEventListener('click', e => {
    if (e.target.tagName === 'LI') {
      input.value = e.target.textContent;
      list.innerHTML = '';
    }
  });
</script>


<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/scripts.js"></script>
</body>

</html>