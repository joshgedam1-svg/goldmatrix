<?php
/**
 * Reusable items panel for homepage sections
 */
function itemsPanel(string $formAction, string $section, string $title, array $rows, array $fields = []): void {
    $count = count($rows);
    $defaultFields = ['title' => 'Title', 'subtitle' => 'Subtitle', 'description' => 'Description', 'icon' => 'Icon', 'link' => 'Link'];
    $showFields = !empty($fields) ? $fields : $defaultFields;
    ?>
<div class="hp-card" style="margin-top:16px;">
  <div class="hp-card-head">
    <?= htmlspecialchars($title) ?>
    <span style="background:rgba(255,255,255,0.15);padding:3px 10px;border-radius:12px;font-size:12px;"><?= $count ?> items</span>
  </div>
  <div class="hp-card-body">
    <!-- ADD FORM -->
    <div class="add-box">
      <h5>➕ Add New Item</h5>
      <form method="POST" action="<?= htmlspecialchars($formAction) ?>?tab=<?= $section ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="add_item">
        <input type="hidden" name="section" value="<?= htmlspecialchars($section) ?>">
        <div class="fg">
          <?php foreach($showFields as $field => $label): ?>
            <?php if ($field === 'description') continue; ?>
            <div class="mb-2">
              <label class="form-label fw-semibold small"><?= htmlspecialchars($label) ?></label>
              <input type="text" name="<?= $field ?>" class="form-control form-control-sm" placeholder="<?= htmlspecialchars($label) ?>">
            </div>
          <?php endforeach; ?>
          <?php if (isset($showFields['image'])): ?>
          <div class="mb-2">
            <label class="form-label fw-semibold small">Image</label>
            <input type="file" name="image" accept="image/*" class="form-control form-control-sm">
          </div>
          <?php endif; ?>
        </div>
        <?php if (isset($showFields['description'])): ?>
        <div class="mb-2">
          <label class="form-label fw-semibold small"><?= htmlspecialchars($showFields['description']) ?></label>
          <textarea name="description" rows="2" class="form-control form-control-sm" placeholder="Enter description..."></textarea>
        </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary btn-sm mt-2">➕ Add Item</button>
      </form>
    </div>

    <!-- ITEMS TABLE -->
    <?php if (!empty($rows)): ?>
    <div class="table-responsive">
      <table class="items-tbl">
        <thead>
          <tr>
            <th>#</th>
            <?php foreach($showFields as $field => $label): ?>
              <?php if ($field !== 'image'): ?><th><?= htmlspecialchars($label) ?></th><?php endif; ?>
            <?php endforeach; ?>
            <th style="width:80px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($rows as $i => $row): ?>
          <tr>
            <td class="text-muted small"><?= $i + 1 ?></td>
            <?php foreach($showFields as $field => $label): ?>
              <?php if ($field === 'image') continue; ?>
              <td>
                <?php if ($field === 'icon'): ?>
                  <span style="font-size:20px;"><?= htmlspecialchars($row[$field] ?? '') ?></span>
                <?php else: ?>
                  <span class="text-truncate d-block" style="max-width:200px;" title="<?= htmlspecialchars($row[$field] ?? '') ?>">
                    <?= htmlspecialchars($row[$field] ?? '') ?>
                  </span>
                <?php endif; ?>
              </td>
            <?php endforeach; ?>
            <td>
              <form method="POST" action="<?= htmlspecialchars($formAction) ?>?tab=<?= $section ?>" onsubmit="return confirm('Delete this item?')">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="delete_item">
                <input type="hidden" name="item_id" value="<?= (int)$row['id'] ?>">
                <input type="hidden" name="section" value="<?= htmlspecialchars($section) ?>">
                <button type="submit" class="btn btn-danger btn-sm" title="Delete">🗑️</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
    <div class="text-center py-5 text-muted">
      <div style="font-size:36px;margin-bottom:10px;">📭</div>
      <p>No items yet. Add your first item above.</p>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php } ?>
