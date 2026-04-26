<?php
/*
Template Name: Contact Page
*/
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'contact-body';
$hallow_body_attrs = '';
get_header();
?>

<main class="contact-page">
      <section class="contact-hero" aria-labelledby="contact-title">
        <div class="contact-hero-glow" aria-hidden="true"></div>
        <div class="contact-hero-copy">
          <p class="contact-kicker" data-i18n="contactKicker">Contact us</p>
          <h1 id="contact-title" class="contact-title" data-i18n="contactTitle">How to get in touch.</h1>
          <p class="contact-intro" data-i18n="contactIntro">
            Questions about an order, wholesale ceramics, or a custom Halloween vignette? Send a note and we’ll reply with the same care we put into every carved pumpkin.
          </p>
        </div>
      </section>

      <section class="contact-shell" aria-label="Contact details and message form">
        <aside class="contact-info-card" data-reveal-delay="0">
          <p class="contact-kicker" data-i18n="contactInfoKicker">Studio notes</p>
          <h2 data-i18n="contactInfoTitle">For orders, wholesale, and custom pieces.</h2>
          <p data-i18n="contactInfoBody">
            Tell us what you’re building: a mantel edit, a retail order, or a one-off ceramic pumpkin for a client space.
          </p>

          <div class="contact-methods">
            <a class="contact-method" href="mailto:hello@hallowceramics.com">
              <span class="contact-method-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                  <path d="M4 6h16v12H4z" />
                  <path d="m4 7 8 6 8-6" />
                </svg>
              </span>
              <span>
                <small data-i18n="contactEmailLabel">Email us</small>
                hello@hallowceramics.com
              </span>
            </a>
            <a class="contact-method" href="tel:+18592425134">
              <span class="contact-method-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                  <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6.1 6.1l1.3-1.3a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z" />
                </svg>
              </span>
              <span>
                <small data-i18n="contactPhoneLabel">Call us</small>
                +1 (859) 242-5134
              </span>
            </a>
          </div>

          <div class="contact-studio">
            <h3 data-i18n="contactStudioTitle">Our studio</h3>
            <p data-i18n="contactStudioAddress">By appointment for wholesale and custom order previews.</p>
            <dl class="contact-hours">
              <div>
                <dt data-i18n="contactHoursWeek">Mon–Thu</dt>
                <dd>9:00am – 6:00pm</dd>
              </div>
              <div>
                <dt data-i18n="contactHoursFri">Friday</dt>
                <dd>9:00am – 2:00pm</dd>
              </div>
            </dl>
          </div>
        </aside>

        <section class="contact-form-card" data-reveal-delay="120" aria-labelledby="contact-form-title">
          <p class="contact-kicker" data-i18n="contactFormKicker">Send a message</p>
          <h2 id="contact-form-title" data-i18n="contactFormTitle">Start with a few details.</h2>
          <form class="contact-form" action="mailto:hello@hallowceramics.com" method="post" enctype="text/plain">
            <label>
              <span data-i18n="contactNameLabel">Name</span>
              <input type="text" name="name" autocomplete="name" required />
            </label>
            <label>
              <span data-i18n="contactEmailInputLabel">Email</span>
              <input type="email" name="email" autocomplete="email" required />
            </label>
            <label>
              <span data-i18n="contactTopicLabel">What can we help with?</span>
              <select name="topic">
                <option data-i18n="contactTopicOrder">Order question</option>
                <option data-i18n="contactTopicWholesale">Wholesale inquiry</option>
                <option data-i18n="contactTopicCustom">Custom ceramic request</option>
                <option data-i18n="contactTopicOther">Something else</option>
              </select>
            </label>
            <label>
              <span data-i18n="contactMessageLabel">Message</span>
              <textarea name="message" rows="6" required></textarea>
            </label>
            <button type="submit" class="btn-primary contact-submit" data-i18n="contactSubmit">Send message</button>
            <p class="contact-form-note" data-i18n="contactFormNote">
              This demo form opens your email app. When you connect WordPress or WooCommerce, we can route it to a real inbox workflow.
            </p>
          </form>
        </section>
      </section>

      <section class="contact-cta" aria-labelledby="contact-cta-title">
        <p class="contact-kicker contact-kicker--center" data-i18n="contactCtaKicker">Wholesale ready</p>
        <h2 id="contact-cta-title" data-i18n="contactCtaTitle">Building a seasonal display?</h2>
        <p data-i18n="contactCtaText">
          Send us your timeline, quantity, and moodboard. We’ll help choose pumpkins and accents that photograph beautifully and still feel grounded in person.
        </p>
      </section>
    </main>

<?php get_footer(); ?>
