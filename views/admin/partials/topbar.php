<?php
$user = \App\Services\AuthService::user();
$unreadLeadsCount = 0;
$unreadDemosCount = 0;
$totalNewNotifications = 0;
$recentNotifications = [];

try {
    $db = \App\Services\Database::getInstance();
    $unreadLeadsCount = (int)$db->fetchColumn("SELECT COUNT(*) FROM leads WHERE status = 'new'");
    $unreadDemosCount = (int)$db->fetchColumn("SELECT COUNT(*) FROM demo_requests WHERE status = 'new'");
    $totalNewNotifications = $unreadLeadsCount + $unreadDemosCount;

    $recentLeads = $db->fetchAll("SELECT id, name, company, email, phone, 'lead' as notif_type, status, created_at FROM leads ORDER BY id DESC LIMIT 4");
    $recentDemos = $db->fetchAll("SELECT id, name, company, email, phone, 'demo' as notif_type, status, created_at FROM demo_requests ORDER BY id DESC LIMIT 4");

    $recentNotifications = array_merge($recentLeads, $recentDemos);
    usort($recentNotifications, function($a, $b) {
        return strtotime($b['created_at'] ?? 'now') - strtotime($a['created_at'] ?? 'now');
    });
    $recentNotifications = array_slice($recentNotifications, 0, 5);
} catch (\Throwable $e) {
    $totalNewNotifications = 0;
    $recentNotifications = [];
}
?>

<style>
/* ── Clean & Professional Topbar Notification UI (Matching Reference) ── */
.topbar-bell-btn {
  width: 38px;
  height: 38px;
  border-radius: 8px;
  background: #ffffff;
  border: 1px solid #e2e8f0;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  color: #334155;
  text-decoration: none;
  transition: all 0.2s ease;
}
.topbar-bell-btn:hover, .topbar-bell-btn:focus, .topbar-bell-btn.show {
  background: #f8fafc;
  color: #0f172a;
  border-color: #cbd5e1;
}
.topbar-bell-badge {
  position: absolute;
  top: -4px;
  right: -4px;
  min-width: 18px;
  height: 18px;
  padding: 0 4px;
  border-radius: 10px;
  background: #e11d48;
  color: #ffffff;
  font-size: 10.5px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #ffffff;
}

.notif-dropdown-menu-simple {
  width: 330px;
  max-width: calc(100vw - 20px);
  border-radius: 10px;
  border: 1px solid #e5e7eb;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.09);
  z-index: 1070;
  padding: 0;
  overflow: hidden !important;
}

.notif-list-scroll {
  max-height: 340px;
  overflow-y: auto;
  overflow-x: hidden !important;
}

.notif-simple-item {
  padding: 13px 16px;
  display: flex;
  align-items: center;
  gap: 12px;
  border-bottom: 1px solid #f1f5f9;
  text-decoration: none;
  color: inherit;
  background: #ffffff;
  transition: background 0.15s ease;
  width: 100%;
  box-sizing: border-box;
  cursor: pointer;
}
.notif-simple-item:hover {
  background: #f8fafc;
  color: inherit;
}
.notif-simple-item:last-child {
  border-bottom: none;
}

.notif-simple-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #f1f5f9;
  color: #94a3b8;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 21px;
  flex-shrink: 0;
}

.notif-content-wrap {
  flex: 1 1 auto;
  min-width: 0;
  overflow: hidden;
}

