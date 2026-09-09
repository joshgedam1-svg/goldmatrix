<?php
/**
 * GoldMatrix — Request Free Demo Page (Matching Exact Reference Design)
 */
require __DIR__ . '/partials/header.php';
?>

<style>
.demo-page-container {
  background: #0A1128;
  background: radial-gradient(circle at 50% 0%, #111C3A 0%, #050B18 70%);
  padding: 100px 5% 80px;
  position: relative;
  overflow: hidden;
}
.demo-page-card {
  border-radius: 24px;
  border: none;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
  background: #FFFFFF;
  padding: 36px 38px 30px;
  max-width: 520px;
  margin: 0 auto;
}
.demo-feat-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 13.5px;
  font-weight: 600;
  color: #1E293B;
}
.demo-feat-pill i {
  color: #F5A623;
  font-size: 15px;
}
.demo-field-group {
  margin-bottom: 14px;
}
.demo-field-label {
  font-size: 13px;
  font-weight: 700;
  color: #1E293B;
  margin-bottom: 6px;
  display: block;
}
.demo-input-box {
  display: flex;
  align-items: center;
  border: 1.5px solid #E2E8F0;
  border-radius: 10px;
  background: #FFFFFF;
  transition: border-color 0.18s ease, box-shadow 0.18s ease;
  overflow: hidden;
}
.demo-input-box:focus-within {
  border-color: #F5A623;
  box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.15);
}
.demo-input-icon {
  padding: 0 12px 0 14px;
  color: #94A3B8;
  font-size: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.demo-input-control {
  border: none !important;
  outline: none !important;
  box-shadow: none !important;
  width: 100%;
  padding: 10px 14px 10px 0;
  font-size: 14px;
  color: #0F172A;
  background: transparent;
}
.demo-input-control::placeholder {
  color: #94A3B8;
  font-weight: 400;
}
.demo-select-control {
  border: none !important;
  outline: none !important;
  box-shadow: none !important;
  width: 100%;
  padding: 10px 14px 10px 0;
  font-size: 14px;
  color: #0F172A;
  background: transparent;
  cursor: pointer;
}
.demo-btn-submit {
  background: #F5A623;
  background: linear-gradient(180deg, #FBBF24 0%, #F5A623 100%);
  color: #0F172A;
  font-weight: 700;
  font-size: 15.5px;
  border: none;
  border-radius: 10px;
  padding: 13px 20px;
  width: 100%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  box-shadow: 0 4px 14px rgba(245, 166, 35, 0.3);
  cursor: pointer;
  margin-top: 8px;
  transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
}
.demo-btn-submit:hover {
  transform: translateY(-1px);
  box-shadow: 0 6px 18px rgba(245, 166, 35, 0.4);
  background: linear-gradient(180deg, #F59E0B 0%, #D97706 100%);
  color: #0F172A;
}
.demo-trust-footer {
  margin-top: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  font-size: 13px;
  color: #64748B;
}
.demo-trust-footer i {
  color: #10B981;
  font-size: 17px;
}
</style>

<section class="demo-page-container">
  <div style="max-width:1160px; margin:0 auto; display:grid; grid-template-columns:1fr 1.15fr; gap:60px; align-items:start; position:relative; z-index:1;">

    <!-- LEFT: Info Column -->
    <div>
      <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(245,158,11,0.12); color:#FBBF24; font-size:11px; font-weight:700; letter-spacing:1.8px; text-transform:uppercase; padding:6px 16px; border-radius:20px; border:1px solid rgba(245,158,11,0.25); margin-bottom:20px;">
        <i class="bi bi-shield-check me-1"></i> LIVE 1-ON-1 DEMO
      </div>
      <h1 style="font-family:var(--gm-font-display, inherit); font-size:clamp(2rem,3.8vw,2.9rem); font-weight:900; color:#FFFFFF; line-height:1.2; letter-spacing:-0.5px; margin-bottom:18px;">
        Book Your Free<br><span style="color:#F59E0B;">Jewellery ERP Demo</span>
      </h1>
      <p style="font-size:16px; color:#94A3B8; line-height:1.75; margin-bottom:32px;">
        Experience how GoldMatrix ERP orchestrates point-of-sale, jobwork manufacturing, RFID scanning, and multi-branch operations for jewellery businesses.
      </p>

      <div style="display:flex; flex-direction:column; gap:16px; margin-bottom:36px;">
        <?php foreach([
          ['bi-clock-fill',        '30-Minute live personalized walkthrough'],
          ['bi-person-video3',     'Customized for your showroom or factory workflow'],
          ['bi-check-circle-fill', 'Zero commitment, no credit card required'],
          ['bi-shield-fill-check', 'Expert implementation guidance included'],
        ] as $pt): ?>
        <div style="display:flex; align-items:center; gap:14px;">
          <div style="width:34px; height:34px; background:rgba(245,158,11,0.12); border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <i class="bi <?= $pt[0] ?>" style="color:#FBBF24; font-size:14px;"></i>
          </div>
          <span style="color:#E2E8F0; font-size:15px; font-weight:500;"><?= $pt[1] ?></span>
        </div>
        <?php endforeach; ?>
      </div>

      <div style="padding:24px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:16px; backdrop-filter:blur(8px);">
        <div style="font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:1.5px; color:#94A3B8; margin-bottom:14px;">Direct Contact</div>
        <div style="display:flex; flex-direction:column; gap:12px;">
          <a href="tel:+971563240319" style="display:flex; align-items:center; gap:12px; color:#FFFFFF; text-decoration:none; font-size:14.5px; font-weight:600;">
            <i class="bi bi-telephone-fill" style="color:#FBBF24;"></i> +971 56 324 0319 <span style="font-size:12px; color:#94A3B8; font-weight:normal;">(UAE HQ)</span>
          </a>
          <a href="tel:+919270369937" style="display:flex; align-items:center; gap:12px; color:#FFFFFF; text-decoration:none; font-size:14.5px; font-weight:600;">
            <i class="bi bi-telephone-fill" style="color:#FBBF24;"></i> +91 92703 69937 <span style="font-size:12px; color:#94A3B8; font-weight:normal;">(India Hub)</span>
          </a>
          <a href="https://wa.me/971563240319?text=Hello%20GoldMatrix,%20I%20want%20to%20schedule%20a%20demo" target="_blank" style="display:flex; align-items:center; gap:12px; color:#25D366; text-decoration:none; font-size:14.5px; font-weight:700;">
            <i class="bi bi-whatsapp" style="color:#25D366; font-size:16px;"></i> WhatsApp Concierge (+971 56 324 0319)
          </a>
        </div>
      </div>
    </div>

    <!-- RIGHT: Exact Card Form -->
    <div>
      <div class="demo-page-card">
        
        <h2 style="font-size: 24px; font-weight: 800; color: #0F172A; margin: 0 0 6px;">Book a Free Demo</h2>
        <p style="font-size: 14px; color: #64748B; margin-bottom: 18px;">See how GoldMatrix can work for your business.</p>

        <!-- Feature Pills -->
        <div class="d-flex align-items-center gap-3 flex-wrap mb-3.5 pb-1">
          <div class="demo-feat-pill">
            <i class="bi bi-check-circle-fill"></i> POS
          </div>
          <div class="demo-feat-pill">
            <i class="bi bi-check-circle-fill"></i> Inventory
          </div>
          <div class="demo-feat-pill">
            <i class="bi bi-check-circle-fill"></i> Manufacturing
          </div>
          <div class="demo-feat-pill">
            <i class="bi bi-check-circle-fill"></i> Accounts
          </div>
        </div>

        <!-- Alert Msg -->
        <div id="demoPageMsg" class="alert d-none mb-3 py-2 px-3 fs-13" role="alert"></div>

        <!-- Form -->
        <form id="demoPageForm" onsubmit="submitDemoPageForm(event)">
          
          <!-- 1. Full Name -->
          <div class="demo-field-group">
            <label class="demo-field-label">Full Name <span class="text-danger">*</span></label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-person"></i></span>
              <input type="text" name="name" class="demo-input-control" placeholder="Enter your full name" required>
            </div>
          </div>

          <!-- 2. Business / Showroom Name -->
          <div class="demo-field-group">
            <label class="demo-field-label">Business / Showroom Name <span class="text-danger">*</span></label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-shop"></i></span>
              <input type="text" name="company" class="demo-input-control" placeholder="e.g. Aurum Fine Jewellery LLC" required>
            </div>
          </div>

          <!-- 3. Phone / WhatsApp -->
          <div class="demo-field-group">
            <label class="demo-field-label">Phone / WhatsApp <span class="text-danger">*</span></label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-telephone"></i></span>
              <input type="tel" name="phone" class="demo-input-control" placeholder="+971 50 123 4567 / +1 212 555 0199" required>
            </div>
          </div>

          <!-- 4. Work Email -->
          <div class="demo-field-group">
            <label class="demo-field-label">Work Email</label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-envelope"></i></span>
              <input type="email" name="email" class="demo-input-control" placeholder="alexander@aurumjewellers.com">
            </div>
          </div>

          <!-- 5. Business Type & No. of Locations -->
          <div class="row g-2 demo-field-group">
            <div class="col-6">
              <label class="demo-field-label">Business Type</label>
              <div class="demo-input-box">
                <span class="demo-input-icon"><i class="bi bi-grid"></i></span>
                <select name="business_type" class="demo-select-control">
                  <option value="" selected disabled>Select type</option>
                  <option value="Retail Jewellery Showroom">Retail Showroom</option>
                  <option value="Wholesale & Bullion Trading">Wholesale & Bullion</option>
                  <option value="Jewellery Manufacturing Unit">Manufacturing Unit</option>
                  <option value="Multi-Branch Chain Store">Multi-Branch Chain</option>
                  <option value="Diamond & Luxury Boutique">Diamond Specialist</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <label class="demo-field-label">No. of Locations</label>
              <div class="demo-input-box">
                <span class="demo-input-icon"><i class="bi bi-geo-alt"></i></span>
                <select name="number_of_branches" class="demo-select-control">
                  <option value="" selected disabled>Select</option>
                  <option value="Single Showroom (1 Branch)">1 Branch</option>
                  <option value="2 to 3 Branches">2 to 3 Branches</option>
                  <option value="4 to 10 Branches">4 to 10 Branches</option>
                  <option value="10+ Enterprise Outlets">10+ Outlets</option>
                </select>
              </div>
            </div>
          </div>

          <!-- 6. City / Region -->
          <div class="demo-field-group">
            <label class="demo-field-label">City / Region</label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-geo-alt"></i></span>
              <input type="text" name="country" class="demo-input-control" placeholder="e.g. Dubai, UAE / London / New York">
            </div>
          </div>

          <!-- 7. Preferred Demo Time -->
          <div class="demo-field-group mb-4">
            <label class="demo-field-label">Preferred Demo Time</label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-calendar2"></i></span>
              <select name="preferred_time" class="demo-select-control">
                <option value="" selected disabled>Select date & time</option>
                <option value="Morning (10:00 AM - 01:00 PM)">Morning (10:00 AM - 01:00 PM)</option>
                <option value="Afternoon (02:00 PM - 05:00 PM)">Afternoon (02:00 PM - 05:00 PM)</option>
                <option value="Evening (05:00 PM - 08:00 PM)">Evening (05:00 PM - 08:00 PM)</option>
                <option value="Immediately (Earliest Available)">Immediately (Earliest Available)</option>
              </select>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" id="demoPageSubmitBtn" class="demo-btn-submit">
            <span id="demoPageBtnText">Request My Demo</span>
            <i class="bi bi-arrow-right"></i>
          </button>
        </form>

        <!-- Trust Security Footer -->
        <div class="demo-trust-footer">
          <i class="bi bi-shield-check"></i>
          <span>Your information is safe with us.</span>
        </div>

      </div>
    </div>

  </div>
</section>

<script>
function submitDemoPageForm(e) {
  e.preventDefault();
  const form = e.target;
  const btn = document.getElementById('demoPageSubmitBtn');
  const btnText = document.getElementById('demoPageBtnText');
  const msg = document.getElementById('demoPageMsg');
  
  btn.disabled = true;
  btnText.textContent = 'Submitting...';
  msg.className = 'alert d-none mb-3 py-2 px-3 fs-13';

  const data = new FormData(form);
  data.set('source', 'Request Demo Page');
  
  fetch('/api/demo-request', { method: 'POST', body: data })
    .then(r => r.json())
    .then(res => {
      msg.classList.remove('d-none');
      if (res.success) {
        msg.className = 'alert alert-success d-flex align-items-center gap-2 mb-3 py-2 px-3 fs-13 border-0 shadow-sm';
        msg.innerHTML = '<i class="bi bi-check-circle-fill text-success fs-5 flex-shrink-0"></i><div><strong>Demo Requested!</strong> ' + res.message + '</div>';
        form.reset();
        btnText.textContent = 'Demo Requested!';
      } else {
        msg.className = 'alert alert-danger d-flex align-items-center gap-2 mb-3 py-2 px-3 fs-13 border-0 shadow-sm';
        msg.innerHTML = '<i class="bi bi-exclamation-triangle-fill text-danger fs-5 flex-shrink-0"></i><div>' + (res.message || 'Please check your inputs and try again.') + '</div>';
        btn.disabled = false;
        btnText.textContent = 'Request My Demo';
      }
    })
    .catch(() => {
      msg.classList.remove('d-none');
      msg.className = 'alert alert-danger d-flex align-items-center gap-2 mb-3 py-2 px-3 fs-13 border-0 shadow-sm';
      msg.innerHTML = '<i class="bi bi-exclamation-triangle-fill text-danger fs-5 flex-shrink-0"></i><div>Network error. Please try again.</div>';
      btn.disabled = false;
      btnText.textContent = 'Request My Demo';
    });
}
</script>

<?php require __DIR__ . '/partials/footer.php'; ?>
