/**
 * Blog Real-Time SEO & Content Readability Analyzer (RankMath Style)
 * Analyzes focus keyword, metadata, headings, word counts, readability and generates score (0-100)
 */

class BlogSeoAnalyzer {
  constructor(config = {}) {
    this.config = Object.assign({
      titleInput: '#post_title',
      slugInput: '#post_slug',
      keywordInput: '#focus_keyword',
      metaTitleInput: '#meta_title',
      metaDescInput: '#meta_description',
      altTextInput: '#alt_text',
      scoreBadge: '#seo_score_badge',
      scoreText: '#seo_score_text',
      scoreLevel: '#seo_score_level',
      scoreProgress: '#seo_score_progress',
      checklistContainer: '#seo_checklist_results',
      previewTitle: '#preview_google_title',
      previewUrl: '#preview_google_url',
      previewDesc: '#preview_google_desc',
      siteBaseUrl: 'http://localhost:8085/blog/'
    }, config);

    this.init();
  }

  init() {
    // Bind listeners
    const inputs = [
      this.config.titleInput,
      this.config.slugInput,
      this.config.keywordInput,
      this.config.metaTitleInput,
      this.config.metaDescInput,
      this.config.altTextInput
    ];

    inputs.forEach(sel => {
      const el = document.querySelector(sel);
      if (el) {
        el.addEventListener('input', () => this.analyze());
        el.addEventListener('change', () => this.analyze());
      }
    });

    // Run initial analysis
    setTimeout(() => this.analyze(), 500);
  }

  getContentHtml() {
    if (window.quillEditor) {
      return window.quillEditor.root.innerHTML;
    }
    const txtArea = document.querySelector('#post_content');
    return txtArea ? txtArea.value : '';
  }

  getContentText() {
    if (window.quillEditor) {
      return window.quillEditor.getText();
    }
    const html = this.getContentHtml();
    const temp = document.createElement('div');
    temp.innerHTML = html;
    return temp.textContent || temp.innerText || '';
  }