.notif-title-text {
  font-size: 14px;
  font-weight: 600;
  color: #1e293b;
  margin-bottom: 3px;
  line-height: 1.3;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.notif-subtitle-text {
  font-size: 12px;
  line-height: 1.42;
  color: #64748b;
  margin: 0;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  word-break: break-word;
  white-space: normal;
}

.notif-unread-dot {
  width: 9px;
  height: 9px;
  border-radius: 50%;
  background: #e11d48;
  display: block;
  flex-shrink: 0;
  margin-left: 6px;
}
</style>

<header class="topbar">
  <!-- LEFT: LIVE SITE & CLEAR CACHE BUTTONS -->
  <div class="d-flex align-items-center gap-2">
    <button class="btn btn-sm btn-light border d-md-none sidebar-toggle-btn me-1"><i class="bi bi-list fs-5"></i></button>
    
    <a href="<?= site_url() ?>" target="_blank" class="topbar-icon-btn shadow-sm" title="View Public Website">
      <i class="bi bi-globe2 fs-6 text-primary"></i>
    </a>

    <a href="<?= admin_url('settings?action=cache_cleared') ?>" class="btn-clear-cache shadow-sm" onclick="alert('⚡ System Cache and Compiled Views Cleared Successfully!');">
      <i class="bi bi-eraser-fill"></i>
      <span>Clear Cache</span>
    </a>
  </div>

  <!-- RIGHT: NOTIFICATIONS & USER PROFILE -->
  <div class="d-flex align-items-center gap-3">
    
    <!-- ── NOTIFICATION BELL DROPDOWN ── -->
    <div class="dropdown">
      <a href="#" class="topbar-bell-btn dropdown-toggle shadow-sm" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
        <i class="bi bi-bell-fill fs-6 <?= $totalNewNotifications > 0 ? 'text-dark' : 'text-secondary' ?>"></i>
        <?php if ($totalNewNotifications > 0): ?>
          <span class="topbar-bell-badge" id="topbarBellBadge"><?= $totalNewNotifications ?></span>
        <?php endif; ?>
      </a>

      <div class="dropdown-menu dropdown-menu-end notif-dropdown-menu-simple shadow-lg border-0 mt-2">
        <!-- Header -->
        <div class="px-3 py-2.5 bg-white border-bottom">
          <h6 class="mb-0 fw-bold text-dark" style="font-size: 15px; letter-spacing: -0.2px;">Notifications</h6>
        </div>

        <!-- Notification Items List -->
        <div class="notif-list-scroll">
          <?php if (!empty($recentNotifications)): ?>
            <?php foreach ($recentNotifications as $notif): 
              $isDemo = ($notif['notif_type'] === 'demo');
              $targetUrl = $isDemo ? admin_url('demo-requests?read_id=' . (int)$notif['id']) : admin_url('leads?read_id=' . (int)$notif['id']);
              $isUnread = ($notif['status'] === 'new');
              
              if ($isDemo) {
                $subText = !empty($notif['company']) 
                  ? "A new demo request has been registered to your system. Company: " . $notif['company']
                  : "A new demo request has been registered to your system. Name: " . ($notif['name'] ?? 'Visitor');
              } else {
                $subText = !empty($notif['company'])
                  ? "A new enquiry has been registered to your system. Company: " . $notif['company']
                  : "A new enquiry has been registered to your system. Name: " . ($notif['name'] ?? 'Visitor');
              }
            ?>
              <a href="<?= $targetUrl ?>" 
                 class="notif-simple-item" 
                 onclick="handleNotifClick(event, '<?= $notif['notif_type'] ?>', <?= (int)$notif['id'] ?>, this, '<?= $targetUrl ?>')">
                <!-- Silhouette Avatar Icon -->
                <div class="notif-simple-avatar">
                  <i class="bi bi-person-fill"></i>
                </div>

                <!-- Text Content: Title + 2-Line Subtitle -->
                <div class="notif-content-wrap">
                  <div class="notif-title-text">
                    <?= e($notif['name'] ?? 'New Customer') ?>
                  </div>
                  <p class="notif-subtitle-text">
                    <?= e($subText) ?>
                  </p>
                </div>

                <!-- Unread Dot (Pink/Red Indicator) -->
                <?php if ($isUnread): ?>
                  <span class="notif-unread-dot" title="Unread"></span>
                <?php endif; ?>
              </a>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="text-center py-4 px-3 text-muted">
              <i class="bi bi-bell-slash fs-3 text-secondary opacity-50 d-block mb-1"></i>
              <div class="fs-12 fw-medium">No new notifications</div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Footer -->
        <div class="py-2.5 px-3 text-center bg-white border-top">
          <a href="<?= admin_url('leads') ?>" class="text-decoration-none text-dark fw-semibold" style="font-size: 13px;">
            View All Notifications
          </a>
        </div>
      </div>
    </div>

    <!-- ── USER PROFILE DROPDOWN ── -->
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
        <div class="avatar-circle shadow-sm" style="width:32px;height:32px;background:#6366F1;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;">
          <i class="bi bi-person-fill fs-6"></i>
        </div>
        <div class="d-none d-sm-block text-start" style="line-height:1.2;">
          <div class="fw-bold text-dark fs-13"><?= e($user['name'] ?? 'Super Admin') ?></div>
          <div class="text-muted fs-11"><?= e($user['role_name'] ?? 'admin') ?></div>
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
        <li class="dropdown-header text-muted fs-12">Logged in as <?= e($user['email'] ?? 'admin@example.com') ?></li>
        <li><a class="dropdown-item" href="<?= admin_url('settings') ?>"><i class="bi bi-gear me-2"></i> Settings</a></li>
        <li><a class="dropdown-item" href="<?= admin_url('seo') ?>"><i class="bi bi-search me-2"></i> SEO Manager</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="<?= admin_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</header>

<script>
function handleNotifClick(event, type, id, elem, targetUrl) {
  // If this item was unread, remove the unread dot and decrement badge
  const dot = elem.querySelector('.notif-unread-dot');
  if (dot) {
    dot.remove();
    const bellBadge = document.getElementById('topbarBellBadge');
    if (bellBadge) {
      let count = parseInt(bellBadge.innerText.trim()) || 0;
      count = Math.max(0, count - 1);
      if (count === 0) {
        bellBadge.remove();
      } else {
        bellBadge.innerText = count;
      }
    }
  }

  // Send AJAX mark as read
  const formData = new FormData();
  formData.append('type', type);
  formData.append('id', id);
  formData.append('csrf_token', '<?= csrf_token() ?>');
  if (navigator.sendBeacon) {
    navigator.sendBeacon('/admin/leads/api-mark-single-read', formData);
  } else {
    fetch('/admin/leads/api-mark-single-read', { method: 'POST', body: formData, keepalive: true });
  }
}
</script>
