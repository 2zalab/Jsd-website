<style>
/* ── Legal / Info pages — Design System ─────────────────────── */

/* Hero */
.lp-hero {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 65%, var(--color-accent) 100%);
    color: #fff;
    padding: var(--space-16) var(--space-6) var(--space-12);
    position: relative;
    overflow: hidden;
}
.lp-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
}
.lp-hero-inner {
    position: relative;
    max-width: var(--container-max); margin: 0 auto;
    display: flex; flex-direction: column; align-items: flex-start;
    gap: var(--space-4);
}
.lp-hero-icon {
    width: 56px; height: 56px;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: var(--radius-xl);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; color: #fff;
    backdrop-filter: blur(4px);
}
.lp-hero h1 {
    font-size: clamp(1.75rem, 4vw, 2.75rem);
    font-weight: 800; line-height: 1.2; margin: 0;
}
.lp-hero .lp-meta {
    display: flex; align-items: center; gap: var(--space-3);
    flex-wrap: wrap;
}
.lp-hero .lp-badge {
    display: inline-flex; align-items: center; gap: var(--space-2);
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    padding: var(--space-1) var(--space-3);
    border-radius: var(--radius-full);
    font-size: var(--font-size-xs); font-weight: 500;
    backdrop-filter: blur(4px);
}

/* Breadcrumb */
.lp-breadcrumb {
    max-width: var(--container-max); margin: 0 auto;
    padding: var(--space-3) var(--space-6);
    font-size: var(--font-size-sm);
    color: var(--color-text-muted);
    display: flex; align-items: center; gap: var(--space-2);
    border-bottom: 1px solid var(--color-border);
    background: var(--color-bg-card);
}
.lp-breadcrumb a { color: var(--color-primary); text-decoration: none; }
.lp-breadcrumb a:hover { text-decoration: underline; }
.lp-breadcrumb .sep { color: var(--color-text-light); }

/* Layout */
.lp-layout {
    max-width: var(--container-max); margin: 0 auto;
    padding: var(--space-12) var(--space-6);
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: var(--space-12);
    align-items: start;
}
@media (max-width: 900px) {
    .lp-layout { grid-template-columns: 1fr; }
    .lp-toc { display: none; }
}

/* Table of contents */
.lp-toc {
    position: sticky; top: 80px;
    background: var(--color-bg-card);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    padding: 10px;
}
.lp-toc-title {
    font-size: var(--font-size-xs); font-weight: 700;
    text-transform: uppercase; letter-spacing: .08em;
    color: var(--color-text-muted);
    margin-bottom: var(--space-4);
}
.lp-toc nav { display: flex; flex-direction: column; gap: var(--space-1); }
.lp-toc a {
    display: flex; align-items: center; gap: var(--space-2);
    font-size: var(--font-size-sm); color: var(--color-text-muted);
    text-decoration: none;
    padding: var(--space-2) var(--space-3);
    border-radius: var(--radius-md);
    transition: background var(--transition), color var(--transition);
    line-height: 1.4;
}
.lp-toc a:hover, .lp-toc a.active {
    background: rgba(30,64,175,.07);
    color: var(--color-primary);
}
.lp-toc a .toc-num {
    font-size: var(--font-size-xs); font-weight: 700;
    color: var(--color-primary); opacity: .6;
    flex-shrink: 0; min-width: 18px;
}

/* Content */
.lp-content { min-width: 0; }

.lp-section {
    background: var(--color-bg-card);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    padding: var(--space-6) var(--space-8);
    margin-bottom: var(--space-6);
    scroll-margin-top: 90px;
    transition: box-shadow var(--transition);
}
.lp-section:hover { box-shadow: var(--shadow-md); }

.lp-section-header {
    display: flex; align-items: flex-start; gap: var(--space-4);
    margin-bottom: var(--space-4);
    padding-bottom: var(--space-4);
    border-bottom: 1px solid var(--color-border);
}
.lp-section-num {
    flex-shrink: 0;
    width: 36px; height: 36px;
    background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
    color: #fff; border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    font-size: var(--font-size-sm); font-weight: 800;
    line-height: 1;
}
.lp-section h2 {
    font-size: var(--font-size-lg); font-weight: 700;
    color: var(--color-text); margin: 0; line-height: 1.3;
    flex: 1;
}
.lp-section p, .lp-section li {
    color: var(--color-text-muted); line-height: 1.75;
    font-size: var(--font-size-base); margin-bottom: var(--space-3);
}
.lp-section p:last-child, .lp-section li:last-child { margin-bottom: 0; }
.lp-section ul {
    padding-left: var(--space-6); margin-bottom: var(--space-3);
}
.lp-section li { list-style: none; position: relative; padding-left: var(--space-4); }
.lp-section li::before {
    content: '';
    position: absolute; left: 0; top: .65em;
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--color-primary);
    opacity: .6;
}
.lp-section a { color: var(--color-primary); text-decoration: none; }
.lp-section a:hover { text-decoration: underline; }

/* Callout / highlight box */
.lp-callout {
    background: rgba(30,64,175,.06);
    border-left: 3px solid var(--color-primary);
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    padding: 10px;
    margin: var(--space-4) 0;
    font-size: var(--font-size-sm);
    color: var(--color-text-muted);
}
.lp-callout strong { color: var(--color-primary-dark); }