  analyze() {
    const title = (document.querySelector(this.config.titleInput)?.value || '').trim();
    const slug = (document.querySelector(this.config.slugInput)?.value || '').trim();
    const keyword = (document.querySelector(this.config.keywordInput)?.value || '').trim().toLowerCase();
    const metaTitle = (document.querySelector(this.config.metaTitleInput)?.value || '').trim() || title;
    const metaDesc = (document.querySelector(this.config.metaDescInput)?.value || '').trim();
    const altText = (document.querySelector(this.config.altTextInput)?.value || '').trim();
    
    const html = this.getContentHtml();
    const text = this.getContentText();
    const words = text.trim() ? text.trim().split(/\s+/).filter(w => w.length > 0) : [];
    const wordCount = words.length;

    // Update Live Google Preview
    this.updateGooglePreview(title, slug, metaTitle, metaDesc);

    // Run Checks
    const results = {
      basic: [],
      titleReadability: [],
      contentReadability: [],
      media: []
    };

    let totalScore = 0;
    let maxScore = 100;

    /* ─────────────────────────────────────────────
     * 1. KEYWORD & BASIC SEO (Weight: 45 pts)
     * ───────────────────────────────────────────── */
    if (!keyword) {
      results.basic.push({
        status: 'fail',
        text: 'Add a Focus Keyword to enable comprehensive SEO scoring.',
        tip: 'Choose a primary search phrase your audience uses.'
      });
    } else {
      // 1. Keyword in SEO Title (10 pts)
      if (metaTitle.toLowerCase().includes(keyword)) {
        totalScore += 10;
        results.basic.push({
          status: 'pass',
          text: `Focus keyword found in SEO Title.`,
          tip: ''
        });
      } else {
        results.basic.push({
          status: 'fail',
          text: `SEO Title does not contain focus keyword "${keyword}".`,
          tip: 'Add your focus keyword naturally into the title.'
        });
      }

      // 2. Keyword in Meta Description (8 pts)
      if (metaDesc.toLowerCase().includes(keyword)) {
        totalScore += 8;
        results.basic.push({
          status: 'pass',
          text: `Focus keyword found in Meta Description.`,
          tip: ''
        });
      } else {
        results.basic.push({
          status: 'warn',
          text: `Meta Description does not contain focus keyword.`,
          tip: 'Insert the focus keyword within the first 120 characters.'
        });
      }

      // 3. Keyword in URL / Slug (7 pts)
      const cleanKwSlug = keyword.replace(/\s+/g, '-');
      if (slug.toLowerCase().includes(cleanKwSlug) || slug.toLowerCase().includes(keyword.replace(/\s+/g, ''))) {
        totalScore += 7;
        results.basic.push({
          status: 'pass',
          text: `Focus keyword found in URL slug.`,
          tip: ''
        });
      } else {
        results.basic.push({
          status: 'warn',
          text: `Focus keyword not detected in URL slug.`,
          tip: `Try including "${cleanKwSlug}" in your slug.`
        });
      }

      // 4. Keyword in First 10% or 100 words of content (8 pts)
      const first100Words = words.slice(0, 100).join(' ').toLowerCase();
      if (first100Words.includes(keyword)) {
        totalScore += 8;
        results.basic.push({
          status: 'pass',
          text: `Focus keyword appears near the beginning of content.`,
          tip: ''
        });
      } else {
        results.basic.push({
          status: 'warn',
          text: `Focus keyword not found in the first 100 words.`,
          tip: 'Introduce the core topic early in the opening paragraph.'
        });
      }

      // 5. Keyword in Headings (H2/H3) (6 pts)
      const headingMatches = html.match(/<h[2-3][^>]*>(.*?)<\/h[2-3]>/gi) || [];
      const hasKwInHeading = headingMatches.some(h => h.toLowerCase().includes(keyword));
      if (hasKwInHeading) {
        totalScore += 6;
        results.basic.push({
          status: 'pass',
          text: `Focus keyword found in subheadings (H2/H3).`,
          tip: ''
        });
      } else {
        results.basic.push({
          status: 'warn',
          text: `Use focus keyword in at least one H2 or H3 heading.`,
          tip: 'Break sections with keyword-focused subheadings.'
        });
      }

      // 6. Overall Keyword Density / Content presence (6 pts)
      const kwOccurrences = (text.toLowerCase().match(new RegExp(keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'g')) || []).length;
      if (kwOccurrences >= 2) {
        totalScore += 6;
        results.basic.push({
          status: 'pass',
          text: `Focus keyword appears ${kwOccurrences} times in content.`,
          tip: ''
        });
      } else {
        results.basic.push({
          status: 'fail',
          text: `Focus keyword appears only ${kwOccurrences} time(s) in content.`,
          tip: 'Mention your keyword naturally 3–6 times across the article.'
        });
      }
    }

    /* ─────────────────────────────────────────────
     * 2. METADATA & TITLE READABILITY (Weight: 20 pts)
     * ───────────────────────────────────────────── */
    // Title Length: 40 - 65 chars (7 pts)
    const titleLen = metaTitle.length;
    if (titleLen >= 35 && titleLen <= 65) {
      totalScore += 7;
      results.titleReadability.push({
        status: 'pass',
        text: `SEO Title length is ideal (${titleLen} characters).`,
        tip: ''
      });
    } else if (titleLen > 65) {
      results.titleReadability.push({
        status: 'warn',
        text: `SEO Title is a bit long (${titleLen}/65 chars). Google may truncate it.`,
        tip: 'Aim for 40–60 characters for best display.'
      });
    } else {
      results.titleReadability.push({
        status: 'warn',
        text: `SEO Title is short (${titleLen} chars).`,
        tip: 'Add descriptive branding or benefits to reach ~50 characters.'
      });
    }

    // Meta Description Length: 110 - 160 chars (7 pts)
    const descLen = metaDesc.length;
    if (descLen >= 110 && descLen <= 165) {
      totalScore += 7;
      results.titleReadability.push({
        status: 'pass',
        text: `Meta Description length is great (${descLen}/160 chars).`,
        tip: ''
      });
    } else if (descLen > 165) {
      results.titleReadability.push({
        status: 'warn',
        text: `Meta Description exceeds 160 characters (${descLen} chars).`,
        tip: 'Shorten to prevent truncation in SERPs.'
      });
    } else if (descLen > 0) {
      results.titleReadability.push({
        status: 'warn',
        text: `Meta Description is too brief (${descLen} chars).`,
        tip: 'Expand to 120–155 characters for higher click-through rates.'
      });
    } else {
      results.titleReadability.push({
        status: 'fail',
        text: `Meta Description is missing.`,
        tip: 'Write a compelling summary for search result snippets.'
      });
    }

    // Number or Power Word in Title (6 pts)
    const hasNumber = /\d+/.test(metaTitle);
    const powerWords = ['guide', 'how', 'best', 'top', 'tips', 'complete', 'simple', 'fast', 'ultimate', 'checklist', 'secrets', 'modern', 'free'];
    const hasPowerWord = powerWords.some(pw => metaTitle.toLowerCase().includes(pw));
    if (hasNumber || hasPowerWord) {
      totalScore += 6;
      results.titleReadability.push({
        status: 'pass',
        text: `Title contains engaging hooks (${hasNumber ? 'Numbers' : ''} ${hasPowerWord ? 'Power Words' : ''}).`,
        tip: ''
      });
    } else {
      results.titleReadability.push({
        status: 'warn',
        text: `Consider adding numbers or strong words (e.g. "Complete Guide", "7 Ways") in title.`,
        tip: 'Increases organic click-through rate.'
      });
    }

    /* ─────────────────────────────────────────────
     * 3. CONTENT READABILITY (Weight: 20 pts)
     * ───────────────────────────────────────────── */
    // Word Count (8 pts)
    if (wordCount >= 600) {
      totalScore += 8;
      results.contentReadability.push({
        status: 'pass',
        text: `Content length is substantial (${wordCount} words).`,
        tip: ''
      });
    } else if (wordCount >= 300) {
      totalScore += 4;
      results.contentReadability.push({
        status: 'warn',
        text: `Article has ${wordCount} words. 600+ words recommended for competitive topics.`,
        tip: 'Add more detailed explanations or examples.'
      });
    } else {
      results.contentReadability.push({
        status: 'fail',
        text: `Article is very short (${wordCount} words). Minimum recommended is 300 words.`,
        tip: 'Flesh out your main ideas and case details.'
      });
    }

    // Has H2 / H3 Subheadings (5 pts)
    const headingCount = (html.match(/<h[2-4][^>]*>/gi) || []).length;
    if (headingCount >= 2) {
      totalScore += 5;
      results.contentReadability.push({
        status: 'pass',
        text: `Content is structured with ${headingCount} subheadings.`,
        tip: ''
      });
    } else {
      results.contentReadability.push({
        status: 'warn',
        text: `Few or no subheadings found.`,
        tip: 'Break long blocks with H2 and H3 subheadings.'
      });
    }

    // Lists detected (ul / ol) (4 pts)
    const hasList = /<(ul|ol)[^>]*>/i.test(html);
    if (hasList) {
      totalScore += 4;
      results.contentReadability.push({
        status: 'pass',
        text: `Bullet points or numbered lists detected.`,
        tip: ''
      });
    } else {
      results.contentReadability.push({
        status: 'warn',
        text: `No lists found. Bullet points improve scan-ability.`,
        tip: 'Format steps or key benefits as bullet points.'
      });
    }

    // Paragraph Length (3 pts)
    const paragraphs = html.match(/<p[^>]*>(.*?)<\/p>/gi) || [];
    const hasVeryLongP = paragraphs.some(p => {
      const pWords = p.replace(/<[^>]+>/g, '').split(/\s+/).filter(w => w.length > 0);
      return pWords.length > 120;
    });
    if (!hasVeryLongP && paragraphs.length > 0) {
      totalScore += 3;
      results.contentReadability.push({
        status: 'pass',
        text: `Paragraphs are bite-sized and easy to read.`,
        tip: ''
      });
    } else if (hasVeryLongP) {
      results.contentReadability.push({
        status: 'warn',
        text: `Some paragraphs are longer than 120 words.`,
        tip: 'Split large paragraphs into 2-3 shorter sentences.'
      });
    }

    /* ─────────────────────────────────────────────
     * 4. MEDIA & ASSETS (Weight: 15 pts)
     * ───────────────────────────────────────────── */
    const featuredImgPreview = document.querySelector('#featured_img_preview');
    const hasFeaturedImg = featuredImgPreview && featuredImgPreview.getAttribute('src') && !featuredImgPreview.classList.contains('d-none');
    
    if (hasFeaturedImg) {
      totalScore += 8;
      results.media.push({
        status: 'pass',
        text: `Featured image is set.`,
        tip: ''
      });
    } else {
      results.media.push({
        status: 'fail',
        text: `No featured image uploaded.`,
        tip: 'Featured images drive social clicks and image search rank.'
      });
    }

    if (altText.length > 3) {
      totalScore += 7;
      results.media.push({
        status: 'pass',
        text: `Image Alt Text provided ("${altText.substring(0, 30)}...")`,
        tip: ''
      });
    } else {
      results.media.push({
        status: 'warn',
        text: `Missing or short Image Alt Text.`,
        tip: 'Provide descriptive alt text containing your focus keyword.'
      });
    }

    // Bound totalScore 0-100
    totalScore = Math.min(100, Math.max(0, totalScore));

    // Render UI updates
    this.renderScore(totalScore);
    this.renderChecklist(results);
  }

