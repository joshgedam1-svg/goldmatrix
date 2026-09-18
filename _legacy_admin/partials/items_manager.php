<?php
/**
 * Reusable Items Manager partial
 * Usage: renderItemsManager($pdo, 'section_key', 'Title', $fields)
 */
function renderItemsManager($pdo, $section, $title, $fields = []) {
    $items = $pdo->prepare("SELECT * FROM homepage_items WHERE section=? ORDER BY sort_order ASC");
    $items->execute([$section]);
    $rows = $items->fetchAll();

    $defaultFields = ['title'=>'Title', 'subtitle'=>'Sub Title', 'description'=>'Description', 'icon'=>'Icon', 'link'=>'Link', 'image'=>'Image'];
    $displayFields = !empty($fields) ? $fields : $defaultFields;
    ?>
<div class="section-card" style="margin-top:20px;">
  <div class="section-card-head">
    <?= htmlspecialchars($title) ?>
    <span style="margin-left:auto;background:rgba(255,255,255,0.15);padding:3px 10px;border-radius:12px;font-size:12px;"><?= count($rows) ?> items</span>
  </div>
  <div class="section-card-body">

    <!-- ADD FORM -->
    <div style="background:#F0F4FF;border-radius:10px;padding:20px;margin-bottom:24px;border:1px solid #DBEAFE;">
      <h4 style="font-size:14px;font-weight:700;color:#1E3A8A;margin-bottom:16px;">➕ Add New Item</h4>
      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add_item">
        <input type="hidden" name="section" value="<?= htmlspecialchars($section) ?>">
        <div class="form-grid">
          <?php foreach($displayFields as $field => $label): ?>
            <?php if($field === 'description'): ?>
              <!-- handled below -->
            <?php elseif($field === 'image'): ?>
              <div class="form-group">
                <label class="form-label"><?= htmlspecialchars($label) ?></label>
                <input type="file" name="image" accept="image/*" class="form-control">
              </div>
            <?php else: ?>
              <div class="form-group">
                <label class="form-label"><?= htmlspecialchars($label) ?></label>
                <input type="text" name="<?= $field ?>" class="form-control" placeholder="Enter <?= htmlspecialchars($label) ?>">
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <?php if(isset($displayFields['description'])): ?>
          <div class="form-group" style="margin-top:12px;">
            <label class="form-label"><?= htmlspecialchars($displayFields['description']) ?></label>
            <textarea name="description" rows="3" class="form-control" placeholder="Enter description..."></textarea>
          </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary" style="margin-top:14px;">➕ Add Item</button>
      </form>
    </div>

    <!-- ITEMS TABLE -->
    <?php if(!empty($rows)): ?>
    <div style="overflow-x:auto;">
      <table class="items-table" id="sortTable_<?= $section ?>">
        <thead>
          <tr>
            <th width="30">⠿</th>
            <th>#</th>
            <?php foreach($displayFields as $field => $label): ?>
              <?php if($field !== 'image'): ?><th><?= htmlspecialchars($label) ?></th><?php endif; ?>
            <?php endforeach; ?>
            <th width="100">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $i => $row): ?>
          <tr data-id="<?= $row['id'] ?>">
            <td><span class="drag-handle">⠿</span></td>
            <td><?= $i+1 ?></td>
            <?php foreach($displayFields as $field => $label): ?>
              <?php if($field === 'image'): continue; endif; ?>
              <td>
                <?php if($field === 'icon'): ?>
                  <span style="font-size:20px;"><?= htmlspecialchars($row[$field] ?? '') ?></span>
                <?php else: ?>
                  <span class="editable-cell" data-field="<?= $field ?>" data-id="<?= $row['id'] ?>" data-section="<?= $section ?>"><?= htmlspecialchars($row[$field] ?? '') ?></span>
                <?php endif; ?>
              </td>
            <?php endforeach; ?>
            <td>
              <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this item?')">
                <input type="hidden" name="action" value="delete_item">
                <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="section" value="<?= $section ?>">
                <button class="btn btn-sm btn-danger" type="submit" title="Delete">🗑️</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <p style="font-size:12px;color:#94A3B8;margin-top:10px;">💡 Click any cell to edit inline. Drag ⠿ to reorder.</p>
    <?php else: ?>
      <div style="text-align:center;padding:40px;color:#94A3B8;">
        <div style="font-size:40px;margin-bottom:10px;">📭</div>
        <p>No items yet. Add your first item above.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
/* Inline editing */
document.querySelectorAll('.editable-cell[data-section="<?= $section ?>"]').forEach(cell => {
  cell.addEventListener('dblclick', function() {
    const original = this.textContent.trim();
    const field = this.dataset.field;
    const id    = this.dataset.id;
    const section = this.dataset.section;
    const isLong = ['description','subtitle'].includes(field);
    const input = document.createElement(isLong ? 'textarea' : 'input');
    input.value = original;
    input.className = 'form-control';
    input.style.cssText = 'font-size:13px;padding:4px 8px;min-width:120px;';
    if(isLong) { input.rows = 2; input.style.width = '100%'; }
    this.replaceWith(input);
    input.focus();
    const save = () => {
      const val = input.value.trim();
      const fd = new FormData();
      fd.append('action','update_item');
      fd.append('item_id',id);
      fd.append('section',section);
      fd.append(field,val);
      // Also send other fields as empty (keep unchanged)
      fetch('',{method:'POST',body:fd}).then(()=>{
        const span = document.createElement('span');
        span.className = 'editable-cell';
        span.dataset.field = field;
        span.dataset.id = id;
        span.dataset.section = section;
        span.textContent = val;
        input.replaceWith(span);
        // Re-attach handler
        span.addEventListener('dblclick', arguments.callee);
      });
    };
    input.addEventListener('blur', save);
    input.addEventListener('keydown', e => { if(e.key==='Enter' && !isLong) { e.preventDefault(); save(); }});
  });
});
</script>
<?php } ?>