/* Value cards (Code de conduite) */
.lp-values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--space-4);
    margin-bottom: var(--space-2);
}
.lp-value-card {
    background: var(--color-bg-section);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: 10px;
    transition: box-shadow var(--transition), transform var(--transition);
}
.lp-value-card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
.lp-value-card .vc-icon { font-size: 1.5rem; margin-bottom: var(--space-2); }
.lp-value-card strong { display: block; font-size: var(--font-size-sm); font-weight: 700; color: var(--color-text); margin-bottom: var(--space-1); }
.lp-value-card p { font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 0; line-height: 1.5; }

/* Behaviour lists (do/don't) */
.lp-check-list { padding: 0; }
.lp-check-list li {
    display: flex; align-items: flex-start; gap: var(--space-3);
    padding: var(--space-2) 0;
    border-bottom: 1px solid var(--color-border);
    font-size: var(--font-size-sm);
}
.lp-check-list li:last-child { border-bottom: none; }
.lp-check-list li::before { display: none; }
.lp-check-list .li-icon { flex-shrink: 0; margin-top: 3px; }
.lp-check-list .li-icon.ok  { color: var(--color-success); }
.lp-check-list .li-icon.nok { color: var(--color-danger); }

/* ── FAQ ─────────────────────────────────────────────────────── */
.faq-hero-desc {
    font-size: var(--font-size-lg); opacity: .88; margin: 0;
    max-width: 560px; line-height: 1.6;
}
.faq-layout {
    max-width: 860px; margin: 0 auto;
    padding: var(--space-12) var(--space-6);
}
.faq-categories {
    display: flex; flex-wrap: wrap; gap: var(--space-2);
    margin-bottom: var(--space-8);
}
.faq-cat-btn {
    display: inline-flex; align-items: center; gap: var(--space-2);
    padding: var(--space-2) var(--space-4);
    border-radius: var(--radius-full);
    border: 1.5px solid var(--color-border);
    background: var(--color-bg-card);
    color: var(--color-text-muted);
    font-size: var(--font-size-sm); font-weight: 500;
    cursor: pointer; transition: all var(--transition);
}
.faq-cat-btn:hover, .faq-cat-btn.active {
    border-color: var(--color-primary);
    background: rgba(30,64,175,.07);
    color: var(--color-primary);
}
.faq-group { margin-bottom: var(--space-10); }
.faq-group-title {
    font-size: var(--font-size-sm); font-weight: 700;
    text-transform: uppercase; letter-spacing: .08em;
    color: var(--color-text-muted);
    padding: var(--space-2) 0 var(--space-4);
    border-bottom: 2px solid var(--color-primary);
    margin-bottom: var(--space-4);
    display: flex; align-items: center; gap: var(--space-2);
}
.faq-group-title i { color: var(--color-primary); }

.faq-item {
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    margin-bottom: var(--space-3);
    overflow: hidden;
    background: var(--color-bg-card);
    transition: box-shadow var(--transition);
    padding: 20px;
}
.faq-item:hover { box-shadow: var(--shadow-md); }
.faq-question {
    display: flex; justify-content: space-between; align-items: center;
    padding: var(--space-4) var(--space-5);
    cursor: pointer; user-select: none;
    font-weight: 600; font-size: var(--font-size-base);
    color: var(--color-text); gap: var(--space-4);
}
.faq-question:hover { color: var(--color-primary); }
.faq-q-text { flex: 1; }
.faq-icon {
    flex-shrink: 0;
    width: 28px; height: 28px;
    border-radius: 50%;
    border: 1.5px solid var(--color-border);
    display: flex; align-items: center; justify-content: center;
    font-size: .7rem; color: var(--color-text-muted);
    transition: transform .25s ease, background var(--transition), border-color var(--transition), color var(--transition);
}
.faq-item.open .faq-icon {
    transform: rotate(45deg);
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: #fff;
}
.faq-answer {
    max-height: 0; overflow: hidden;
    transition: max-height .35s ease, padding .3s ease;
    padding: 0 var(--space-5);
    border-top: 0px solid var(--color-border);
}
.faq-item.open .faq-answer {
    max-height: 600px;
    padding: 10px;
    border-top-width: 1px;
}
.faq-answer p, .faq-answer li {
    color: var(--color-text-muted); line-height: 1.75;
    font-size: var(--font-size-sm);
}
.faq-answer ul { padding-left: var(--space-5); margin-top: var(--space-2); }
.faq-answer li { list-style: disc; margin-bottom: var(--space-1); }
.faq-answer a { color: var(--color-primary); }

/* FAQ contact CTA */
.faq-cta {
    background: linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));
    border-radius: var(--radius-2xl);
    padding: var(--space-8) var(--space-8);
    text-align: center; color: #fff; margin-top: var(--space-8);
}
.faq-cta h3 { font-size: var(--font-size-xl); font-weight: 700; margin-bottom: var(--space-3); }
.faq-cta p { opacity: .85; margin-bottom: var(--space-6); font-size: var(--font-size-sm); }
.faq-cta .cta-links { display: flex; justify-content: center; gap: var(--space-3); flex-wrap: wrap; }
.faq-cta .cta-btn {
    display: inline-flex; align-items: center; gap: var(--space-2);
    padding: var(--space-2) var(--space-5);
    border-radius: var(--radius-full);
    font-size: var(--font-size-sm); font-weight: 600;
    text-decoration: none; transition: opacity var(--transition);
}
.faq-cta .cta-btn:hover { opacity: .85; }
.faq-cta .cta-btn.primary { background: #fff; color: var(--color-primary); }
.faq-cta .cta-btn.secondary { background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.3); }
</style>
