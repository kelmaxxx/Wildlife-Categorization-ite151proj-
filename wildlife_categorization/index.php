  <?php
  // Connect to MySQL
  $conn = new mysqli("localhost", "root", "", "wildlife_categorization", 3307);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Get search keyword and filters
  $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
  $filters = isset($_GET['filter']) ? $_GET['filter'] : [];
  if (!is_array($filters)) $filters = [$filters];
  $filters = array_map(function($f) use ($conn) {
      return $conn->real_escape_string($f);
  }, $filters);

  // Build SQL query
  $sql = "SELECT 
              s.species_name,
              s.species_sci_name,
              s.is_endangered,
              s.image_url,
              c.category_name,
              h.habitat_name,
              h.habitat_location
          FROM species s
          JOIN category c ON s.category_id = c.category_id
          JOIN habitat h ON s.habitat_id = h.habitat_id";


  $where = [];
  if ($search !== '') {
      $where[] = "(s.species_name LIKE '%$search%' OR 
                  s.species_sci_name LIKE '%$search%' OR 
                  c.category_name LIKE '%$search%')";
  }

  // Handle filter logic
  $category_conditions = [];
  if (in_array('carnivore', $filters)) $category_conditions[] = "c.category_name = 'carnivore'";
  if (in_array('herbivore', $filters)) $category_conditions[] = "c.category_name = 'herbivore'";
  if (in_array('omnivore', $filters)) $category_conditions[] = "c.category_name = 'omnivore'";
  if (!empty($category_conditions)) {
      $where[] = "(" . implode(" OR ", $category_conditions) . ")";
  }
  if (in_array('endangered', $filters)) {
      $where[] = "s.is_endangered = 1";
  }

  if (!empty($where)) {
      $sql .= " WHERE " . implode(" AND ", $where);
  }

  $result = $conn->query($sql);
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wildlife Explorer</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <button class="menu-btn" id="menu-btn">&#9776;</button>
    <a href="admin/login.php" class="admin-btn">Admin</a>


    <div class="sidebar" id="sidebar">
      <h2>Filters</h2>
      <form method="GET">
        <?php
          $selected_filters = $filters; // Already sanitized above
        ?>
        <label><input type="checkbox" name="filter[]" value="carnivore" <?= in_array('carnivore', $selected_filters) ? 'checked' : '' ?>> Carnivore</label>
        <label><input type="checkbox" name="filter[]" value="herbivore" <?= in_array('herbivore', $selected_filters) ? 'checked' : '' ?>> Herbivore</label>
        <label><input type="checkbox" name="filter[]" value="omnivore" <?= in_array('omnivore', $selected_filters) ? 'checked' : '' ?>> Omnivore</label>
        <label><input type="checkbox" name="filter[]" value="endangered" <?= in_array('endangered', $selected_filters) ? 'checked' : '' ?>> Endangered Only</label>
        <button type="submit">Apply</button>
      </form>
    </div>

    <header>
      <h1>Wildlife Explorer</h1>
      <p>Discover, Classify, and Protect Wildlife</p>
    </header>

    <div class="search-bar">
      <form method="GET">
        <input type="text" name="search" placeholder="Search species..." value="<?= htmlspecialchars($search) ?>">
        <?php foreach ($selected_filters as $f): ?>
          <input type="hidden" name="filter[]" value="<?= htmlspecialchars($f) ?>">
        <?php endforeach; ?>
        <button type="submit">Search</button>
      </form>
    </div>

    <div class="card-container" id="animal-cards">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="card <?= strtolower($row['category_name']) ?> <?= $row['is_endangered'] ? 'endangered' : '' ?>">
            <div class="card-content">
              <h3><?= $row['species_name'] ?></h3>
              <span class="badge <?= strtolower($row['category_name']) ?>"><?= ucfirst($row['category_name']) ?></span>
              <?php if ($row['is_endangered']): ?>
                <span class="badge endangered">Endangered</span>
              <?php endif; ?>
              <p><em><?= $row['species_sci_name'] ?></em></p>
              <p>Habitat: <?= $row['habitat_name'] ?> (<?= $row['habitat_location'] ?>)</p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="text-align:center;">No data found in database.</p>
      <?php endif; ?>
    </div>

    <script>
      const menuBtn = document.getElementById('menu-btn');
      const sidebar = document.getElementById('sidebar');
      menuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
      });
    </script>
  </body>
  </html>
