<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>amman.circle</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --yellow: #FFD60A;
      --yellow-deep: #F5C518;
      --yellow-light: #FFE55C;
      --ink: #0A0A0A;
      --bg-text: #E6E6E6;
      --muted: #9A9A9A;
      --error: #F87171;
    }

    body {
      min-height: 100vh;
      background: radial-gradient(ellipse at 60% 0%, #1C1C1C 0%, #0A0A0A 60%);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      font-family: 'Inter', 'Segoe UI', sans-serif;
      color: var(--bg-text);
    }

    .card {
      width: 100%;
      max-width: 520px;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 214, 10, 0.15);
      border-radius: 20px;
      padding: 36px 32px;
      backdrop-filter: blur(12px);
      box-shadow: 0 24px 64px rgba(0, 0, 0, 0.55);
    }

    /* Progress */
    .progress-labels {
      display: flex;
      justify-content: space-between;
      margin-bottom: 6px;
      font-size: 12px;
    }

    .progress-labels .step-count {
      color: var(--yellow);
      font-weight: 700;
      letter-spacing: 1px;
    }

    .progress-labels .pct {
      color: var(--muted);
    }

    .progress-track {
      height: 4px;
      background: #2A2A2A;
      border-radius: 99px;
      margin-bottom: 28px;
    }

    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--yellow-deep), var(--yellow));
      border-radius: 99px;
      transition: width 0.4s cubic-bezier(.4, 0, .2, 1);
    }

    /* Question */
    .q-title {
      color: #FFFFFF;
      font-size: 22px;
      font-weight: 700;
      line-height: 1.4;
      letter-spacing: -0.2px;
      margin-bottom: 24px;
    }

    .q-body {
      min-height: 260px;
    }

    /* Radio options */
    .options {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .opt-btn {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 14px 18px;
      border-radius: 12px;
      cursor: pointer;
      font-size: 15px;
      font-weight: 500;
      text-align: left;
      background: rgba(255, 255, 255, 0.04);
      border: 1.5px solid rgba(255, 255, 255, 0.1);
      color: var(--bg-text);
      transition: all 0.2s cubic-bezier(.4, 0, .2, 1);
      width: 100%;
    }

    .opt-btn:hover {
      /* background: rgba(255, 214, 10, 0.08); */
      border-color: rgba(255, 214, 10, 0.3);
    }

    .opt-btn.selected {
      background: rgba(255, 214, 10, 0.16);
      border-color: var(--yellow);
      color: var(--yellow-light);
      transform: translateX(6px);
    }

    .radio-dot {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      border: 2px solid #555;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      background: transparent;
      transition: all 0.2s;
    }

    .opt-btn.selected .radio-dot {
      border-color: var(--yellow);
      background: var(--yellow);
    }

    .radio-inner {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--ink);
      display: none;
    }

    .opt-btn.selected .radio-inner {
      display: block;
    }

    /* Scale */
    .scale-btns {
      display: flex;
      gap: 8px;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 36px;
    }

    .scale-btn {
      width: 46px;
      height: 46px;
      border-radius: 10px;
      border: 1.5px solid rgba(255, 255, 255, 0.12);
      background: rgba(255, 255, 255, 0.04);
      color: var(--muted);
      font-weight: 400;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.18s;
    }

    .scale-btn:hover {
      border-color: rgba(255, 214, 10, 0.45);
      color: var(--yellow-light);
    }

    .scale-btn.selected {
      background: linear-gradient(135deg, var(--yellow), var(--yellow-deep));
      border-color: var(--yellow);
      color: var(--ink);
      font-weight: 700;
      transform: scale(1.12);
      box-shadow: 0 4px 16px rgba(245, 197, 24, 0.4);
    }

    .scale-labels {
      display: flex;
      justify-content: space-between;
      margin-top: 14px;
      color: var(--muted);
      font-size: 12px;
    }

    /* Inputs */
    input[type="text"],
    input[type="tel"],
    input[type="date"],
    select,
    textarea {
      width: 100%;
      padding: 13px 16px;
      border-radius: 10px;
      border: 1.5px solid rgba(255, 255, 255, 0.12);
      color: var(--bg-text);
      font-size: 15px;
      outline: none;
      font-family: inherit;
      appearance: none;
      color-scheme: dark;
    }

    input::placeholder {
      color: #666;
    }

    input:focus,
    select:focus {
      border-color: var(--yellow);
    }

    input.invalid,
    select.invalid {
      border-color: var(--error);
    }

    .field-label {
      display: block;
      color: var(--muted);
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      margin-bottom: 6px;
      margin-top: 14px;
    }

    .field-error {
      color: var(--error);
      font-size: 12.5px;
      margin-top: 6px;
      line-height: 1.5;
    }

    .field-hint {
      color: var(--muted);
      font-size: 12px;
      margin-top: 6px;
      line-height: 1.5;
    }

    /* Consent */
    .consent-box {
      display: flex;
      gap: 14px;
      align-items: flex-start;
      cursor: pointer;
      background: rgba(255, 255, 255, 0.04);
      border: 1.5px solid rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      padding: 16px 18px;
      transition: all 0.2s;
    }

    .consent-box.checked {
      background: rgba(255, 214, 10, 0.12);
      border-color: var(--yellow);
    }

    .checkbox {
      width: 22px;
      height: 22px;
      border-radius: 6px;
      border: 2px solid #555;
      background: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      margin-top: 1px;
      transition: all 0.2s;
    }

    .consent-box.checked .checkbox {
      border-color: var(--yellow);
      background: var(--yellow);
    }

    .consent-text {
      color: #C8C8C8;
      font-size: 14px;
      line-height: 1.6;
    }

    /* Nav buttons */
    .nav {
      display: flex;
      gap: 12px;
      margin-top: 32px;
    }

    .btn-back {
      padding: 12px 22px;
      border-radius: 10px;
      border: 1.5px solid rgba(255, 255, 255, 0.12);
      background: transparent;
      color: var(--muted);
      font-size: 15px;
      cursor: pointer;
      font-weight: 500;
      font-family: inherit;
    }

    .btn-back:hover {
      border-color: rgba(255, 214, 10, 0.4);
      color: var(--bg-text);
    }

    .btn-next {
      flex: 1;
      padding: 12px 28px;
      border-radius: 10px;
      border: none;
      background: linear-gradient(135deg, var(--yellow), var(--yellow-deep));
      color: var(--ink);
      font-size: 15px;
      cursor: pointer;
      font-weight: 800;
      letter-spacing: 0.2px;
      box-shadow: 0 4px 16px rgba(245, 197, 24, 0.35);
      transition: all 0.2s;
      font-family: inherit;
    }

    .btn-next:disabled {
      background: rgba(255, 255, 255, 0.08);
      color: #555;
      box-shadow: none;
      cursor: not-allowed;
    }

    .btn-next:not(:disabled):hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(245, 197, 24, 0.5);
    }

    /* Intro */
    .intro {
      text-align: center;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 214, 10, 0.15);
      border: 1px solid rgba(255, 214, 10, 0.35);
      border-radius: 99px;
      padding: 6px 16px;
      margin-bottom: 28px;
    }

    .badge-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: var(--yellow);
    }

    .badge-text {
      color: var(--yellow);
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .intro h1 {
      color: #FFFFFF;
      font-size: 28px;
      font-weight: 800;
      line-height: 1.3;
      margin-bottom: 14px;
    }

    .intro p {
      color: var(--muted);
      font-size: 15px;
      line-height: 1.7;
      margin-bottom: 36px;
    }

    .btn-start {
      background: linear-gradient(135deg, var(--yellow), var(--yellow-deep));
      color: var(--ink);
      font-weight: 800;
      font-size: 16px;
      border: none;
      border-radius: 12px;
      padding: 15px 40px;
      cursor: pointer;
      letter-spacing: 0.3px;
      box-shadow: 0 8px 24px rgba(245, 197, 24, 0.4);
      font-family: inherit;
      transition: transform 0.15s;
    }

    .btn-start:hover {
      transform: translateY(-2px);
    }

    /* Success */
    .success {
      text-align: center;
      padding: 40px 0;
    }

    .success-icon {
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--yellow), var(--yellow-deep));
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
      box-shadow: 0 8px 32px rgba(245, 197, 24, 0.4);
    }

    .success h2 {
      color: #FFFFFF;
      font-size: 26px;
      font-weight: 800;
      margin-bottom: 12px;
    }

    .success p {
      color: var(--muted);
      font-size: 15px;
      line-height: 1.7;
      max-width: 320px;
      margin: 0 auto;
    }

    /* Hidden screens */
    .screen {
      display: none;
    }

    .screen.active {
      display: block;
    }
  </style>