  updateGooglePreview(title, slug, metaTitle, metaDesc) {
    const pTitle = document.querySelector(this.config.previewTitle);
    const pUrl = document.querySelector(this.config.previewUrl);
    const pDesc = document.querySelector(this.config.previewDesc);

    if (pTitle) pTitle.textContent = metaTitle || 'Your Blog Post Title';
    if (pUrl) pUrl.textContent = this.config.siteBaseUrl + (slug || 'sample-post-url');
    if (pDesc) pDesc.textContent = metaDesc || 'Write a compelling meta description for this article so users see it here in Google search results.';
  }

  renderScore(score) {
    const badge = document.querySelector(this.config.scoreBadge);
    const text = document.querySelector(this.config.scoreText);
    const level = document.querySelector(this.config.scoreLevel);
    const progress = document.querySelector(this.config.scoreProgress);

    if (text) text.textContent = score;
    if (progress) {
      progress.style.width = score + '%';
    }

    let color = '#EF4444'; // Red
    let label = 'Needs Attention';
    let bgClass = 'bg-danger';

    if (score >= 70) {
      color = '#10B981'; // Green
      label = 'Good SEO';
      bgClass = 'bg-success';
    } else if (score >= 45) {
      color = '#F59E0B'; // Amber
      label = 'Needs Improvement';
      bgClass = 'bg-warning text-dark';
    }

    if (badge) {
      badge.style.backgroundColor = color;
      badge.style.color = '#ffffff';
    }
    if (level) {
      level.textContent = label;
      level.style.color = color;
    }
    if (progress) {
      progress.style.backgroundColor = color;
    }
  }

