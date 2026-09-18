<!-- ═══════════════════════════════════════════════════════════════
     BOOK A FREE DEMO MODAL (MATCHING EXACT REFERENCE DESIGN)
     Location: views/frontend/partials/demo-modal.php
     ═══════════════════════════════════════════════════════════════ -->
<style>
#bookDemoModal .modal-dialog {
  max-width: 520px;
}
#bookDemoModal .modal-content {
  border-radius: 24px;
  border: none;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
  background: #FFFFFF;
  padding: 32px 36px 28px;
}
#bookDemoModal .modal-header {
  padding: 0;
  border: none;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
}
#bookDemoModal .modal-body {
  padding: 0;
}
.demo-logo-brand {
  font-family: var(--gm-font-display, inherit);
  font-size: 22px;
  font-weight: 800;
  display: inline-flex;
  align-items: center;
  letter-spacing: -0.02em;
}
.demo-logo-gold {
  color: #F5A623;
}
.demo-logo-dark {
  color: #0F172A;
}
.demo-close-btn {
  background: transparent;
  border: none;
  color: #64748B;
  font-size: 20px;
  cursor: pointer;
  padding: 4px;
  line-height: 1;
  transition: color 0.15s ease;
}
.demo-close-btn:hover {
  color: #0F172A;
}
.demo-title-h2 {
  font-size: 24px;
  font-weight: 800;
  color: #0F172A;
  margin: 0 0 6px;
  letter-spacing: -0.02em;
}
.demo-subtitle-p {
  font-size: 14px;
  color: #64748B;
  margin-bottom: 18px;
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
/* Date + Time Slot picker (modal) */
.demo-datetime-wrap { display: flex; flex-direction: column; gap: 10px; }
.demo-date-row {
  display: flex;
  align-items: center;
  border: 1.5px solid #E2E8F0;
  border-radius: 10px;
  background: #fff;
  transition: border-color 0.18s ease, box-shadow 0.18s ease;
  overflow: hidden;
}
.demo-date-row:focus-within {
  border-color: #F5A623;
  box-shadow: 0 0 0 3px rgba(245,166,35,0.15);
}
.demo-date-input {
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
.demo-date-input::-webkit-calendar-picker-indicator { opacity: 0.5; cursor: pointer; }
.demo-slots-label {
  font-size: 11px;
  font-weight: 700;
  color: #64748B;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  margin-bottom: 4px;
}
.demo-slots {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 7px;
}
.demo-slot-btn {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 2px;
  padding: 8px 12px;
  border: 1.5px solid #E2E8F0;
  border-radius: 9px;
  background: #FAFAFA;
  cursor: pointer;
  transition: border-color 0.18s ease, background 0.18s ease, box-shadow 0.18s ease;
  text-align: left;
}
.demo-slot-btn:hover { border-color: #F5A623; background: #FFFBF0; }
.demo-slot-btn.active {
  border-color: #F5A623;
  background: linear-gradient(135deg, #FFF8E6 0%, #FFFBF0 100%);
  box-shadow: 0 0 0 3px rgba(245,166,35,0.15);
}
.demo-slot-name {
  font-size: 12px;
  font-weight: 700;
  color: #1E293B;
  display: flex;
  align-items: center;
  gap: 4px;
}
.demo-slot-time { font-size: 10.5px; color: #64748B; font-weight: 500; }
.demo-slot-btn.active .demo-slot-name { color: #B45309; }
.demo-slot-btn.active .demo-slot-time  { color: #92400E; }
</style>

<div class="modal fade" id="bookDemoModal" tabindex="-1" aria-labelledby="bookDemoModalLabel" aria-hidden="true" style="z-index: 1070;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <!-- Top Close Button -->
      <div class="d-flex justify-content-end mb-2">
        <button type="button" class="demo-close-btn" data-bs-dismiss="modal" aria-label="Close">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        
        <h2 class="demo-title-h2">Connect with Our Team</h2>
        <p class="demo-subtitle-p">Schedule a 1-on-1 walkthrough tailored to your jewellery business.</p>

        <!-- 4 Feature Badges Row -->
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

        <!-- Feedback Alert Container -->
        <div id="demoModalFeedback" class="alert d-none mb-3 py-2 px-3 fs-13" role="alert"></div>

        <!-- The Demo Form -->
        <form id="bookDemoForm" onsubmit="handleBookDemoSubmit(event)">
          <input type="hidden" name="source" id="demo_source_input" value="Website Book Demo Modal">

          <!-- 1. Full Name -->
          <div class="demo-field-group">
            <label class="demo-field-label">Full Name <span class="text-danger">*</span></label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-person"></i></span>
              <input type="text" name="name" id="demo_name" class="demo-input-control" placeholder="Enter your full name" required>
            </div>
          </div>

          <!-- 2. Business / Showroom Name -->
          <div class="demo-field-group">
            <label class="demo-field-label">Business / Showroom Name <span class="text-danger">*</span></label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-shop"></i></span>
              <input type="text" name="company" id="demo_company" class="demo-input-control" placeholder="e.g. Aurum Fine Jewellery LLC" required>
            </div>
          </div>

          <!-- 3. Phone / WhatsApp -->
          <div class="demo-field-group">
            <label class="demo-field-label">Phone / WhatsApp <span class="text-danger">*</span></label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-telephone"></i></span>
              <input type="tel" name="phone" id="demo_phone" class="demo-input-control" placeholder="+971 50 123 4567 / +1 212 555 0199" required>
            </div>
          </div>

          <!-- 4. Work Email -->
          <div class="demo-field-group">
            <label class="demo-field-label">Work Email</label>
            <div class="demo-input-box">
              <span class="demo-input-icon"><i class="bi bi-envelope"></i></span>
              <input type="email" name="email" id="demo_email" class="demo-input-control" placeholder="alexander@aurumjewellers.com">
            </div>
          </div>

          <!-- 5. Business Type & No. of Locations (2-Col Grid) -->
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
              <input type="text" name="country" id="demo_location" class="demo-input-control" placeholder="e.g. Dubai, UAE / London / New York">
            </div>
          </div>

          <!-- 7. Preferred Demo Time -->
          <div class="demo-field-group mb-4">
            <label class="demo-field-label">Preferred Demo Date &amp; Time</label>
            <input type="hidden" name="preferred_time" id="modalPreferredTime">
            <div class="demo-datetime-wrap">
              <div class="demo-date-row">
                <span class="demo-input-icon"><i class="bi bi-calendar2"></i></span>
                <input type="date" class="demo-date-input" id="modalDemoDate"
                  min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                  max="<?= date('Y-m-d', strtotime('+90 days')) ?>">
              </div>
              <div>
                <div class="demo-slots-label"><i class="bi bi-clock me-1"></i>Preferred Time Slot</div>
                <div class="demo-slots" id="modalDemoSlots">
                  <button type="button" class="demo-slot-btn" data-slot="Morning (10:00 AM - 01:00 PM)">
                    <span class="demo-slot-name"><i class="bi bi-brightness-high"></i> Morning</span>
                    <span class="demo-slot-time">10:00 AM – 01:00 PM</span>
                  </button>
                  <button type="button" class="demo-slot-btn" data-slot="Afternoon (02:00 PM - 05:00 PM)">
                    <span class="demo-slot-name"><i class="bi bi-sun"></i> Afternoon</span>
                    <span class="demo-slot-time">02:00 PM – 05:00 PM</span>
                  </button>
                  <button type="button" class="demo-slot-btn" data-slot="Evening (05:00 PM - 08:00 PM)">
                    <span class="demo-slot-name"><i class="bi bi-moon"></i> Evening</span>
                    <span class="demo-slot-time">05:00 PM – 08:00 PM</span>
                  </button>
                  <button type="button" class="demo-slot-btn" data-slot="Immediately (Earliest Available)">
                    <span class="demo-slot-name"><i class="bi bi-lightning-charge"></i> ASAP</span>
                    <span class="demo-slot-time">Earliest Available</span>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" id="demoSubmitBtn" class="demo-btn-submit">
            <span id="demoSubmitBtnText">Connect with Our Team</span>
            <i class="bi bi-arrow-right" id="demoSubmitBtnIcon"></i>
            <span id="demoSubmitBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
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
</div>

<script>
/**
 * Global Demo Modal Submission Handler
 */
function handleBookDemoSubmit(e) {
  e.preventDefault();
  
  const form = document.getElementById('bookDemoForm');
  const btn = document.getElementById('demoSubmitBtn');
  const btnText = document.getElementById('demoSubmitBtnText');
  const btnIcon = document.getElementById('demoSubmitBtnIcon');
  const btnSpinner = document.getElementById('demoSubmitBtnSpinner');
  const feedback = document.getElementById('demoModalFeedback');

  // Loading State
  btn.disabled = true;
  btnText.textContent = 'Submitting...';
  btnIcon.classList.add('d-none');
  btnSpinner.classList.remove('d-none');
  feedback.className = 'alert d-none mb-3 py-2 px-3 fs-13';

  const formData = new FormData(form);

  fetch('/api/demo-request', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    feedback.classList.remove('d-none');
    if (data.success) {
      feedback.className = 'alert alert-success d-flex align-items-center gap-2 mb-3 py-2 px-3 fs-13 border-0 shadow-sm';
      feedback.innerHTML = '<i class="bi bi-check-circle-fill text-success fs-5 flex-shrink-0"></i><div><strong>Demo Requested!</strong> ' + data.message + '</div>';
      form.reset();
      /* clear modal slot UI */
      document.querySelectorAll('#modalDemoSlots .demo-slot-btn').forEach(b => b.classList.remove('active'));
      document.getElementById('modalPreferredTime').value = '';
      
      // Reset button
      btnText.textContent = 'Demo Requested!';
      btnSpinner.classList.add('d-none');
      btnIcon.classList.remove('d-none');
      btnIcon.className = 'bi bi-check-lg';

      // Auto close modal after 3 seconds
      setTimeout(() => {
        const modalEl = document.getElementById('bookDemoModal');
        if (modalEl && typeof bootstrap !== 'undefined') {
          const bsModal = bootstrap.Modal.getInstance(modalEl);
          if (bsModal) bsModal.hide();
        }
        // Restore button state
        btn.disabled = false;
        btnText.textContent = 'Request My Demo';
        btnIcon.className = 'bi bi-arrow-right';
      }, 3000);

    } else {
      feedback.className = 'alert alert-danger d-flex align-items-center gap-2 mb-3 py-2 px-3 fs-13 border-0 shadow-sm';
      feedback.innerHTML = '<i class="bi bi-exclamation-triangle-fill text-danger fs-5 flex-shrink-0"></i><div>' + (data.message || 'Please check your inputs and try again.') + '</div>';
      btn.disabled = false;
      btnText.textContent = 'Request My Demo';
      btnSpinner.classList.add('d-none');
      btnIcon.classList.remove('d-none');
    }
  })
  .catch(err => {
    console.error(err);
    feedback.classList.remove('d-none');
    feedback.className = 'alert alert-danger d-flex align-items-center gap-2 mb-3 py-2 px-3 fs-13 border-0 shadow-sm';
    feedback.innerHTML = '<i class="bi bi-exclamation-triangle-fill text-danger fs-5 flex-shrink-0"></i><div>Network error. Please try again.</div>';
    btn.disabled = false;
    btnText.textContent = 'Request My Demo';
    btnSpinner.classList.add('d-none');
    btnIcon.classList.remove('d-none');
  });
}

/* ── Date + Time Slot picker logic (Modal form) ── */
(function () {
  const dateInput = document.getElementById('modalDemoDate');
  const hidden    = document.getElementById('modalPreferredTime');
  const slotBtns  = document.querySelectorAll('#modalDemoSlots .demo-slot-btn');
  let selectedSlot = '';

  function updateHidden() {
    if (!selectedSlot) { hidden.value = ''; return; }
    const datePart = dateInput && dateInput.value
      ? new Date(dateInput.value).toLocaleDateString('en-IN', { day:'2-digit', month:'short', year:'numeric' })
      : '';
    hidden.value = datePart ? datePart + ' — ' + selectedSlot : selectedSlot;
  }

  slotBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      slotBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      selectedSlot = this.dataset.slot;
      updateHidden();
    });
  });

  if (dateInput) dateInput.addEventListener('change', updateHidden);
})();
</script>
