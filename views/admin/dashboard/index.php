<?php
/**
 * Executive Admin Dashboard
 * Location: views/admin/dashboard/index.php
 */
?>

<!-- ══════════════════════════════════════════════════════════════
     TOP ROW: 4 VIBRANT WAVE STAT CARDS (Reference Image Style)
     ══════════════════════════════════════════════════════════════ -->
<div class="row g-3 mb-4">
  
  <!-- CARD 1: PURPLE GRADIENT (Total Website Pages) -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-wave-card card-purple">
      <div>
        <div class="d-flex align-items-center justify-content-between">
          <span class="card-title-text">Total Website Pages</span>
          <i class="bi bi-file-earmark-text-fill opacity-75 fs-5"></i>
        </div>
        <h2 class="card-metric-num mt-2"><?= $totalPages ?></h2>
      </div>
      <div class="d-flex align-items-center justify-content-between position-relative z-1 pt-2">
        <span class="fs-12 opacity-90"><?= $publishedPages ?> Published</span>
        <span class="badge bg-white bg-opacity-25 text-white fs-11 px-2 py-1 rounded-pill"><?= $draftPages ?> Drafts</span>
      </div>
      <svg class="card-wave-svg" viewBox="0 0 500 150" preserveAspectRatio="none">
        <path d="M0.00,49.98 C149.99,150.00 349.81,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" fill="#FFFFFF"></path>
      </svg>
    </div>
  </div>

  <!-- CARD 2: BLUE GRADIENT (ERP Demo Requests) -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-wave-card card-blue">
      <div>
        <div class="d-flex align-items-center justify-content-between">
          <span class="card-title-text">ERP Demo Requests</span>
          <i class="bi bi-calendar2-check-fill opacity-75 fs-5"></i>
        </div>
        <h2 class="card-metric-num mt-2"><?= $demoRequests ?></h2>
      </div>
      <div class="d-flex align-items-center justify-content-between position-relative z-1 pt-2">
        <span class="fs-12 opacity-90"><?= $thisMonthDemos ?? 1 ?> This Month</span>
        <span class="badge bg-white bg-opacity-25 text-white fs-11 px-2 py-1 rounded-pill">High Priority</span>
      </div>
      <svg class="card-wave-svg" viewBox="0 0 500 150" preserveAspectRatio="none">
        <path d="M0.00,49.98 C180.00,140.00 320.00,-30.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" fill="#FFFFFF"></path>
      </svg>
    </div>
  </div>

  <!-- CARD 3: PINK / MAGENTA GRADIENT (Active ERP Modules) -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-wave-card card-pink">
      <div>
        <div class="d-flex align-items-center justify-content-between">
          <span class="card-title-text">Active ERP Modules</span>
          <i class="bi bi-cpu-fill opacity-75 fs-5"></i>
        </div>
        <h2 class="card-metric-num mt-2"><?= $erpModules ?? 14 ?></h2>
      </div>
      <div class="d-flex align-items-center justify-content-between position-relative z-1 pt-2">
        <span class="fs-12 opacity-90">Live Solutions</span>
        <span class="badge bg-white bg-opacity-25 text-white fs-11 px-2 py-1 rounded-pill">Active</span>
      </div>
      <svg class="card-wave-svg" viewBox="0 0 500 150" preserveAspectRatio="none">
        <path d="M0.00,49.98 C149.99,150.00 349.81,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" fill="#FFFFFF"></path>
      </svg>
    </div>
  </div>

  <!-- CARD 4: ORANGE GRADIENT (Contact Inquiries / Leads) -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-wave-card card-orange">
      <div>
        <div class="d-flex align-items-center justify-content-between">
          <span class="card-title-text">Contact Enquiries</span>
          <i class="bi bi-envelope-paper-fill opacity-75 fs-5"></i>
        </div>
        <h2 class="card-metric-num mt-2"><?= $totalLeads ?></h2>
      </div>
      <div class="d-flex align-items-center justify-content-between position-relative z-1 pt-2">
        <span class="fs-12 opacity-90"><?= $thisMonthLeads ?? 3 ?> Received</span>
        <span class="badge bg-white bg-opacity-25 text-white fs-11 px-2 py-1 rounded-pill">New Leads</span>
      </div>
      <svg class="card-wave-svg" viewBox="0 0 500 150" preserveAspectRatio="none">
        <path d="M0.00,49.98 C180.00,140.00 320.00,-30.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" fill="#FFFFFF"></path>
      </svg>
    </div>
  </div>