  renderChecklist(results) {
    const container = document.querySelector(this.config.checklistContainer);
    if (!container) return;

    let html = '';

    const sections = [
      { title: 'Basic SEO & Focus Keyword', items: results.basic, icon: 'bi-bullseye' },
      { title: 'Title & Meta Readability', items: results.titleReadability, icon: 'bi-google' },
      { title: 'Content Quality', items: results.contentReadability, icon: 'bi-file-earmark-text' },
      { title: 'Media & Alt Attributes', items: results.media, icon: 'bi-image' }
    ];

    sections.forEach(sec => {
      html += `
        <div class="mb-3">
          <div class="d-flex align-items-center justify-content-between mb-2 pb-1 border-bottom">
            <span class="fw-bold fs-12 text-uppercase text-secondary">
              <i class="bi ${sec.icon} me-1"></i>${sec.title}
            </span>
            <span class="fs-11 text-muted">
              ${sec.items.filter(i => i.status === 'pass').length}/${sec.items.length}
            </span>
          </div>
          <ul class="list-unstyled mb-0 fs-12">
      `;

      sec.items.forEach(item => {
        let iconClass = 'bi-check-circle-fill text-success';
        if (item.status === 'fail') iconClass = 'bi-x-circle-fill text-danger';
        if (item.status === 'warn') iconClass = 'bi-exclamation-triangle-fill text-warning';

        html += `
          <li class="d-flex align-items-start gap-2 py-1">
            <i class="bi ${iconClass} mt-1 flex-shrink-0"></i>
            <div>
              <div class="text-dark">${item.text}</div>
              ${item.tip ? `<div class="text-muted fs-11">${item.tip}</div>` : ''}
            </div>
          </li>
        `;
      });

      html += `</ul></div>`;
    });

    container.innerHTML = html;
  }
}

// Global initialization helper
window.initBlogSeoAnalyzer = function(config) {
  return new BlogSeoAnalyzer(config);
};