</head>

<body>
  <div class="card">

    <!-- INTRO -->
    <div id="screen-intro" class="screen active">
      <div class="intro">
        <div class="badge">
          <div class="badge-dot"></div><span class="badge-text">Social circle by Amman circle</span>
        </div>
        <h1>Find your people.</h1>
        <p>Answer a few quick questions and our algorithm will connect you with the perfect amman.circle — people worth
          knowing, right where you are.</p>
        <button class="btn-start" onclick="startForm()">Start →</button>
      </div>
    </div>

    <!-- FORM -->
    <div id="screen-form" class="screen">
      <div class="progress-labels">
        <span class="step-count" id="step-label">1 / 16</span>
        <span class="pct" id="pct-label">6%</span>
      </div>
      <div class="progress-track">
        <div class="progress-fill" id="progress-fill" style="width:6%"></div>
      </div>
      <div class="q-body" id="q-body"></div>
      <div class="nav">
        <button class="btn-back" onclick="go(-1)">← Back</button>
        <button class="btn-next" id="btn-next" onclick="go(1)" disabled>Next →</button>
      </div>
    </div>

    <!-- SUCCESS -->
    <div id="screen-success" class="screen">
      <div class="success">
        <div class="success-icon">
          <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M6 16L12.5 22.5L26 9" stroke="#0A0A0A" stroke-width="3" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </div>
        <h2>You're in!</h2>
        <p>Our algorithm is working its magic. We'll reach out soon to connect you with your amman.circle.</p>
      </div>
    </div>

  </div>

  <script>
    const SUBMIT_URL = "submit.php";
    const MIN_AGE = 18;

    /* ------------------------------------------------------------------ */
    /*  Validation helpers (regex)                                         */
    /* ------------------------------------------------------------------ */

    // Full name: at least two words, letters (Latin or Arabic), each 2+ chars.
    // Allows spaces, apostrophes and hyphens between words.
    const RE_NAME = /^[\p{L}]{2,}(?:[ '\-][\p{L}]{2,})+$/u;

    // Jordanian mobile number. Accepts +962 / 00962 / 0 prefixes (or none),
    // then 7 followed by 7/8/9 and 7 more digits (079, 078, 077 networks).
    const RE_PHONE = /^(?:\+962|00962|0)?7[789]\d{7}$/;

    // Instagram username: 1-30 chars, letters / numbers / dots / underscores.
    const RE_IG_CHARS = /^[A-Za-z0-9._]{1,30}$/;

    function validateName(v) {
      if (!v || !v.trim()) return "Please enter your full name.";
      return RE_NAME.test(v.trim()) ? "" : "Enter your full name (first and last, letters only).";
    }

    function validatePhone(v) {
      if (!v || !v.trim()) return "Please enter your WhatsApp number.";
      const cleaned = v.replace(/[\s()\-]/g, "");
      return RE_PHONE.test(cleaned) ? "" : "Enter a valid Jordanian mobile (e.g. 079 1234567).";
    }

    function validateInstagram(v) {
      if (!v || !v.trim()) return "Please enter your Instagram username.";
      const handle = v.trim().replace(/^@/, "");
      if (!RE_IG_CHARS.test(handle)) return "Use letters, numbers, dots or underscores (max 30).";
      if (/\.\./.test(handle)) return "Username can't contain two dots in a row.";
      if (/^\.|\.$/.test(handle)) return "Username can't start or end with a dot.";
      return "";
    }

    // Returns "" if valid (>= MIN_AGE), otherwise an error message.
    function validateDOB(v) {
      if (!v) return "Please enter your date of birth.";
      const dob = new Date(v);
      if (isNaN(dob.getTime())) return "Please enter a valid date.";
      const today = new Date();
      let age = today.getFullYear() - dob.getFullYear();
      const m = today.getMonth() - dob.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) age--;
      if (age < MIN_AGE) return `You must be at least ${MIN_AGE} years old to join.`;
      return "";
    }

    // Optional faculty / major: only letters and a few separators if filled in.
    function validateFaculty(v) {
      if (!v || !v.trim()) return "";
      return /^[\p{L}][\p{L} .,&\-/]{1,59}$/u.test(v.trim())
        ? "" : "Use letters only for your major.";
    }

    // Latest date that still satisfies the minimum-age rule (YYYY-MM-DD).
    function maxDOB() {
      const t = new Date();
      return new Date(t.getFullYear() - MIN_AGE, t.getMonth(), t.getDate())
        .toISOString().split('T')[0];
    }

    /* ------------------------------------------------------------------ */
    /*  Questions                                                          */
    /* ------------------------------------------------------------------ */

    const QUESTIONS = [
      { type: "radio", question: "What kind of conversations do you enjoy most?", options: ["Deep & thoughtful", "Fun & lighthearted", "A mix of both"] },
      { type: "radio", question: "How do you usually spend a free evening?", options: ["Out socializing (cafés, events, parties)", "Active (gym, sports, outdoor activities)", "Relaxing (books, movies, gaming, home time)"] },
      { type: "radio", question: "What's your current focus in life?", options: ["Career & business", "Relationships & community", "Fun & new experiences", "Personal growth & learning"] },
      { type: "radio", question: "Which topics excite you the most?", options: ["Business & careers", "Arts & music", "Sports & fitness", "Travel & food", "Science & technology"] },
      { type: "scale", question: "I am an extroverted person", min: 1, max: 10, leftLabel: "Strongly Disagree", rightLabel: "Strongly Agree" },
      { type: "radio", question: "Do you prefer meeting…", options: ["Like-minded people with similar interests", "Different people with new perspectives", "A mix of both"] },
      { type: "radio", question: "What is your relationship status?", options: ["Single", "Married", "In a relationship", "I'd prefer not to share"] },
      { type: "scale", question: "How comfortable are you having a full conversation in English?", min: 1, max: 10, leftLabel: "Not comfortable", rightLabel: "Fully fluent" },
      { type: "date", question: "Date of Birth", default: "2005-01-01", hint: `You must be at least ${MIN_AGE} years old to join.`, validate: validateDOB },
      { type: "select", question: "City", options: ["Amman", "Zarqa", "Irbid", "Russeifa", "Salt", "Madaba", "Aqaba", "Mafraq", "Jerash", "Ajloun", "Karak", "Tafilah", "Ma'an", "Other (please specify)"] },
      { type: "radio", question: "Have you studied or are you currently studying in Jordan?", options: ["Yes", "No, I studied abroad"] },
      { type: "select", question: "Select University", options: ["Ajloun National University", "Al al-Bayt University", "Al-Ahliyya Amman University", "Al-Balqa Applied University", "Al-Hussein Bin Talal University", "Al-Hussein Technical University", "Al-Zaytoonah University of Jordan", "American University of Madaba", "Amman Arab University", "Amman Private University", "Applied Science Private University", "Aqaba University of Technology", "German Jordanian University", "Hashemite University", "Isra University", "Jadara University", "Jerash Private University", "Jordan University of Science and Technology (JUST)", "Middle East University", "Mutah University", "Petra University", "Philadelphia University", "Princess Sumaya University for Technology", "Royal Academy of Culinary Arts", "SAE Institute", "Tafila Technical University", "Talal Abu-Ghazaleh University College for Innovation", "University of Jordan", "Yarmouk University", "Zarqa University", "Other"] },
      { type: "text", question: "Faculty / Major (optional)", placeholder: "e.g. Computer Science", required: false, validate: validateFaculty },
      {
        type: "info", question: "Almost done! Just a few details about you.", fields: [
          { key: "name", label: "Full Name", type: "text", placeholder: "Your name", validate: validateName },
          { key: "whatsapp", label: "WhatsApp Number", type: "tel", placeholder: "+962 7X XXX XXXX", validate: validatePhone },
          { key: "instagram", label: "Instagram @", type: "text", placeholder: "@username", validate: validateInstagram },
          { key: "gender", label: "Gender", type: "select", options: ["Male", "Female"] },
          { key: "occupation", label: "What best describes you?", type: "select", options: ["Student / Learner", "Professional (Employee)", "Entrepreneur / Startup Founder", "Business Owner", "Consultant", "Freelancer / Creative", "Currently Exploring", "Other"] }
        ]
      },
      {
        type: "radio", question: "What type of meetups do you prefer attending?", get options() {
          const info = answers[13] || {};
          const gender = (info.gender || "").toLowerCase();
          if (gender === "male") return ["Mixed group meetups 🤝", "Boys only meetups 👨"];
          if (gender === "female") return ["Mixed group meetups 🤝", "Girls only meetups 👩"];
          return ["Girls only meetups 👩", "Boys only meetups 👨", "Mixed group meetups 🤝"];
        }
      },
      { type: "consent", question: "One last step", label: "By checking this box, you agree that amman.circle may use the information you share to contact you, match you with like-minded people, and send you updates about upcoming meetups." }
    ];

    const TOTAL = QUESTIONS.length;
    let step = 0;
    let answers = {};

    function show(id) {
      document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
      document.getElementById(id).classList.add('active');
    }

    function startForm() {
      show('screen-form');
      render();
    }

    function updateProgress() {
      const pct = Math.round((step + 1) / TOTAL * 100);
      document.getElementById('step-label').textContent = `${step + 1} / ${TOTAL}`;
      document.getElementById('pct-label').textContent = `${pct}%`;
      document.getElementById('progress-fill').style.width = `${pct}%`;
    }

    function escAttr(s) {
      return String(s).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    function canProceed() {
      const q = QUESTIONS[step];
      const v = answers[step];
      switch (q.type) {
        case 'radio': return !!v;
        case 'scale': return v !== null && v !== undefined;
        case 'select': return !!v;
        case 'date': return q.validate ? !q.validate(v) : !!v;
        case 'text':
          if (q.validate) return !q.validate(v);
          return q.required === false ? true : !!v;
        case 'info': {
          const info = v || {};
          return q.fields.every(f => {
            if (f.validate) return !f.validate(info[f.key]);
            return !!info[f.key];
          });
        }
        case 'consent': return !!v;
        default: return true;
      }
    }

    function updateNextBtn() {
      const btn = document.getElementById('btn-next');
      btn.disabled = !canProceed();
      btn.textContent = step === TOTAL - 1 ? 'Submit ✓' : 'Next →';
    }

    function render() {
      updateProgress();
      const q = QUESTIONS[step];

      // Initialise default for date question so the picker starts at the default value.
      if (q.type === 'date' && answers[step] === undefined && q.default) {
        answers[step] = q.default;
      }
      const v = answers[step];
      let html = `<h2 class="q-title">${q.question}</h2>`;

      if (q.type === 'radio') {
        html += `<div class="options">`;
        q.options.forEach(opt => {
          const sel = v === opt ? 'selected' : '';
          html += `<button class="opt-btn ${sel}" onclick="selectRadio('${opt.replace(/'/g, "\\'")}')">
        <span class="radio-dot"><span class="radio-inner"></span></span>${opt}
      </button>`;
        });
        html += `</div>`;

      } else if (q.type === 'scale') {
        html += `<div class="scale-btns">`;
        for (let n = q.min; n <= q.max; n++) {
          const sel = v === n ? 'selected' : '';
          html += `<button class="scale-btn ${sel}" onclick="selectScale(${n})">${n}</button>`;
        }
        html += `</div><div class="scale-labels"><span>${q.leftLabel}</span><span>${q.rightLabel}</span></div>`;

      } else if (q.type === 'select') {
        html += `<select onchange="selectValue(this.value)">
      <option value="" disabled ${!v ? 'selected' : ''}>Please select…</option>`;
        q.options.forEach(opt => {
          html += `<option value="${escAttr(opt)}" ${v === opt ? 'selected' : ''}>${opt}</option>`;
        });
        html += `</select>`;

      } else if (q.type === 'date') {
        const err = q.validate ? q.validate(v) : "";
        html += `<input id="field-inp" type="date" value="${escAttr(v || '')}" max="${maxDOB()}" class="${err ? 'invalid' : ''}" oninput="selectValue(this.value)" />`;
        if (err) {
          html += `<p id="field-fb" class="field-error">⚠️ ${err}</p>`;
        } else {
          html += `<p id="field-fb" class="field-hint">${q.hint || ''}</p>`;
        }

      } else if (q.type === 'text') {
        const err = q.validate ? q.validate(v) : "";
        html += `<input id="field-inp" type="text" placeholder="${escAttr(q.placeholder || '')}" value="${escAttr(v || '')}" class="${(v && err) ? 'invalid' : ''}" oninput="selectValue(this.value)" />`;
        html += `<p id="field-fb" class="field-error" style="${(v && err) ? '' : 'display:none'}">${(v && err) ? '⚠️ ' + err : ''}</p>`;

      } else if (q.type === 'info') {
        const info = v || {};
        q.fields.forEach(f => {
          html += `<label class="field-label">${f.label}</label>`;
          if (f.type === 'select') {
            html += `<select onchange="setInfoField('${f.key}', this.value)">
          <option value="" disabled ${!info[f.key] ? 'selected' : ''}>Select…</option>`;
            f.options.forEach(o => {
              html += `<option value="${escAttr(o)}" ${info[f.key] === o ? 'selected' : ''}>${o}</option>`;
            });
            html += `</select>`;
          } else {
            const err = f.validate ? f.validate(info[f.key]) : "";
            const cur = info[f.key] || '';
            html += `<input id="inp-${f.key}" type="${f.type}" placeholder="${escAttr(f.placeholder || '')}" value="${escAttr(cur)}" class="${(cur && err) ? 'invalid' : ''}" oninput="setInfoField('${f.key}', this.value)" />`;
            html += `<p id="err-${f.key}" class="field-error" style="${(cur && err) ? '' : 'display:none'}">${(cur && err) ? '⚠️ ' + err : ''}</p>`;
          }
        });

      } else if (q.type === 'consent') {
        const checked = !!v;
        html += `<div class="consent-box ${checked ? 'checked' : ''}" onclick="toggleConsent()" id="consent-box">
      <div class="checkbox" id="checkbox">
        ${checked ? '<svg width="12" height="9" viewBox="0 0 12 9" fill="none"><path d="M1 4L4.5 7.5L11 1" stroke="#0A0A0A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>' : ''}
      </div>
      <span class="consent-text">${q.label}</span>
    </div>`;
      }

      document.getElementById('q-body').innerHTML = html;
      updateNextBtn();
    }

    function selectRadio(opt) {
      answers[step] = opt;
      render();
    }

    function selectScale(n) {
      answers[step] = Number(n);
      render();
    }

    function selectValue(val) {
      answers[step] = val;
      const q = QUESTIONS[step];
      // Selects re-render safely; text/date update in-place to preserve focus.
      if (q.type === 'select') {
        render();
        return;
      }
      const err = q.validate ? q.validate(val) : "";
      const inp = document.getElementById('field-inp');
      const fb  = document.getElementById('field-fb');
      if (inp) inp.classList.toggle('invalid', !!(val && err));
      if (fb) {
        if (val && err) {
          fb.className = 'field-error';
          fb.style.display = '';
          fb.textContent = '⚠️ ' + err;
        } else {
          fb.className = q.type === 'date' ? 'field-hint' : 'field-error';
          fb.style.display = q.type === 'date' ? '' : 'none';
          fb.textContent = q.type === 'date' ? (q.hint || '') : '';
        }
      }
      updateNextBtn();
    }

    function setInfoField(key, val) {
      if (!answers[step]) answers[step] = {};
      answers[step][key] = val;
      // Gender change resets the meetup options — re-render is fine (it's a select).
      if (key === 'gender') {
        const meetupStepIndex = QUESTIONS.findIndex(q => q.type === 'radio' && q.question === "What type of meetups do you prefer attending?");
        if (meetupStepIndex !== -1) delete answers[meetupStepIndex];
        render();
        return;
      }
      // For text/tel fields: update error in-place to preserve typing focus.
      const q = QUESTIONS[step];
      const f = q.fields.find(fd => fd.key === key);
      if (f && f.validate) {
        const err = f.validate(val);
        const inp = document.getElementById('inp-' + key);
        const errEl = document.getElementById('err-' + key);
        if (inp) inp.classList.toggle('invalid', !!(val && err));
        if (errEl) {
          errEl.style.display = (val && err) ? '' : 'none';
          errEl.textContent = (val && err) ? '⚠️ ' + err : '';
        }
      }
      updateNextBtn();
    }

    function toggleConsent() {
      answers[step] = !answers[step];
      render();
    }

    async function go(dir) {
      if (dir === 1) {
        if (!canProceed()) return;
        if (step === TOTAL - 1) {
          const btn = document.getElementById('btn-next');
          btn.disabled = true;
          btn.textContent = 'Saving…';
          await submitToSheet();
          show('screen-success');
        } else {
          step++;
          render();
        }
      } else {
        if (step > 0) { step--; render(); }
        else { show('screen-intro'); }
      }
    }

    async function submitToSheet() {
      const info = answers[13] || {};
      const data = {
        conversations: String(answers[0] || ""),
        evenings: String(answers[1] || ""),
        focus: String(answers[2] || ""),
        topics: String(answers[3] || ""),
        extroversion: answers[4] !== undefined && answers[4] !== null ? String(answers[4]) : "",
        meeting_pref: String(answers[5] || ""),
        relationship: String(answers[6] || ""),
        english: answers[7] !== undefined && answers[7] !== null ? String(answers[7]) : "",
        dob: String(answers[8] || ""),
        city: String(answers[9] || ""),
        studied_jordan: String(answers[10] || ""),
        university: String(answers[11] || ""),
        faculty: String(answers[12] || ""),
        name: String(info.name || ""),
        whatsapp: String(info.whatsapp || ""),
        instagram: String(info.instagram || ""),
        gender: String(info.gender || ""),
        occupation: String(info.occupation || ""),
        meetup_type: String(answers[14] || ""),
        consent: answers[15] ? "Yes" : "No"
      };
      try {
        const res = await fetch(SUBMIT_URL, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ data })
        });
        const result = await res.json();
        console.log("SheetDB response:", result);
      } catch (e) {
        console.error("SheetDB error:", e);
      }
    }
  </script>
</body>

</html>