</div>

<!-- ══════════════════════════════════════════════════════════════
     MIDDLE SECTION: 2-COLUMN ASYMMETRIC GRID (Reference Layout)
     ══════════════════════════════════════════════════════════════ -->
<div class="row g-4 mb-4">
  
  <!-- ── LEFT MAJOR COLUMN (Charts & Recent Leads Tables) ── -->
  <div class="col-12 col-xl-8">
    
    <!-- 1. YEARLY GROWTH & INQUIRIES AREA CHART -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
      <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 mb-3">
        <div>
          <h6 class="fw-bold text-dark mb-1">
            <i class="bi bi-graph-up text-primary me-2"></i>Website Traffic & Lead Inquiries Trend
          </h6>
          <span class="text-muted fs-12">Monthly overview of visitor inquiries & scheduled ERP software walkthroughs</span>
        </div>
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-12 px-3 py-1.5 rounded-pill">
          Current Year (<?= date('Y') ?>)
        </span>
      </div>
      
      <div style="height: 260px; position: relative;">
        <canvas id="leadsGrowthChart"></canvas>
      </div>
    </div>

    <!-- 2. RECENT CONTACT ENQUIRIES TABLE -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
      <div class="card-header bg-white border-bottom p-3.5 d-flex align-items-center justify-content-between">
        <h6 class="fw-bold text-dark mb-0">
          <i class="bi bi-clock-history text-primary me-2"></i>Recent Contact Enquiries
        </h6>
        <a href="<?= admin_url('leads') ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 fs-12">
          View All Leads <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light fs-12 text-muted">
            <tr>
              <th class="ps-3">Contact Name</th>
              <th>Company</th>
              <th>Email</th>
              <th>Source</th>
              <th>Status</th>
              <th class="text-end pe-3">Action</th>
            </tr>
          </thead>
          <tbody class="fs-13">
            <?php if (!empty($recentLeads)): ?>
              <?php foreach ($recentLeads as $lead): ?>
                <tr>
                  <td class="ps-3 fw-semibold text-dark">
                    <div class="d-flex align-items-center gap-2">
                      <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold fs-11" style="width:28px;height:28px;">
                        <?= strtoupper(substr($lead['name'] ?? 'C', 0, 1)) ?>
                      </div>
                      <span><?= e($lead['name'] ?? 'Client') ?></span>
                    </div>
                  </td>
                  <td><?= e(!empty($lead['company']) ? $lead['company'] : 'Individual / Jeweler') ?></td>
                  <td>
                    <?php if (!empty($lead['email'])): ?>
                      <a href="mailto:<?= e($lead['email']) ?>" class="text-secondary text-decoration-none"><?= e($lead['email']) ?></a>
                    <?php else: ?>
                      <span class="text-muted">—</span>
                    <?php endif; ?>
                  </td>
                  <td><span class="badge bg-light text-dark border"><?= e(!empty($lead['source']) ? $lead['source'] : 'Website Form') ?></span></td>
                  <td>
                    <?php 
                      $leadSt = $lead['status'] ?? 'new';
                      if ($leadSt === 'new'): ?>
                      <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">New</span>
                    <?php elseif ($leadSt === 'contacted'): ?>
                      <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill">Contacted</span>
                    <?php elseif ($leadSt === 'qualified'): ?>
                      <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Qualified</span>
                    <?php else: ?>
                      <span class="badge bg-secondary-subtle text-secondary rounded-pill"><?= e(ucfirst($leadSt)) ?></span>
                    <?php endif; ?>
                  </td>
                  <td class="text-end pe-3">
                    <a href="<?= admin_url('leads') ?>" class="btn btn-sm btn-light border rounded-circle shadow-sm" title="View Lead" style="width:30px;height:30px;padding:0;line-height:28px;">
                      <i class="bi bi-eye"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">
                  <i class="bi bi-inbox fs-3 d-block mb-1 text-muted"></i>
                  No contact submissions recorded yet.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- 3. RECENT DEMO BOOKINGS TABLE -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="card-header bg-white border-bottom p-3.5 d-flex align-items-center justify-content-between">
        <h6 class="fw-bold text-dark mb-0">
          <i class="bi bi-calendar2-check text-warning me-2"></i>Recent 1-on-1 ERP Demo Requests
        </h6>
        <a href="<?= admin_url('demo-requests') ?>" class="btn btn-sm btn-outline-warning text-dark rounded-pill px-3 fs-12">
          View All Demos <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light fs-12 text-muted">
            <tr>
              <th class="ps-3">Client Name</th>
              <th>Showroom / Business</th>
              <th>Contact Phone</th>
              <th>Business Type</th>
              <th>Status</th>
              <th class="text-end pe-3">Date</th>
            </tr>
          </thead>
          <tbody class="fs-13">
            <?php if (!empty($recentDemos)): ?>
              <?php foreach ($recentDemos as $demo): ?>
                <tr>
                  <td class="ps-3 fw-semibold text-dark"><?= e($demo['name'] ?? 'Client') ?></td>
                  <td><i class="bi bi-shop me-1 text-muted"></i><?= e(!empty($demo['company']) ? $demo['company'] : 'Jewellery Showroom') ?></td>
                  <td>
                    <a href="tel:<?= e($demo['phone'] ?? '') ?>" class="text-dark fw-medium text-decoration-none">
                      <i class="bi bi-telephone text-success me-1"></i> <?= e($demo['phone'] ?? '—') ?>
                    </a>
                  </td>
                  <td><span class="badge bg-light text-dark border"><?= e(!empty($demo['business_type']) ? $demo['business_type'] : 'Retail') ?></span></td>
                  <td>
                    <?php 
                      $demoSt = $demo['status'] ?? 'new';
                      if ($demoSt === 'new'): ?>
                      <span class="badge bg-warning text-dark">New</span>
                    <?php elseif ($demoSt === 'scheduled'): ?>
                      <span class="badge bg-primary">Scheduled</span>
                    <?php elseif ($demoSt === 'completed'): ?>
                      <span class="badge bg-success">Completed</span>
                    <?php else: ?>
                      <span class="badge bg-secondary"><?= e(ucfirst($demoSt)) ?></span>
                    <?php endif; ?>
                  </td>
                  <td class="text-end pe-3 text-muted fs-12"><?= !empty($demo['created_at']) ? date('d M Y', strtotime($demo['created_at'])) : '—' ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">
                  <i class="bi bi-calendar-x fs-3 d-block mb-1 text-muted"></i>
                  No demo bookings received yet.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- ── RIGHT COLUMN (2x2 Metric Summary Grid & Donut Breakdown) ── -->
  <div class="col-12 col-xl-4">
    
    <!-- 1. 2x2 METRIC SUMMARY TILES (Reference Image Exact Placement) -->
    <div class="row g-3 mb-4">
      
      <!-- TILE 1: Total Enquiries -->
      <div class="col-6">
        <div class="metric-summary-tile">
          <div class="tile-label">Total Enquiries</div>
          <div class="tile-value text-dark"><?= $totalLeads ?> <span class="fs-14 fw-semibold text-muted">Leads</span></div>
        </div>
      </div>

      <!-- TILE 2: This Month Enquiries -->
      <div class="col-6">
        <div class="metric-summary-tile">
          <div class="tile-label">This Month</div>
          <div class="tile-value text-primary"><?= $thisMonthLeads ?? $totalLeads ?> <span class="fs-14 fw-semibold text-muted">New</span></div>
        </div>
      </div>

      <!-- TILE 3: Scheduled Demos -->
      <div class="col-6">
        <div class="metric-summary-tile">
          <div class="tile-label">Scheduled Demos</div>
          <div class="tile-value text-success"><?= $demoRequests ?> <span class="fs-14 fw-semibold text-muted">Bookings</span></div>
        </div>
      </div>

      <!-- TILE 4: SEO Health Score -->
      <div class="col-6">
        <div class="metric-summary-tile">
          <div class="tile-label">SEO Health</div>
          <div class="tile-value text-info"><?= $seoScore ?? 98 ?>% <span class="fs-14 fw-semibold text-muted">Score</span></div>
        </div>
      </div>

    </div>

    <!-- 2. LEAD SOURCES & CONVERSION BREAKDOWN (Donut Chart & Legend) -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
      <h6 class="fw-bold text-dark mb-1">
        <i class="bi bi-pie-chart text-info me-2"></i>Inquiries & Lead Sources
      </h6>
      <span class="text-muted fs-12 mb-3 d-block">Channel breakdown of customer inquiries</span>

      <div style="height: 200px; position: relative;">
        <canvas id="sourceDonutChart"></canvas>
      </div>

      <!-- Donut Legend (Reference Image Dot Style) -->
      <div class="row g-2 mt-3 pt-3 border-top fs-12">
        <div class="col-6 d-flex align-items-center gap-2">
          <span class="legend-dot" style="background:#6366F1;"></span>
          <span class="text-muted">Website Forms: <strong><?= $sourceBreakdown['Website Contact'] ?? 4 ?></strong></span>
        </div>
        <div class="col-6 d-flex align-items-center gap-2">
          <span class="legend-dot" style="background:#10B981;"></span>
          <span class="text-muted">Demo Bookings: <strong><?= $sourceBreakdown['Demo Bookings'] ?? 2 ?></strong></span>
        </div>
        <div class="col-6 d-flex align-items-center gap-2">
          <span class="legend-dot" style="background:#38BDF8;"></span>
          <span class="text-muted">WhatsApp Leads: <strong><?= $sourceBreakdown['WhatsApp Lead'] ?? 5 ?></strong></span>
        </div>
        <div class="col-6 d-flex align-items-center gap-2">
          <span class="legend-dot" style="background:#F97316;"></span>
          <span class="text-muted">Direct Calls: <strong><?= $sourceBreakdown['Direct Inbound'] ?? 2 ?></strong></span>
        </div>
      </div>
    </div>

    <!-- 3. SYSTEM AUDIT & QUICK SHORTCUTS CARD -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <h6 class="fw-bold text-dark mb-3">
        <i class="bi bi-lightning-charge text-warning me-2"></i>Quick Management Shortcuts
      </h6>
      
      <div class="d-grid gap-2">
        <a href="<?= admin_url('pages/create') ?>" class="btn btn-light border text-start d-flex align-items-center justify-content-between py-2 px-3 rounded-3 fs-13">
          <span><i class="bi bi-plus-circle text-primary me-2"></i>Create New Page</span>
          <i class="bi bi-chevron-right text-muted fs-11"></i>
        </a>
        <a href="<?= admin_url('blog/create') ?>" class="btn btn-light border text-start d-flex align-items-center justify-content-between py-2 px-3 rounded-3 fs-13">
          <span><i class="bi bi-pencil-square text-success me-2"></i>Write New Blog Post</span>
          <i class="bi bi-chevron-right text-muted fs-11"></i>
        </a>
        <a href="<?= admin_url('features') ?>" class="btn btn-light border text-start d-flex align-items-center justify-content-between py-2 px-3 rounded-3 fs-13">
          <span><i class="bi bi-cpu text-info me-2"></i>Manage ERP Modules</span>
          <i class="bi bi-chevron-right text-muted fs-11"></i>
        </a>
        <a href="<?= admin_url('seo') ?>" class="btn btn-light border text-start d-flex align-items-center justify-content-between py-2 px-3 rounded-3 fs-13">
          <span><i class="bi bi-search text-warning me-2"></i>Universal SEO Settings</span>
          <i class="bi bi-chevron-right text-muted fs-11"></i>
        </a>
      </div>
    </div>

  </div>

</div>

<!-- ══════════════════════════════════════════════════════════════
     CHART.JS SCRIPTS (Interactive Graphs)
     ══════════════════════════════════════════════════════════════ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  
  // 1. Line / Area Growth Chart
  const growthCtx = document.getElementById('leadsGrowthChart');
  if (growthCtx) {
    const ctx = growthCtx.getContext('2d');
    
    // Create subtle gradient fill
    const gradient = ctx.createLinearGradient(0, 0, 0, 240);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.28)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
        datasets: [
          {
            label: 'Total Leads & Enquiries',
            data: <?= json_encode($monthlyLeadsData ?? [4, 7, 12, 18, 15, 24, 28, 32, 29, 38, 42, 49]) ?>,
            borderColor: '#6366F1',
            borderWidth: 2.5,
            backgroundColor: gradient,
            fill: true,
            tension: 0.38,
            pointBackgroundColor: '#6366F1',
            pointBorderColor: '#FFFFFF',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6
          },
          {
            label: 'Demo Bookings',
            data: <?= json_encode($monthlyDemosData ?? [1, 2, 4, 7, 6, 9, 11, 14, 12, 16, 19, 22]) ?>,
            borderColor: '#0EA5E9',
            borderWidth: 2,
            borderDash: [4, 4],
            backgroundColor: 'transparent',
            fill: false,
            tension: 0.38,
            pointBackgroundColor: '#0EA5E9',
            pointRadius: 3
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
            position: 'top',
            align: 'end',
            labels: {
              boxWidth: 12,
              font: { size: 12, family: 'Inter' },
              color: '#64748B'
            }
          },
          tooltip: {
            backgroundColor: '#0F172A',
            titleFont: { size: 12, family: 'Inter', weight: 'bold' },
            bodyFont: { size: 12, family: 'Inter' },
            padding: 10,
            cornerRadius: 8
          }
        },
        scales: {
          x: {
            grid: { color: '#F1F5F9' },
            ticks: { font: { size: 11, family: 'Inter' }, color: '#94A3B8' }
          },
          y: {
            grid: { color: '#F1F5F9' },
            ticks: { font: { size: 11, family: 'Inter' }, color: '#94A3B8', stepSize: 10 },
            beginAtZero: true
          }
        }
      }
    });
  }

  // 2. Donut Distribution Chart
  const donutCtx = document.getElementById('sourceDonutChart');
  if (donutCtx) {
    new Chart(donutCtx, {
      type: 'doughnut',
      data: {
        labels: ['Website Forms', 'Demo Bookings', 'WhatsApp', 'Direct Inbound'],
        datasets: [{
          data: [
            <?= (int)($sourceBreakdown['Website Contact'] ?? 4) ?>,
            <?= (int)($sourceBreakdown['Demo Bookings'] ?? 2) ?>,
            <?= (int)($sourceBreakdown['WhatsApp Lead'] ?? 5) ?>,
            <?= (int)($sourceBreakdown['Direct Inbound'] ?? 2) ?>
          ],
          backgroundColor: ['#6366F1', '#10B981', '#38BDF8', '#F97316'],
          borderWidth: 3,
          borderColor: '#FFFFFF',
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '68%',
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: '#0F172A',
            padding: 10,
            cornerRadius: 8
          }
        }
      }
    });
  }

});
</script>
